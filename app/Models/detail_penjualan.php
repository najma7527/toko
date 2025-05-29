<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_penjualan extends Model
{
    protected $table = 'detail_penjualan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public $timestamps = false;

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
