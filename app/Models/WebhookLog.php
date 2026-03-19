<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    // JSON formatındaki payload verisini doğrudan PHP dizisi (array) olarak kullanmak için
    protected $casts = [
        'payload' => 'array',
    ];
}