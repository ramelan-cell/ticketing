<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
