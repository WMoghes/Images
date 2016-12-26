<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'image_name',
        'image_original_name',
        'image_size',
        'image_type',
        'position'
    ];
}
