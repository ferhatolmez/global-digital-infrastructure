<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'user_id', 
        'total_amount', 
        'status'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];
    // Bir siparişin birden fazla ürünü olabilir
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Siparişin sahibi olan kullanıcı
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
