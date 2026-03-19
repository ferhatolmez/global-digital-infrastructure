<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomainExtension;
use App\Models\Provider;
use Illuminate\Http\Request;

class DomainExtensionController extends Controller
{
    public function index()
    {
        // Provider bilgisiyle birlikte uzantıları getiriyoruz
        $extensions = DomainExtension::with('provider')->get();
        return view('admin.domains.prices', compact('extensions'));
    }

    public function create()
    {
        // Sadece Domain hizmeti veren aktif sağlayıcıları getir
        $providers = Provider::where('service_type', 'domain')->where('is_active', true)->get();
        return view('admin.domain_extensions.create', compact('providers'));
    }

    public function update(Request $request, $id)
    {
        // Hata aldığın yer burasıydı, fonksiyonun isminin "update" olduğundan emin olalım
        $ext = DomainExtension::findOrFail($id);

        // Formdan gelen verileri alıp güncelliyoruz
        $ext->update([
            'register_price'        => $request->register_price,
            'renew_price'           => $request->renew_price,
            'transfer_price'        => $request->transfer_price,
            'is_manual_override'    => $request->has('is_manual_override') ? true : false,
            'is_active'             => $request->is_active ?? true,
        ]);

        return back()->with('success', $ext->extension . ' fiyatları başarıyla güncellendi.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'extension' => 'required|string|unique:domain_extensions,extension',
            'provider_id' => 'required|exists:providers,id',
            'register_price' => 'numeric|min:0',
            'renew_price' => 'numeric|min:0',
            'transfer_price' => 'numeric|min:0',
        ]);

        // Checkbox değerlerini boolean olarak alıyoruz
        $validated['is_manual_override'] = $request->has('is_manual_override');
        $validated['check_premium'] = $request->has('check_premium');
        $validated['whois_privacy_default'] = $request->has('whois_privacy_default');
        $validated['is_active'] = $request->has('is_active');

        // Gelen uzantının başında nokta yoksa ekleyelim (örn: com yerine .com)
        if (!str_starts_with($validated['extension'], '.')) {
            $validated['extension'] = '.' . $validated['extension'];
        }

        DomainExtension::create($validated);

        return redirect()->route('admin.domain-extensions.index')->with('success', 'Domain uzantısı başarıyla eklendi.');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
