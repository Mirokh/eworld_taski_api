<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description'];

    public function products()
    {
        return $this->belongsToMany('App\Eloquent\Product');
    }
}
