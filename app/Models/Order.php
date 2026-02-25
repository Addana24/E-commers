<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    /**
     * Properti $fillable untuk mass assignment
     */
    protected $fillable = [
        'customer_name', 
        'customer_address', 
        'customer_phone', 
        'payment_method',      // ← new
        'total_price', 
        'status'
    ];

    /**
     * Fungsi relasi ke OrderItem
     * (Nama fungsinya 'orderItems' dalam bentuk jamak, 
     * karena satu Order memiliki BANYAK OrderItem)
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
