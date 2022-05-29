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

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case Order::STATUS_FALSE:
                return '<span style="color: black; background-color: yellow; padding: 3px 6px;">Belum dibayar</span>';
                break;
            case Order::STATUS_TRUE:
                return '<span style="color: white; background-color: green; padding: 3px 6px;">Sudah dibayar</span>';
                break;
            default:
                return '<span style="color: white; background-color: red; padding: 3px 6px;">Antrian dilewat</span>';
                break;
        }
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot(['qty', 'total'])->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
