<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StokModel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'msstok';
    protected $fillable = [
        'idproduk',
        'idtoko',
        'jumlah'
    ];

    // Relasi dengan CompanyModel
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'idproduk', 'id');
    }
    public function toko()
    {
        return $this->belongsTo(TokoModel::class, 'idtoko', 'id');
    }
}
