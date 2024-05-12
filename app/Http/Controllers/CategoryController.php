<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // return all categories that have no parent
    public function mainCategories()
    {
        $categories =  Category::select("id", "name")->whereNull('parent_id')->get();
        return response()->json([
            'massage' => "get main categories is done",
            'data' => $categories,
        ]);
        // $names = [];
        // foreach ($categories as $category) {
        //     // Access the 'name' property and add it to the $names array
        //     $names[] = $category->name;
        // }

        // return $names;
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
