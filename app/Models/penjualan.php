<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    
 use HasFactory;

    protected $table = 'penjualans';
    protected $fillable = ['user_id', 'total_harga'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPenjualan()
    {
        return $this->hasMany(detail_penjualan::class);
    }
}