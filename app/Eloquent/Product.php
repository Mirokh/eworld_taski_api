<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['title', 'description'];

    public function gallery()
    {
        return $this->morphMany('App\Eloquent\Gallery', 'model', 'model')->where('is_main', 0);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Eloquent\Category');
    }
}
