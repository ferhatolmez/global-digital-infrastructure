<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\DomainExtension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomainController extends Controller
{
    /**
     * Müşterinin sahip olduğu domainleri listeler.
     */
    public function index()
    {
        $domains = Domain::where('user_id', Auth::id())->latest()->get();
        return view('client.domains.index', compact('domains'));
    }

    /**
     * Domain arama (sorgulama) sayfasını yönetir.
     */
    public function search(Request $request)
    {
        $query = $request->input('domain');
        $results = null;

        if ($query) {
            $domainName = explode('.', $query)[0];
            $extensions = DomainExtension::where('is_active', true)->get();
            $results = [];

            foreach ($extensions as $ext) {
                // Şimdilik rastgele uygunluk durumu (Simülasyon)
                $isAvailable = rand(1, 10) > 3; 

                $results[] = (object)[
                    'full_domain'  => $domainName . $ext->extension,
                    'extension'    => $ext->extension,
                    'is_available' => $isAvailable,
                    'price'        => $ext->register_price,
                    'ext_id'       => $ext->id
                ];
            }
        }

        return view('client.domains.search', compact('results', 'query'));
    }

    /**
     * TEKİL DOMAİN YÖNETİM SAYFASI (Yönet butonu buraya bağlanır)
     */
    public function show($id)
    {
        // Kullanıcıya ait domaini buluyoruz (Güvenlik: Sadece kendi domainini görebilmeli)
        $domain = Domain::where('user_id', Auth::id())->findOrFail($id);

        // Gelecekte DNS kayıtlarını (A, CNAME, TXT) çekmek istersen burada veritabanından çağırabilirsin
        // $dnsRecords = $domain->dnsRecords()->get();

        return view('client.domains.show', compact('domain'));
    }

    /**
     * Domain ayarlarını (Nameserver vb.) günceller.
     */
   /**
     * Sadece Domain ayarlarını (Nameserver) günceller.
     */
    public function update(Request $request, $id)
    {
        // Güvenlik: Sadece giriş yapan kullanıcıya ait domain güncellenebilir
        $domain = Domain::where('user_id', Auth::id())->findOrFail($id);

        // Formdan gelen verileri doğruluyoruz
        $request->validate([
            'ns1' => 'required|string',
            'ns2' => 'required|string',
        ]);

        // JSON formatındaki nameservers sütununu güncelliyoruz.
        // auto_renew'e dokunmuyoruz ki kullanıcının ayarı bozulmasın.
        $domain->update([
            'nameservers' => [
                'ns1' => $request->ns1,
                'ns2' => $request->ns2,
            ]
        ]);

        return back()->with('success', 'Nameserver ayarları başarıyla güncellendi.');
    }

    /**
     * Domainin otomatik yenileme durumunu açar/kapatır.
     */
    public function toggleAutoRenew($id)
    {
        // Kullanıcının domainini bul
        $domain = Domain::where('user_id', Auth::id())->findOrFail($id);

        // Mevcut durumun tam tersini al (true ise false, false ise true yap)
        $domain->auto_renew = !$domain->auto_renew;
        $domain->save();

        // Kullanıcıya dinamik bir mesaj ver
        $durumMesaji = $domain->auto_renew ? 'aktif edildi' : 'kapatıldı';

        return back()->with('success', "Otomatik yenileme başarıyla {$durumMesaji}.");
    }
}