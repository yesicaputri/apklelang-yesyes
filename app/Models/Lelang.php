<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    use HasFactory;
    protected $table = 'lelangs';
    protected $guarded = [];
    protected $fillable = [
        'barangs_id',
        'users_id',
        'harga_akhir',
        'tanggal_lelang',
        'status'
    ];

    public function barang()
    {
        return $this->hasOne('App\Models\Barang', 'id', 'barangs_id');
    }
}
