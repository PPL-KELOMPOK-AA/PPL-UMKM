<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pemerintah extends Authenticatable
{
    protected $table = 'pemerintah';
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['username', 'password'];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];
}
