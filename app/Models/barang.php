<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'stok',
        'pemasok_id',
        'gambar',
        'keterangan',                       
    ];
    

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }
}
