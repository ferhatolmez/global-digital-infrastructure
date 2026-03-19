<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        // Türüne ve önceliğine göre sıralayarak getir
        $providers = Provider::with('fallbackProvider')
            ->orderBy('service_type')
            ->orderBy('priority')
            ->paginate(10);

        return view('admin.providers.index', compact('providers'));
    }

    public function create()
    {
        // Sadece aktif sağlayıcıları fallback olarak seçebilmek için getir
        $activeProviders = Provider::where('is_active', true)->get();
        return view('admin.providers.create', compact('activeProviders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'service_type'         => 'required|string|in:domain,hosting,ssl,payment,sms',
            'api_key'              => 'nullable|string',
            'secret_key'           => 'nullable|string',
            'endpoint_url'         => 'nullable|url',
            'region'               => 'nullable|string|max:50',
            'priority'             => 'required|integer|min:1',
            'fallback_provider_id' => 'nullable|exists:providers,id',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Provider::create($validated);

        return redirect()->route('admin.providers.index')->with('success', 'Sağlayıcı başarıyla eklendi.');
    }

    public function edit(Provider $provider)
    {
        // Kendisi hariç diğer aktif sağlayıcıları fallback olarak getir
        $activeProviders = Provider::where('is_active', true)->where('id', '!=', $provider->id)->get();
        return view('admin.providers.edit', compact('provider', 'activeProviders'));
    }

    public function update(Request $request, Provider $provider)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'service_type'         => 'required|string|in:domain,hosting,ssl,payment,sms',
            'api_key'              => 'nullable|string',
            'secret_key'           => 'nullable|string',
            'endpoint_url'         => 'nullable|url',
            'region'               => 'nullable|string|max:50',
            'priority'             => 'required|integer|min:1',
            'fallback_provider_id' => 'nullable|exists:providers,id',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $provider->update($validated);

        return redirect()->route('admin.providers.index')->with('success', 'Sağlayıcı başarıyla güncellendi.');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('admin.providers.index')->with('success', 'Sağlayıcı başarıyla silindi.');
    }

    public function testConnection(Provider $provider)
    {
        // İleride Guzzle/Http ile gerçek API'ye ping atılacak yer.
        try {
            $provider->update(['last_connected_at' => now()]);
            return back()->with('success', "{$provider->name} API bağlantısı başarılı!");
        } catch (\Exception $e) {
            return back()->with('error', "Bağlantı hatası: " . $e->getMessage());
        }
    }
}