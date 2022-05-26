<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pesanan',
        'tanggal',
        'status',
        'total',
        'no_antrian',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('qty');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'order_users');
    }
}
