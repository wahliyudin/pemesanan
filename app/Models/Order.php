<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_TRUE = 1;
    const STATUS_FALSE = 0;
    const STATUS_CANCEL = 2;

    protected $fillable = [
        'kode_pesanan',
        'tanggal',
        'status',
        'total',
        'user_id',
        'no_antrian'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot(['qty', 'total'])->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
