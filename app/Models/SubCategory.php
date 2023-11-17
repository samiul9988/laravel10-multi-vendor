<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class);
    }
}
