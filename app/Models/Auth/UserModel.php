<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;

class UserModel extends Model
{
    use HasFactory, Notifiable;
    //
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'username',
        'password',
        'idcompany',
        'idtoko'
    ];
}
