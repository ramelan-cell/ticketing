<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
