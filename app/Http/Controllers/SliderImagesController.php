<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SliderImagesController extends Controller
{
    public function getAllImages()
    {
        $images = DB::table('slider_images')->get();
        return response()->json([
            "message" => "get all images done",
            "data" => $images
        ]);
    }
}
