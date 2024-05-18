<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\ApartementFilter;
use App\Models\Category;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function addNewAdvertisement(Request $request)
    {

        return $request;
        // return var_dump($request->advertisement);
        // return $request->all();
        // return $request->get('advertisement');
        // return $request->photoes;

        // $advertisement = (object)$request->advertisement;
        // $filterFields = (object)$request->filterFields;
        // $photoes = (object)$request->formDataPhotoes;

        // $advertisement = collect($request->advertisement);
        // $filterFields = collect($request->filterFields);
        // $photoes = collect($request->formDataPhotoes);
        if ($request->hasFile("file_1")) {

            return "ok";
        }
        // return var_dump($photoes);

        // save advertisement info then return ad id to use it in save filterFields
        // $category_id = Category::where("name_en", $advertisement->category)->first()->id;
        // $ad_id = Advertisement::create([
        //     "user_id" => $advertisement->user_id,
        //     "category_id" => $category_id,
        //     "address" => $advertisement->address,
        //     // "location" => $advertisement->location,
        //     "title" => $advertisement->title,
        //     "description" => $advertisement->description,
        //     "contactNumber" => $advertisement->contactNumber,
        // ])->id;


        //save filterFields 
        // if ($advertisement->category == "Apartment") {
        //     ApartementFilter::create([
        //         "advertisement_id" => $ad_id,
        //         "area" => $filterFields->area,
        //         "floor" => $filterFields->floor,
        //         "roomCount" => $filterFields->roomCount,
        //         "cladding" => $filterFields->cladding,
        //         "price" => $filterFields->price,
        //         "currency" => $filterFields->currency,
        //         "molkia" => $filterFields->molkia,
        //         "sellOrRent" => $filterFields->sellOrRent,
        //         "paymentMethodRent" => $filterFields->paymentMethodRent,
        //         "direction" => $filterFields->direction,
        //     ]);
        // } else if ($request->advertisement->category == "Farm") {
        // } else if ($request->advertisement->category == "Land") {
        // } else if ($request->advertisement->category == "Commercial store") {
        // } else if ($request->advertisement->category == "Office") {
        // } else if ($request->advertisement->category == "Chalet") {
        // } else if ($request->advertisement->category == "Villa") {
        // }

        // return response()->json([
        //     "mesage" => "Advertisement created successfully"
        // ], 201);
    }
    public function getAllAdvertisement()
    {
    }
}
