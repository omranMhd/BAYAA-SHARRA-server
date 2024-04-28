<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // return all categories that have no parent
    public function mainCategories()
    {
        $categories =  Category::select("name")->whereNull('parent_id')->get();
        $names = [];
        foreach ($categories as $category) {
            // Access the 'name' property and add it to the $names array
            $names[] = $category->name;
        }

        return $names;
    }
}
