<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pemesan', 'makanan_yang_dipesan', 'jumlah', 'alamat', 'metode_pembayaran', 'tambahan_lainnya', 'total_pembayaran'];
}
