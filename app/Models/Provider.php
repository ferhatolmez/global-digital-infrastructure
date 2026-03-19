<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $fillable = [
        'name',
        'service_type',
        'api_key',
        'secret_key',
        'endpoint_url',
        'region',
        'is_active',
        'priority',
        'fallback_provider_id',
        'last_successful_connection'
    ];

    /**
     * Otomatik tip dönüşümleri ve şifreleme.
     */
    protected $casts = [
        'is_active' => 'boolean',
        // Laravel bu alanları DB'ye kaydederken şifreler (AES-256), çekerken çözer.
        'api_key' => 'encrypted', 
        'secret_key' => 'encrypted',
        'last_successful_connection' => 'datetime',
    ];

    /**
     * Fallback (Yedek) Sağlayıcı İlişkisi
     */
    public function fallbackProvider()
    {
        return $this->belongsTo(Provider::class, 'fallback_provider_id');
    }
}
