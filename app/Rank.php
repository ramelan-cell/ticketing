<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
