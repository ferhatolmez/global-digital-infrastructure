<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    use HasFactory;
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    // Veritabanına yazılmasına izin verdiğimiz alanlar
    protected $fillable = [
        'order_id',
        'product_type',
        'product_name',
        'price',
        'details'
    ];

    // Otomatik dönüşüm (İşte hatayı çözen satır burası!)
    protected $casts = [
        'price' => 'decimal:2',
        'details' => 'array', // PHP dizisini otomatik JSON'a çevirir
    ];
}
