<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::prefix('webhooks')->group(function () {

    Route::post('/stripe', [WebhookController::class, 'handleStripe']);
});
