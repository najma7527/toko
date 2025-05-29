<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    
protected $table = 'penjualans';
protected $primaryKey = 'id';

protected $fillable = [
    'user_id',
    'total_harga',
];
}