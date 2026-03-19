<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Bir biletin birden fazla mesajı olur
    public function messages() {
        return $this->hasMany(TicketMessage::class);
    }
    
    // Bileti açan müşteri
    public function user() {
        return $this->belongsTo(User::class);
    }
}
