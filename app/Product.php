<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function inventories()
    {
        return $this->hasMany('App\Inventory');
    }
}

