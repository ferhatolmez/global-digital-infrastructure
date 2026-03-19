<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiteBuilderController extends Controller
{
    /**
     * Müşterinin sitelerini (veya yeni site kurabileceği domainlerini) listeler.
     */
    public function index()
    {
        // Şimdilik test için kullanıcının mevcut sitelerini getiriyoruz.
        // İleride burada OrderItem tablosundan müşterinin satın aldığı domainleri çekip eşleştireceğiz.
        $sites = UserSite::where('user_id', Auth::id())->get();
        
        return view('client.builder.index', compact('sites'));
    }

    /**
     * GrapesJS Sürükle-Bırak Editörünü açar.
     */
    public function editor($id)
    {
        $site = UserSite::where('user_id', Auth::id())->findOrFail($id);
        
        return view('client.builder.editor', compact('site'));
    }

    /**
     * GrapesJS'den gelen HTML ve CSS kodlarını veritabanına kaydeder.
     */
    public function save(Request $request, $id)
    {
        $site = UserSite::where('user_id', Auth::id())->findOrFail($id);
        
        $site->update([
            'html_content' => $request->input('html'),
            'css_content' => $request->input('css'),
            // İleride FTP/cPanel API ile bu dosyaları doğrudan sunucuya da gönderebiliriz (Yayınla)
        ]);

        return response()->json(['message' => 'Tasarım başarıyla kaydedildi!']);
    }

    /**
     * Sitenin kodlarını derleyip FTP/cPanel API üzerinden sunucuya gönderir (Yayınlar)
     */
    public function publish($id)
    {
        $site = UserSite::where('user_id', Auth::id())->findOrFail($id);

        if (empty($site->html_content)) {
            return back()->with('error', 'Yayınlanacak bir tasarım bulunamadı. Lütfen önce editörde bir şeyler tasarlayın.');
        }

        // 1. Veritabanındaki HTML ve CSS'i standart bir web sayfası formatında birleştiriyoruz
        $fullHtml = "<!DOCTYPE html>\n<html lang='tr'>\n<head>\n";
        $fullHtml .= "<meta charset='UTF-8'>\n";
        $fullHtml .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
        $fullHtml .= "<title>{$site->domain_name}</title>\n";
        $fullHtml .= "<style>\n{$site->css_content}\n</style>\n";
        $fullHtml .= "</head>\n<body>\n";
        $fullHtml .= $site->html_content . "\n";
        $fullHtml .= "</body>\n</html>";

        try {
            // 2. GERÇEK FTP/SUNUCU YÜKLEMESİ BURADA YAPILIR
            // Eğer sunucuda işlem yapacak olsaydık Laravel'in Storage::disk('ftp')->put(...) özelliğini kullanırdık.
            // Şimdilik sistemin çalıştığını görmek için kendi projemizin içine (local disk) kaydediyoruz (Simülasyon).
            
            \Illuminate\Support\Facades\Storage::disk('local')->put("published_sites/{$site->domain_name}/index.html", $fullHtml);

            // 3. Veritabanında sitenin durumunu 'Yayında' olarak güncelle
            $site->update(['is_published' => true]);

            return back()->with('success', 'Harika! Sitenizin dosyaları başarıyla sunucuya gönderildi ve yayına alındı.');

        } catch (\Exception $e) {
            return back()->with('error', 'Yayınlama sırasında sunucu hatası oluştu: ' . $e->getMessage());
        }
    }
}
