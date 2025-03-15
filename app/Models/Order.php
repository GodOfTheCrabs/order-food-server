<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['user_id', 'foods', 'total_price', 'track_order', 'preparation_time', 'delivery_time'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'foods' => 'array',
    ];
}
