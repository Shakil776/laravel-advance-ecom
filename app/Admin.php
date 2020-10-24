<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $guard = 'admin';
    protected $fillable = ['name', 'type', 'mobile', 'email', 'password', 'image', 'status'];
    protected $hidden =['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];
}
