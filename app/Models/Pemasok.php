<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pemasok',
        'no_telp',
        'alamat',
    ];
    

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }
}
