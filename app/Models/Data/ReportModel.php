<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ReportModel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'tspenjualan';
    protected $fillable = [
        'idstok',
        'idtoko',
        'idbarang',
        'jual'
    ];

    // Relasi dengan CompanyModel
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'idbarang', 'id');
    }
    public function toko()
    {
        return $this->belongsTo(TokoModel::class, 'idtoko', 'id');
    }
    public function stok()
    {
        return $this->belongsTo(StokModel::class, 'idstok', 'id');
    }
}
