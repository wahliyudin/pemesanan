<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'account_id',
        'no_pembayaran',
        'tanggal',
        'tagihan',
        'kembalian',
        'total'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
