<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // return all categories that have no parent
    public function mainCategories()
    {
        $categories =  Category::select("id", "name_ar", "name_en")->whereNull('parent_id')->get();
        return response()->json([
            'massage' => "get main categories is done",
            'data' => $categories,
        ]);
    }
    public function subCategories($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'massage' => "get sub categories is done",
                'data' => $category->childCategories,
            ]);
        } else {
            return response()->json([
                'massage' => "no category with this id",
            ], 400);
        }
    }
}
