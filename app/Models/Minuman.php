<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minuman extends Model
{
    use HasFactory;
    protected $fillable = ['nama_minuman', 'ukuran', 'topping', 'deskripsi', 'harga', 'gula'];
}
