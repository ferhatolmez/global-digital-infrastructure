<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostingPlan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'cpanel_package_name', 'disk_space_mb', 'bandwidth_mb',
        'addon_domains', 'subdomains', 'email_accounts', 'databases',
        'monthly_price', 'yearly_price', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
    ];
}
