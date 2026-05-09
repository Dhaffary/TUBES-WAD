<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public function pesanans()
{
    return $this->hasMany(\App\Models\Pesanan::class);
}

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan role ada di sini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
}