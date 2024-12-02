<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'nama_produk',
        'ukuran',
        'berat',
        'rasa',
        'harga',
        'image_url',
    ];
}
