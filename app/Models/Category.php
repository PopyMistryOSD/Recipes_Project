<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['category_name', 'category_image', 'featured'])]
class Category extends Model
{
    protected $primaryKey = 'cid';

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'cat_id', 'cid');
    }
}
