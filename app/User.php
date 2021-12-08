<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','nik','id_kantor','id_unit','id_divisi','id_jabatan','id_rank'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function kantor()
    {
    return $this->hasOne(Kantor::class);
    }

    public function unit()
    {
    return $this->hasOne(Unit::class);
    }

    public function jabatan()
    {
    return $this->hasOne(Jabatan::class);
    }

    public function rank()
    {
    return $this->hasOne(Rank::class);
    }

    public function divisi()
    {
    return $this->hasOne(Divisi::class);
    }
}
