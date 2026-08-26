<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'cat_id', 'recipe_title', 'video_url', 'video_id', 'recipe_image',
    'recipe_time', 'recipe_description', 'content_type', 'size',
    'featured', 'tags', 'total_views', 'last_update'
])]
class Recipe extends Model
{
    protected $primaryKey = 'recipe_id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'cid');
    }

    public function gallery()
    {
        return $this->hasMany(RecipeGallery::class, 'recipe_id', 'recipe_id');
    }
}
