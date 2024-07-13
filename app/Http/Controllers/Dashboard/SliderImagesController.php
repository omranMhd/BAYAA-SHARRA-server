<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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
    public function saveImage(Request $request)
    {
        if ($request->hasFile("image")) {
            $image = $request->file("image");
            // $image->getClientOriginalName();
            // $image->getClientOriginalExtension();
            // $image->getClientMimeType();
            // $image->getSize();
            $path = $image->store('slider_images', ['disk' => 'public']);

            DB::table('slider_images')->insert(["url" => $path]);

            return response()->json([
                "message" => "add images done"
            ], 201);
        }
        return response()->json([
            "message" => "image file not found"
        ], 400);
    }
    public function deleteImage($image_id)
    {
        $image = DB::table('slider_images')->where('id', $image_id)->first();

        if ($image) {
            //احذف ملف الصورة
            Storage::disk('public')->delete($image->url);

            DB::table('slider_images')->where('id', $image_id)->delete();

            return response()->json([
                "message" => "image delete done"
            ]);
        } else {
            return response()->json([
                "message" => "no image with this id !"
            ], 404);
        }
    }
}
