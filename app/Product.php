<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['title', 'description'];

    public function gallery()
    {
        return $this->morphMany('App\Gallery', 'model', 'model')->where('is_main', 0);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
