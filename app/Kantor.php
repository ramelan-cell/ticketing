<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
