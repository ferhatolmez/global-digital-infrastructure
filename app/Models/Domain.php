<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'user_id', 'domain_name', 'status', 'registered_at', 'expires_at', 'auto_renew'
    ];

    protected $casts = [
        'registered_at' => 'date',
        'expires_at' => 'date',
        'auto_renew' => 'boolean',
    ];
}
