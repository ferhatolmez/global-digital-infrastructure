<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainExtension extends Model
{
    protected $fillable = [
        'extension', 'provider_id', 'register_price', 'renew_price', 'transfer_price',
        'is_manual_override', 'check_premium', 'whois_privacy_default', 'is_active'
    ];

    protected $casts = [
        'is_manual_override' => 'boolean',
        'check_premium' => 'boolean',
        'whois_privacy_default' => 'boolean',
        'is_active' => 'boolean',
        'register_price' => 'decimal:2',
        'renew_price' => 'decimal:2',
        'transfer_price' => 'decimal:2',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
