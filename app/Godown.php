<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Godown extends Model
{
    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }
}
