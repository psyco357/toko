<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class TokoModel extends Model
{
    //
    use HasFactory, Notifiable;
    protected $table = 'mstoko';
    protected $fillable = [
        'nametoko',
        'alamattoko'
    ];
}
