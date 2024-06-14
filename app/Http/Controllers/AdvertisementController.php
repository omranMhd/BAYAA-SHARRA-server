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
use App\Http\Requests\AddNewAdvertisementRequest;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ConvertAdvertForm;
use App\Http\Traits\CountriesInfo;

class AdvertisementController extends Controller
{
    use ConvertAdvertForm;
    use CountriesInfo;

    public function addNewAdvertisement(AddNewAdvertisementRequest $request)
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
                        "model" => $request->filterFields_model,
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
    public function getAllAdvertisement($user_id = null)
    {
        // here must return just active advertisements

        $paginatedAdvertisements = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')/*->inRandomOrder()*/->paginate(10);
        // dd($paginatedAdvertisements);
        $convertedAds = $this->convertToCardForm(collect($paginatedAdvertisements->items()), $user_id);

        $totalItems = Advertisement::count(); // Total items in the new data
        $current_page = request()->get('page', 1); // Get the current page number, default to 1 if not present
        $itemsPerPage = 10; // Define how many items you want to show per page

        $paginatedAds = new \Illuminate\Pagination\LengthAwarePaginator(
            $convertedAds,
            $totalItems,
            $itemsPerPage,
            $current_page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return response()->json([
            "message" => "Get Advertisements Successfully",
            "data" => $paginatedAds
        ]);

        ////////////////////////////////////////////////////////////////////////////////////////////




        // $advertisements = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->inRandomOrder()->get();
        // $convertedAds = $this->convertToCardForm($advertisements, $user_id);
        // return response()->json([
        //     "message" => "Get Advertisements Successfully",
        //     "data" => $convertedAds
        // ]);
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
            $owner["id"] = $ad->user->id;
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
            $advertisementDetails["location"] = $ad->location;
            $advertisementDetails["description"] = $ad->description;


            $translated_address = $this->getTranslatedCountryAndCityName(json_decode($ad->address)->country, json_decode($ad->address)->city);

            $advertisementDetails["address"] = $translated_address;


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
    public function similarAds($ad_id, $user_id = null)
    {

        // جيب الفئة يلي بينتمي الها هذا الإعلان
        $category = Advertisement::find($ad_id)->category;
        // جيب رقم الفئة يلي بينتمي لها هذا الإعلان
        $category_id = $category->id;
        // جيب كلشي اعلانات تابعة لهذه الفئة
        $similar_ids = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->take(3)->where('category_id', $category_id)->whereNot('id', $ad_id)->get();

        // اذا مالقينا اعلانات لهي الفئة 
        if ($similar_ids->count() == 0) {

            // شوف الفئة الحالية أساسية ولا فرعية
            $category_parent_id = $category->parent_id;

            // الفئة الحالية أساسية
            if ($category_parent_id ==  null) {
                //  جيب أي 3 اعلانات
                $similar_ids = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->take(3)->whereNot('id', $ad_id)->get();
            }
            // الفئة الحالية فرعية
            else {
                // جيب الفئة الأساسية الأب للفئة الحالية يلي هي فرعية
                $mainCategory = Category::find($category_parent_id);
                // جيب ارقام الفئات الفرعية التابعة للفئة الأساسية السابقة
                $childCategoriesIds =  $mainCategory->childCategories->map(function ($c) {
                    return $c->id;
                });

                $similar_ids = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->take(3)->whereIn('category_id', $childCategoriesIds)->whereNot('id', $ad_id)->get();

                if ($similar_ids->count() == 0) {
                    // رجع أي 3 اعلانات
                    $similar_ids =  Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->whereNot('id', $ad_id)->take(3)->get();
                }
                //  else {
                //     return $ads;
                // }
            }
        }

        // اذا لقيت اعلانات رجعها

        // return $similar_ids;

        $newAds = $this->convertToCardForm($similar_ids, $user_id);


        return response()->json([
            "message" => "Get similar Advertisements done Successfully",
            "data" => $newAds
        ]);
    }
}
