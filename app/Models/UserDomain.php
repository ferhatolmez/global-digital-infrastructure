<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDomain extends Model
{
    use HasFactory;
    protected $guarded = []; // Hiçbir sütunu koruma, hepsine izin ver

    // Dışarıdan toplu veri girişine izin verilen sütunlar
    protected $fillable = [
        'user_id',
        'domain_name',
        'status',
        'registration_date',
        'expiry_date',
        'ns1',
        'ns2',
        'auto_renew'
    ];
}
