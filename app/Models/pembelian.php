<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pembelian extends Model
{
    protected $table = 'pembelians';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'pemasok_id',
        'user_id',
        'tanggal_pembelian',
        'total_harga',
    ];

    // Relasi ke model Pemasok
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
