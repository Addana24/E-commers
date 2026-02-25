<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * Properti $fillable untuk mass assignment
     */
    protected $fillable = [
        'order_id',
        'name',
        'price',
        'quantity',
    ];

    /**
     * Fungsi relasi ke Order
     * (Nama fungsinya 'order' dalam bentuk tunggal,
     * karena satu OrderItem HANYA milik satu Order)
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
