<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'user_id', 'kamar_id', 'nama_pengunjung', 'nik', 'tanggal_checkin', 'tanggal_checkout', 'status', 'biaya'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }
}
