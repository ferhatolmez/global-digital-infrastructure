<?php

use Illuminate\Support\Facades\Route;

// Controller Tanımlamaları
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\DomainExtensionController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\PriceSyncController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\DomainController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HostingController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\SiteBuilderController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ServiceController;
use App\Http\Controllers\Client\DomainManagementController;
use App\Http\Controllers\Client\TicketController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WebhookController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Laravel varsayılan guest middleware yönlendirmelerinin döngüye girmemesi için:
Route::redirect('/home', '/client/dashboard');

// Auth Routes (laravel/ui yerine manuel)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('client')->name('client.')->middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');

    Route::get('/my-domains', [DomainManagementController::class, 'index'])->name('domains.my_domains');
    Route::get('/my-domains/{id}', [DomainManagementController::class, 'show'])->name('domains.show_details');

    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/builder', [SiteBuilderController::class, 'index'])->name('builder.index');
    Route::get('/builder/{id}/editor', [SiteBuilderController::class, 'editor'])->name('builder.editor');
    Route::post('/builder/{id}/save', [SiteBuilderController::class, 'save'])->name('builder.save');
    Route::post('/builder/{id}/publish', [SiteBuilderController::class, 'publish'])->name('builder.publish');

    Route::get('/domains', [DomainController::class, 'index'])->name('domains.index');
    Route::get('/domains/search', [DomainController::class, 'search'])->name('domains.search');
    Route::get('/domains/{id}', [DomainController::class, 'show'])->name('domains.show');
    Route::patch('/domains/{id}', [DomainController::class, 'update'])->name('domains.update');
    Route::patch('/domains/{id}/toggle-auto-renew', [DomainController::class, 'toggleAutoRenew'])->name('domains.toggle-auto-renew');

    Route::get('/hosting', [HostingController::class, 'index'])->name('hosting.index');
    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add-domain', [CartController::class, 'addDomain'])->name('cart.add-domain');
    Route::post('/cart/add-hosting', [CartController::class, 'addHosting'])->name('cart.add-hosting');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/webhooks', function () {
        $logs = \App\Models\WebhookLog::latest()->paginate(15);
        return view('admin.webhooks.index', compact('logs'));
    })->name('webhooks.index');

    Route::get('/domain-prices', [DomainExtensionController::class, 'index'])->name('domain-prices.index');
    Route::post('/domain-prices/{id}', [DomainExtensionController::class, 'update'])->name('domain-prices.update');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');

    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{id}', [AdminTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{id}/reply', [AdminTicketController::class, 'reply'])->name('tickets.reply');
    Route::post('/tickets/{id}/close', [AdminTicketController::class, 'close'])->name('tickets.close');

    Route::get('/providers', [ProviderController::class, 'index'])->name('providers.index');
    Route::get('/providers/create', [ProviderController::class, 'create'])->name('providers.create');
    Route::post('/providers', [ProviderController::class, 'store'])->name('providers.store');
    Route::get('/providers/{provider}/edit', [ProviderController::class, 'edit'])->name('providers.edit');
    Route::put('/providers/{provider}', [ProviderController::class, 'update'])->name('providers.update');
    Route::delete('/providers/{provider}', [ProviderController::class, 'destroy'])->name('providers.destroy');
    Route::post('/providers/{provider}/test', [ProviderController::class, 'testConnection'])->name('providers.test');

    Route::resource('/domain-extensions', DomainExtensionController::class);
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
    
    Route::get('/prices/sync', [PriceSyncController::class, 'index'])->name('prices.index');
    Route::post('/prices/sync/run', [PriceSyncController::class, 'syncNow'])->name('prices.sync-now');
});

Route::post('/webhook/{provider}', [WebhookController::class, 'handlePaymentWebhook'])->name('webhook.payment');


Route::fallback(function () {
    return redirect()->route('client.dashboard')->with('error', 'Aradığınız sayfa bulunamadı, ana sayfaya yönlendirildiniz.');
});

Route::any('{any}', function () {
    return redirect()->route('client.dashboard');
})->where('any', '.*');