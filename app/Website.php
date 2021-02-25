<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $guarded = [];

    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    public function news()
    {
        return $this->hasMany('App\News');
    }
}