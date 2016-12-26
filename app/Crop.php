<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $table = 'crops';
    protected $fillable = [
        'photo_id', 'crop_image_name'
    ];
}
