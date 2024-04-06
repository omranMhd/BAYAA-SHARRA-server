<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'category_id', 'id');
    }
}
