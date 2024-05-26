<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\ApartementFilter;
use App\Models\Category;
use App\Models\ClothesFasionFilter;
use App\Models\ExecoarFilter;
use App\Models\CommercialStoresFilter;
use App\Models\CommonVehicleFilters;
use App\Models\ComputerFilter;
use App\Models\FarmFilter;
use App\Models\FurnitureFilter;
use App\Models\GeneralAdditionalFields;
use App\Models\Image;
use App\Models\LandFilter;
use App\Models\MobTabFilter;
use App\Models\OfficeFilter;
use App\Models\RestDevicesFilters;
use App\Models\ShalehFilter;
use App\Models\SparePartsVehicleFilters;
use App\Models\VellaFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends Controller
{
    public function addNewAdvertisement(Request $request)
    {
        try {
            $ad_id = null;
            DB::transaction(function () use ($request, &$ad_id) {
                // save advertisement info then return ad id to use it in save filterFields
                $category_id = Category::where("name_en", $request->advertisement_category)->first()->id;
                $ad_id = Advertisement::create([
                    "user_id" => $request->advertisement_user_id,
                    "category_id" => $category_id,
                    "address" => $request->advertisement_address,
                    "location" => $request->has('advertisement_location') ? $request->advertisement_location : null,
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
                        "ownership" => $request->filterFields_ownership,
                        "sellOrRent" => $request->filterFields_sellOrRent,
                        "paymentMethodRent" => $request->filterFields_paymentMethodRent,
                        "direction" => $request->filterFields_direction,
                    ]);
                } else if ($request->advertisement_category == "Farm") {
                    FarmFilter::create([
                        "advertisement_id" => $ad_id,
                        "area" => $request->filterFields_area,
                        "roomCount" => $request->filterFields_roomCount,
                        "cladding" => $request->filterFields_cladding,
                        "floorCount" => $request->filterFields_floorCount,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "ownership" => $request->filterFields_ownership,
                        "sellOrRent" => $request->filterFields_sellOrRent,
                        "paymentMethodRent" => $request->filterFields_paymentMethodRent,
                        "direction" => $request->filterFields_direction,
                    ]);
                } else if ($request->advertisement_category == "Land") {
                    LandFilter::create([
                        "advertisement_id" => $ad_id,
                        "area" => $request->filterFields_area,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "ownership" => $request->filterFields_ownership,
                        "sellOrRent" => $request->filterFields_sellOrRent,
                        "paymentMethodRent" => $request->filterFields_paymentMethodRent,
                    ]);
                } else if ($request->advertisement_category == "Commercial store") {
                    CommercialStoresFilter::create([
                        "advertisement_id" => $ad_id,
                        "area" => $request->filterFields_area,
                        "floor" => $request->filterFields_floor,
                        "cladding" => $request->filterFields_cladding,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "ownership" => $request->filterFields_ownership,
                        "sellOrRent" => $request->filterFields_sellOrRent,
                        "paymentMethodRent" => $request->filterFields_paymentMethodRent,
                    ]);
                } else if ($request->advertisement_category == "Office") {
                    OfficeFilter::create([
                        "advertisement_id" => $ad_id,
                        "area" => $request->filterFields_area,
                        "floor" => $request->filterFields_floor,
                        "roomCount" => $request->filterFields_roomCount,
                        "cladding" => $request->filterFields_cladding,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "ownership" => $request->filterFields_ownership,
                        "sellOrRent" => $request->filterFields_sellOrRent,
                        "paymentMethodRent" => $request->filterFields_paymentMethodRent,
                        "direction" => $request->filterFields_direction,

                    ]);
                } else if ($request->advertisement_category == "Chalet") {
                    ShalehFilter::create([
                        "advertisement_id" => $ad_id,
                        "area" => $request->filterFields_area,
                        "floor" => $request->filterFields_floor,
                        "roomCount" => $request->filterFields_roomCount,
                        "cladding" => $request->filterFields_cladding,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "ownership" => $request->filterFields_ownership,
                        "sellOrRent" => $request->filterFields_sellOrRent,
                        "paymentMethodRent" => $request->filterFields_paymentMethodRent,
                    ]);
                } else if ($request->advertisement_category == "Villa") {
                    VellaFilter::create([
                        "advertisement_id" => $ad_id,
                        "area" => $request->filterFields_area,
                        "roomCount" => $request->filterFields_roomCount,
                        "cladding" => $request->filterFields_cladding,
                        "floorCount" => $request->filterFields_floorCount,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "ownership" => $request->filterFields_ownership,
                        "sellOrRent" => $request->filterFields_sellOrRent,
                        "paymentMethodRent" => $request->filterFields_paymentMethodRent,
                        "direction" => $request->filterFields_direction,
                    ]);
                }
                //المركبات
                if ($request->advertisement_category == "Spare parts") {
                    SparePartsVehicleFilters::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "vehicleType" => $request->filterFields_vehicleType,
                        "status" => $request->filterFields_status,
                    ]);
                } else if (in_array($request->advertisement_category, ["Car", "Motorcycle", "Truck", "Bus", "Jabala", "Crane", "Bulldozer"])) {
                    CommonVehicleFilters::create([
                        "advertisement_id" => $ad_id,
                        "brand" => $request->filterFields_brand,
                        "category" => $request->filterFields_category,
                        "color" => $request->filterFields_color,
                        "gear" => $request->filterFields_gear,
                        "manufactureYear" => $request->filterFields_manufactureYear,
                        "traveledDistance" => $request->filterFields_traveledDistance,
                        "engineCapacity" => $request->filterFields_engineCapacity,
                        "fuel" => $request->filterFields_fuel,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "sellOrRent" => $request->filterFields_sellOrRent,
                        "paintStatus" => $request->filterFields_paintStatus,
                    ]);
                }
                //الأجهزة الإلكترونية والكهربائية
                if (in_array($request->advertisement_category, ["Mobile", "Tablet"])) {
                    MobTabFilter::create([
                        "advertisement_id" => $ad_id,
                        "brand" => $request->filterFields_brand,
                        "category" => $request->filterFields_category,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "ram" => $request->filterFields_ram,
                        "hard" => $request->filterFields_hard,
                        "status" => $request->filterFields_status,
                        "batteryStatus" => $request->filterFields_batteryStatus,
                    ]);
                } else if ($request->advertisement_category == "Computer") {
                    ComputerFilter::create([
                        "advertisement_id" => $ad_id,
                        "brand" => $request->filterFields_brand,
                        "category" => $request->filterFields_category,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "ram" => $request->filterFields_ram,
                        "hard" => $request->filterFields_hard,
                        "processor" => $request->filterFields_processor,
                        "status" => $request->filterFields_status,
                        "screenType" => $request->filterFields_screenType,
                        "screenSize" => $request->filterFields_screenSize,

                    ]);
                } else if ($request->advertisement_category == "Accessories") {
                    ExecoarFilter::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "deviceType" => $request->filterFields_deviceType,
                    ]);
                } else if (in_array($request->advertisement_category, ["Refrigerator", "Washing Machine", "Fan", "Heater", "Blenders juicers", "Oven Microwave", "Screen", "Receiver", "Solar Energy"])) {
                    RestDevicesFilters::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "deviceStatus" => $request->filterFields_status,
                    ]);
                }
                //المفروشات
                if (in_array($request->advertisement_category, ["Bedroom", "Table", "Chair", "Bed", "Cabinet", "Sofa"])) {
                    FurnitureFilter::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "material" => $request->filterFields_material,
                        "status" => $request->filterFields_status,
                    ]);
                }
                //ألبسة وموضة
                if (in_array($request->advertisement_category, ["Men", "Women", "children"])) {
                    ClothesFasionFilter::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                        "status" => $request->filterFields_status,
                        "type" => $request->filterFields_type,
                    ]);
                }
                //حيوانات
                if (in_array($request->advertisement_category, ["Livestock", "Birds", "Cat", "Dog", "Fish"])) {
                    GeneralAdditionalFields::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                    ]);
                }
                //مقتنيات شخصية
                if (in_array($request->advertisement_category, ["gift", "Perfume", "Makeup", "Watch", "Glass"])) {
                    GeneralAdditionalFields::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                    ]);
                }
                //طعام وشراب 
                if (in_array($request->advertisement_category, ["Restaurant", "Cafe", "Park", "Bakery"])) {
                    GeneralAdditionalFields::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                    ]);
                }
                //كتب وهوايات 
                if (in_array($request->advertisement_category, ["Book", "Stationery", "Musical Instrument"])) {
                    GeneralAdditionalFields::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                    ]);
                }
                // لوازم أطفال 
                if ($request->advertisement_category == "Children equipment") {
                    GeneralAdditionalFields::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                    ]);
                }
                //  رياضة ونوادي 
                if ($request->advertisement_category == "Sports and clubs") {
                    GeneralAdditionalFields::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                    ]);
                }
                // مستلزمات صناعية 
                if ($request->advertisement_category == "Industrial equipment") {
                    GeneralAdditionalFields::create([
                        "advertisement_id" => $ad_id,
                        "price" => $request->filterFields_price,
                        "currency" => $request->filterFields_currency,
                    ]);
                }

                // لا يوجد حقول اضافية للخدمات
                // لا يوجد حقول اضافية للوظائف

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
            });

            return response()->json([
                "mesage" => "Advertisement created successfully",
                "advertisement_id" => $ad_id
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "mesage" => "Oops !! , error !!",
                "error" => $e
            ], 500);
        }
    }
    public function getAllAdvertisement()
    {
        
    }
    //اعادة معلومات الاعلان وهي معلوماته الأساسية والصور وحقول الفلترة إن وجدت وبعض المعلومات عن صاحب الإعلان مثل الاسم والصورة والتقييم
    public function advertisementDetails($id)
    {
        // $ad = Advertisement::with("images","user")->find($id);
        $ad = Advertisement::find($id);
        $owner = [];
        $advertisementDetails = [];
        if ($ad != null) {

            // معلومات صاحب الإعلان
            $owner["fullName"] = $ad->user->firstName . " " . $ad->user->lastName;
            $owner["photo"] = $ad->user->image;
            $advertisementDetails["owner"] = $owner;

            $adPhotoes = array_map(function ($photo) {
                return $photo["url"];
            }, $ad->images->toArray());
            //صور الإعلان
            $advertisementDetails["adPhotoes"] = $adPhotoes;
            // الفئة التي ينتمي لها الإعلان
            $advertisementDetails["category"] = [
                "name_ar" => $ad->category->name_ar,
                "name_en" => $ad->category->name_en,
            ];
            $advertisementDetails["title"] = $ad->title;
            $advertisementDetails["description"] = $ad->description;
            $advertisementDetails["address"] = $ad->address;
            $advertisementDetails["contactNumber"] = $ad->contactNumber;
            $advertisementDetails["date"] = $ad->created_at;

            //RealEstates
            if ($ad->category->name_en == "Apartment") {
                $advertisementDetails["additionalAttributes"] = $ad->apartementFilter;
            } else if ($ad->category->name_en == "Farm") {
                $advertisementDetails["additionalAttributes"] = $ad->farmFilter;
            } else if ($ad->category->name_en == "Land") {
                $advertisementDetails["additionalAttributes"] = $ad->landFilter;
            } else if ($ad->category->name_en == "Commercial store") {
                $advertisementDetails["additionalAttributes"] = $ad->commercialStoreFilter;
            } else if ($ad->category->name_en == "Office") {
                $advertisementDetails["additionalAttributes"] =  $ad->officeFilter;
            } else if ($ad->category->name_en == "Chalet") {
                $advertisementDetails["additionalAttributes"] = $ad->shalehFilter;
            } else if ($ad->category->name_en == "Villa") {
                $advertisementDetails["additionalAttributes"] = $ad->vellaFilter;
            } else if (in_array($ad->category->name_en, ["Car", "Motorcycle", "Truck", "Bus", "Jabala", "Crane", "Bulldozer"])) {
                $advertisementDetails["additionalAttributes"] = $ad->commonVehicleFilter;
            } else if ($ad->category->name_en == "Spare parts") {
                $advertisementDetails["additionalAttributes"] = $ad->sparePartsVehicleFilter;
            } else if (in_array($ad->category->name_en, ["Mobile", "Tablet"])) {
                $advertisementDetails["additionalAttributes"] = $ad->mobTabFilter;
            } else if ($ad->category->name_en == "Computer") {
                $advertisementDetails["additionalAttributes"] = $ad->computerFilter;
            } else if ($ad->category->name_en == "Accessories") {
                $advertisementDetails["additionalAttributes"] = $ad->execoarFilter;
            } else if (in_array(
                $ad->category->name_en,
                ["Refrigerator", "Washing Machine", "Fan", "Heater", "Blenders juicers", "Oven Microwave", "Screen", "Receiver", "Solar Energy"]
            )) {
                $advertisementDetails["additionalAttributes"] = $ad->restDevicesFilter;
            } else if (in_array(
                $ad->category->name_en,
                ["Bedroom", "Table", "Chair", "Bed", "Cabinet", "Sofa"]
            )) {
                $advertisementDetails["additionalAttributes"] = $ad->furnitureFilter;
            } else if (in_array(
                $ad->category->name_en,
                ["Men", "Women", "children"]
            )) {
                $advertisementDetails["additionalAttributes"] = $ad->clothesFasionFilter;
            } else if (in_array(
                $ad->category->name_en,
                ["Livestock", "Birds", "Cat", "Dog", "Fish"]
            )) {
                $advertisementDetails["additionalAttributes"] = $ad->generalAdditionalField;
            } else if (in_array(
                $ad->category->name_en,
                ["gift", "Perfume", "Makeup", "Watch", "Glass"]
            )) {
                $advertisementDetails["additionalAttributes"] = $ad->generalAdditionalField;
            } else if (in_array(
                $ad->category->name_en,
                ["Restaurant", "Cafe", "Park", "Bakery"]
            )) {
                $advertisementDetails["additionalAttributes"] = $ad->generalAdditionalField;
            } else if (in_array(
                $ad->category->name_en,
                ["Book", "Stationery", "Musical Instrument"]
            )) {
                $advertisementDetails["additionalAttributes"] = $ad->generalAdditionalField;
            } else if ($ad->category->name_en == "Children equipment") {
                $advertisementDetails["additionalAttributes"] = $ad->generalAdditionalField;
            } else if ($ad->category->name_en == "Sports and clubs") {
                $advertisementDetails["additionalAttributes"] = $ad->generalAdditionalField;
            } else if ($ad->category->name_en == "Industrial equipment") {
                $advertisementDetails["additionalAttributes"] = $ad->generalAdditionalField;
            }





            // return $adPhotoes;
            // return $owner;
            // return $advertisementDetails;
            // return $ad;
            return response()->json([
                "message" => "get advertisement details successfully",
                "data" => $advertisementDetails
            ]);
        } else {
            return response()->json([
                "message" => "no ad with this id"
            ], 404);
        }
    }
}
