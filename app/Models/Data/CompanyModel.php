<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CompanyModel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'mscompany';
    protected $fillable = [
        'namecompany',
        'alamatcompany',
        'logocompany',
        'emailcompany',
    ];
    public function barang()
    {
        return $this->hasMany(BarangModel::class, 'idcompany', 'id');
    }
}
