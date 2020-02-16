<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = ['url'];

    public function model()
    {
        return $this->morphTo();
    }
}
