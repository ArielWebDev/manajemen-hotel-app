<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';

    protected $fillable = [
        'nomor_kamar', 'kategori_id', 'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'kamar_id');
    }

}
