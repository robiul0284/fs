<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrettyCash extends Model
{
    public function pct()
    {
        return $this->belongsTo('App\PrettyCashType');
    }
}
