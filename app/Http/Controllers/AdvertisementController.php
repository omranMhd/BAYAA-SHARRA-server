<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\ApartementFilter;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function addNewAdvertisement(Request $request)
    {

        // save advertisement info then return ad id to use it in save filterFields
        $category_id = Category::where("name_en", $request->advertisement_category)->first()->id;
        $ad_id = Advertisement::create([
            "user_id" => $request->advertisement_user_id,
            "category_id" => $category_id,
            "address" => $request->advertisement_address,
            // "location" => $advertisement->location,
            "title" => $request->advertisement_title,
            "description" => $request->advertisement_description,
            "contactNumber" => $request->advertisement_contactNumber,
        ])->id;


        //save filterFields 
        if ($request->advertisement_category == "Apartment") {
            ApartementFilter::create([
                "advertisement_id" => $ad_id,
                "area" => $request->filterFields_area,
                "floor" => $request->filterFields_floor,
                "roomCount" => $request->filterFields_roomCount,
                "cladding" => $request->filterFields_cladding,
                "price" => $request->filterFields_price,
                "currency" => $request->filterFields_currency,
                "molkia" => $request->filterFields_molkia,
                "sellOrRent" => $request->filterFields_sellOrRent,
                "paymentMethodRent" => $request->filterFields_paymentMethodRent,
                "direction" => $request->filterFields_direction,
            ]);
        } else if ($request->advertisement->category == "Farm") {
        } else if ($request->advertisement->category == "Land") {
        } else if ($request->advertisement->category == "Commercial store") {
        } else if ($request->advertisement->category == "Office") {
        } else if ($request->advertisement->category == "Chalet") {
        } else if ($request->advertisement->category == "Villa") {
        }

        //save photoes
        for ($i = 1; $i <= 6; $i++) {

            if ($request->hasFile("photo_$i")) {

                $photo = $request->file("photo_$i");
                $photo->getClientOriginalName();
                $photo->getClientOriginalExtension();
                $photo->getClientMimeType();
                $photo->getSize();
                $path = $photo->store('advertisements_photoes', ['disk' => 'public']);
                Image::create([
                    'url' => $path,
                    'advertisement_id' => $ad_id,
                ]);
            }
        }


        return response()->json([
            "mesage" => "Advertisement created successfully"
        ], 201);
    }
    public function getAllAdvertisement()
    {
    }
}
