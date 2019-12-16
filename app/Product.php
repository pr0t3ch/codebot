<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = ['image_full_url'];
    protected $fillable = ['title', 'subtitle', 'image_url', 'url'];

    protected function getImageFullUrlAttribute()
    {
        return 'https://' . env('AWS_BUCKET') . '.s3-' . env('AWS_REGION') . '.amazonaws.com/products/' . $this->attributes['image_url'] . '';
    }
}
