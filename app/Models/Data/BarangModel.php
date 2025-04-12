<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BarangModel extends Model
{
    //
    use HasFactory, Notifiable;
    protected $table = 'msbarang';
    protected $fillable = [
        'idcompany',
        'namebarang',
        'harga'
    ];

    // Relasi dengan CompanyModel
    public function company()
    {
        return $this->belongsTo(CompanyModel::class, 'idcompany', 'id');
    }
}
