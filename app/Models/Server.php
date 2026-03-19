<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'provider_id', 'name', 'ip_address', 'hostname', 'region', 
        'api_token', 'total_disk_gb', 'total_ram_gb', 'health_check_url', 
        'auto_scale_threshold_percent', 'auto_create_accounts', 
        'auto_ssl_install', 'is_active'
    ];

    protected $casts = [
        'api_token' => 'encrypted', // WHM/Sunucu tokeni şifreli saklanacak
        'auto_create_accounts' => 'boolean',
        'auto_ssl_install' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
