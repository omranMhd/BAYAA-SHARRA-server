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
use App\Models\Complaint;
use Illuminate\Support\Facades\Storage;

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
                } else if ($request->advertisement_category == "Store") {
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

        $paginatedAdvertisements = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->where("status", "active")/*->inRandomOrder()*/->orderBy('created_at', 'desc')->paginate(10);
        // dd($paginatedAdvertisements);
        $convertedAds = $this->convertToCardForm(collect($paginatedAdvertisements->items()), $user_id);

        $totalItems = Advertisement::where("status", "active")->count(); // Total items in the new data
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
            $advertisementDetails["rejectionReason"] = $ad->rejectionReason;
            $advertisementDetails["status"] = $ad->status;
            $advertisementDetails["paidFortus"] = $ad->paidFor;


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
            } else if ($ad->category->name_en == "Store") {
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
        $similar_ids = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->take(3)->where("status", "active")->where('category_id', $category_id)->whereNot('id', $ad_id)->inRandomOrder()->get();

        // اذا مالقينا اعلانات لهي الفئة 
        if ($similar_ids->count() == 0) {

            // شوف الفئة الحالية أساسية ولا فرعية
            $category_parent_id = $category->parent_id;

            // الفئة الحالية أساسية
            if ($category_parent_id ==  null) {
                //  جيب أي 3 اعلانات
                $similar_ids = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->take(3)->where("status", "active")->whereNot('id', $ad_id)->inRandomOrder()->get();
            }
            // الفئة الحالية فرعية
            else {
                // جيب الفئة الأساسية الأب للفئة الحالية يلي هي فرعية
                $mainCategory = Category::find($category_parent_id);
                // جيب ارقام الفئات الفرعية التابعة للفئة الأساسية السابقة
                $childCategoriesIds =  $mainCategory->childCategories->map(function ($c) {
                    return $c->id;
                });

                $similar_ids = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->take(3)->where("status", "active")->whereIn('category_id', $childCategoriesIds)->whereNot('id', $ad_id)->inRandomOrder()->get();

                if ($similar_ids->count() == 0) {
                    // رجع أي 3 اعلانات
                    $similar_ids =  Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->where("status", "active")->whereNot('id', $ad_id)->take(3)->inRandomOrder()->get();
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
    public function advertisementsFilter(Request $request, $user_id = null)
    {

        // return $request;
        if ($request->has('category')) {
            $category_name = $request->query('category');
            if (Category::where('name_en', $category_name)->exists()) {

                $category = Category::where('name_en', $category_name)->first();
                $category_id = $category->id;
                $filterdAds = [];

                // if category is main category
                if ($category->parent_id == null) {
                    // get subcategory
                    $subCategories_ids = $category->childCategories->map(function ($c) {
                        return $c->id;
                    });

                    // if this main category do not have subcategories
                    if (count($subCategories_ids) == 0) {
                        // for example  "Industrial equipment" category
                        $filterdAds = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->where("status", "active")->where('category_id', $category_id)->get();
                    }
                    // if this main category  have subcategories
                    else if (count($subCategories_ids) > 0) {
                        // for example  "RealEstates" category
                        $filterdAds = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->where("status", "active")->whereIn('category_id', $subCategories_ids)->get();
                    }
                }
                // if category is sub category
                else {
                    $filterdAds = Advertisement::select('id', 'created_at', 'address', 'title', 'category_id')->where("status", "active")->where('category_id', $category_id)->get();
                }

                // اذا معيار البلد موجود
                if ($request->has('country')) {
                    $country = $request->query('country');
                    $filterdAds = $filterdAds->filter(function ($ads) use ($country) {
                        return $country === json_decode($ads->address)->country;
                    })->values();
                    //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                    // indexes
                }

                // اذا معيار المدينة موجود
                if ($request->has('city')) {
                    $city = $request->query('city');
                    $filterdAds = $filterdAds->filter(function ($ads) use ($city) {
                        return $city === json_decode($ads->address)->city;
                    })->values();
                    //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                    // indexes
                }

                if ($category_name == "Apartment") {
                    // اذا معيار بيع او اجار موجود
                    if ($request->has('sellOrRent')) {
                        $sellOrRent = $request->query('sellOrRent');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sellOrRent) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $sellOrRent === $apartementFilter->sellOrRent;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من المساحة موجود
                    if ($request->has('areaFrom')) {
                        $areaFrom = $request->query('areaFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaFrom) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $areaFrom <= $apartementFilter->area;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأعلى من المساحة موجود
                    if ($request->has('areaTo')) {
                        $areaTo = $request->query('areaTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaTo) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->area <= $areaTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الملكية موجود
                    if ($request->has('ownership')) {
                        $ownership = $request->query('ownership');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($ownership) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->ownership === $ownership;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الاتجاه موجود
                    if ($request->has('direction')) {
                        $direction = $request->query('direction');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($direction) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->direction === $direction;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار عدد الغرف موجود
                    if ($request->has('roomCount')) {
                        $roomCount = $request->query('roomCount');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($roomCount) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->roomCount == $roomCount;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار رقم الطابق موجود
                    if ($request->has('floor')) {
                        $floor = $request->query('floor');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($floor) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->floor == $floor;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الأكساء موجود
                    if ($request->has('cladding')) {
                        $cladding = $request->query('cladding');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($cladding) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->cladding == $cladding;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }

                if ($category_name == "Farm") {
                    // اذا معيار بيع او اجار موجود
                    if ($request->has('sellOrRent')) {
                        $sellOrRent = $request->query('sellOrRent');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sellOrRent) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $sellOrRent === $apartementFilter->sellOrRent;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من المساحة موجود
                    if ($request->has('areaFrom')) {
                        $areaFrom = $request->query('areaFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaFrom) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $areaFrom <= $apartementFilter->area;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأعلى من المساحة موجود
                    if ($request->has('areaTo')) {
                        $areaTo = $request->query('areaTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaTo) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->area <= $areaTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الملكية موجود
                    if ($request->has('ownership')) {
                        $ownership = $request->query('ownership');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($ownership) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->ownership === $ownership;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الاتجاه موجود
                    if ($request->has('direction')) {
                        $direction = $request->query('direction');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($direction) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->direction === $direction;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار عدد الغرف موجود
                    if ($request->has('roomCount')) {
                        $roomCount = $request->query('roomCount');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($roomCount) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->roomCount == $roomCount;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار عدد الطوابق موجود
                    if ($request->has('floorsCount')) {
                        $floorsCount = $request->query('floorsCount');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($floorsCount) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->floorsCount == $floorsCount;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الأكساء موجود
                    if ($request->has('cladding')) {
                        $cladding = $request->query('cladding');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($cladding) {
                            $apartementFilter = FarmFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->cladding == $cladding;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if ($category_name == "Land") {
                    // اذا معيار بيع او اجار موجود
                    if ($request->has('sellOrRent')) {
                        $sellOrRent = $request->query('sellOrRent');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sellOrRent) {
                            $apartementFilter = LandFilter::where('advertisement_id', $ad->id)->first();
                            return $sellOrRent === $apartementFilter->sellOrRent;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من المساحة موجود
                    if ($request->has('areaFrom')) {
                        $areaFrom = $request->query('areaFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaFrom) {
                            $apartementFilter = LandFilter::where('advertisement_id', $ad->id)->first();
                            return $areaFrom <= $apartementFilter->area;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأعلى من المساحة موجود
                    if ($request->has('areaTo')) {
                        $areaTo = $request->query('areaTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaTo) {
                            $apartementFilter = LandFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->area <= $areaTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الملكية موجود
                    if ($request->has('ownership')) {
                        $ownership = $request->query('ownership');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($ownership) {
                            $apartementFilter = LandFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->ownership === $ownership;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = LandFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = LandFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = LandFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }

                if ($category_name == "Store") {
                    // اذا معيار بيع او اجار موجود
                    if ($request->has('sellOrRent')) {
                        $sellOrRent = $request->query('sellOrRent');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sellOrRent) {
                            $apartementFilter = CommercialStoresFilter::where('advertisement_id', $ad->id)->first();
                            return $sellOrRent === $apartementFilter->sellOrRent;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من المساحة موجود
                    if ($request->has('areaFrom')) {
                        $areaFrom = $request->query('areaFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaFrom) {
                            $apartementFilter = CommercialStoresFilter::where('advertisement_id', $ad->id)->first();
                            return $areaFrom <= $apartementFilter->area;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأعلى من المساحة موجود
                    if ($request->has('areaTo')) {
                        $areaTo = $request->query('areaTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaTo) {
                            $apartementFilter = CommercialStoresFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->area <= $areaTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الملكية موجود
                    if ($request->has('ownership')) {
                        $ownership = $request->query('ownership');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($ownership) {
                            $apartementFilter = CommercialStoresFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->ownership === $ownership;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = CommercialStoresFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = CommercialStoresFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = CommercialStoresFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }


                    // اذا معيار رقم الطابق موجود
                    if ($request->has('floor')) {
                        $floor = $request->query('floor');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($floor) {
                            $apartementFilter = CommercialStoresFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->floor == $floor;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الأكساء موجود
                    if ($request->has('cladding')) {
                        $cladding = $request->query('cladding');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($cladding) {
                            $apartementFilter = ApartementFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->cladding == $cladding;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if ($category_name == "Office") {
                    // اذا معيار بيع او اجار موجود
                    if ($request->has('sellOrRent')) {
                        $sellOrRent = $request->query('sellOrRent');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sellOrRent) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $sellOrRent === $apartementFilter->sellOrRent;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من المساحة موجود
                    if ($request->has('areaFrom')) {
                        $areaFrom = $request->query('areaFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaFrom) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $areaFrom <= $apartementFilter->area;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من المساحة موجود
                    if ($request->has('areaTo')) {
                        $areaTo = $request->query('areaTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaTo) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->area <= $areaTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع الملكية موجود
                    if ($request->has('ownership')) {
                        $ownership = $request->query('ownership');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($ownership) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->ownership === $ownership;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار رقم الطابق موجود
                    if ($request->has('floor')) {
                        $floor = $request->query('floor');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($floor) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->floor == $floor;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع الأكساء موجود
                    if ($request->has('cladding')) {
                        $cladding = $request->query('cladding');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($cladding) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->cladding == $cladding;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الاتجاه موجود
                    if ($request->has('direction')) {
                        $direction = $request->query('direction');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($direction) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->direction === $direction;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار عدد الغرف موجود
                    if ($request->has('roomCount')) {
                        $roomCount = $request->query('roomCount');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($roomCount) {
                            $apartementFilter = OfficeFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->roomCount === $roomCount;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if ($category_name == "Chalet") {
                    // اذا معيار بيع او اجار موجود
                    if ($request->has('sellOrRent')) {
                        $sellOrRent = $request->query('sellOrRent');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sellOrRent) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $sellOrRent === $apartementFilter->sellOrRent;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من المساحة موجود
                    if ($request->has('areaFrom')) {
                        $areaFrom = $request->query('areaFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaFrom) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $areaFrom <= $apartementFilter->area;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من المساحة موجود
                    if ($request->has('areaTo')) {
                        $areaTo = $request->query('areaTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaTo) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->area <= $areaTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع الملكية موجود
                    if ($request->has('ownership')) {
                        $ownership = $request->query('ownership');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($ownership) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->ownership === $ownership;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار رقم الطابق موجود
                    if ($request->has('floor')) {
                        $floor = $request->query('floor');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($floor) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->floor == $floor;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع الأكساء موجود
                    if ($request->has('cladding')) {
                        $cladding = $request->query('cladding');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($cladding) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->cladding == $cladding;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار عدد الغرف موجود
                    if ($request->has('roomCount')) {
                        $roomCount = $request->query('roomCount');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($roomCount) {
                            $apartementFilter = ShalehFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->roomCount === $roomCount;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if ($category_name == "Villa") {
                    // اذا معيار بيع او اجار موجود
                    if ($request->has('sellOrRent')) {
                        $sellOrRent = $request->query('sellOrRent');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sellOrRent) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $sellOrRent === $apartementFilter->sellOrRent;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من المساحة موجود
                    if ($request->has('areaFrom')) {
                        $areaFrom = $request->query('areaFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaFrom) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $areaFrom <= $apartementFilter->area;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من المساحة موجود
                    if ($request->has('areaTo')) {
                        $areaTo = $request->query('areaTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($areaTo) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->area <= $areaTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع الملكية موجود
                    if ($request->has('ownership')) {
                        $ownership = $request->query('ownership');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($ownership) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->ownership === $ownership;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الاتجاه موجود
                    if ($request->has('direction')) {
                        $direction = $request->query('direction');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($direction) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->direction === $direction;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار عدد الغرف موجود
                    if ($request->has('roomCount')) {
                        $roomCount = $request->query('roomCount');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($roomCount) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->roomCount === $roomCount;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الأكساء موجود
                    if ($request->has('cladding')) {
                        $cladding = $request->query('cladding');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($cladding) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->cladding == $cladding;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار عدد الطوابق موجود
                    if ($request->has('floorsCount')) {
                        $floorsCount = $request->query('floorsCount');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($floorsCount) {
                            $apartementFilter = VellaFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->floorsCount == $floorsCount;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }

                if (in_array($category_name, ["Car", "Motorcycle", "Truck", "Bus", "Jabala", "Crane", "Bulldozer"])) {
                    // اذا معيار بيع او اجار موجود
                    if ($request->has('sellOrRent')) {
                        $sellOrRent = $request->query('sellOrRent');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sellOrRent) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $sellOrRent === $apartementFilter->sellOrRent;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }


                    // اذا معيار ماركة المركبة موجود
                    if ($request->has('vehicleBrand')) {
                        $vehicleBrand = $request->query('vehicleBrand');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($vehicleBrand) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->brand == $vehicleBrand;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار موديل المركبة موجود
                    if ($request->has('vehicleModel')) {
                        $vehicleModel = $request->query('vehicleModel');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($vehicleModel) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->model == $vehicleModel;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار حالة الطلاء موجود
                    if ($request->has('paintStatus')) {
                        $paintStatus = $request->query('paintStatus');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($paintStatus) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->paintStatus == $paintStatus;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار لون المركبة موجود
                    if ($request->has('vehicleColor')) {
                        $vehicleColor = $request->query('vehicleColor');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($vehicleColor) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->color == $vehicleColor;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار ناقل الحركة موجود
                    if ($request->has('gear')) {
                        $gear = $request->query('gear');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($gear) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->gear == $gear;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار الوقود موجود
                    if ($request->has('fuel')) {
                        $fuel = $request->query('fuel');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($fuel) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->fuel == $fuel;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = CommonVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                } else if ($category_name === "Spare parts") {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = SparePartsVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = SparePartsVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = SparePartsVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع المركبة التي تصلح لها قطعة الغيار موجود
                    if ($request->has('sparePartVehicleType')) {
                        $sparePartVehicleType = $request->query('sparePartVehicleType');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sparePartVehicleType) {
                            $apartementFilter = SparePartsVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->vehicleType === $sparePartVehicleType;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار حالة قطعة الغيار موجود
                    if ($request->has('sparePartStatus')) {
                        $sparePartStatus = $request->query('sparePartStatus');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($sparePartStatus) {
                            $apartementFilter = SparePartsVehicleFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->status === $sparePartStatus;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if ($category_name === "Mobile" || $category_name === "Tablet") {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = MobTabFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = MobTabFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = MobTabFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار ماركة الموبايل او لتاب موجود
                    if ($request->has('mobOrTabBrand')) {
                        $mobOrTabBrand = $request->query('mobOrTabBrand');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($mobOrTabBrand) {
                            $apartementFilter = MobTabFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->brand === $mobOrTabBrand;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار فئة الموبايل او التاب موجود
                    if ($request->has('mobOrTabCategory')) {
                        $mobOrTabCategory = $request->query('mobOrTabCategory');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($mobOrTabCategory) {
                            $apartementFilter = MobTabFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->category === $mobOrTabCategory;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار حالة الجهاز موجود
                    if ($request->has('deviceStatus')) {
                        $deviceStatus = $request->query('deviceStatus');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($deviceStatus) {
                            $apartementFilter = MobTabFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->status === $deviceStatus;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار حالة البطارية موجود
                    if ($request->has('batteryStatus')) {
                        $batteryStatus = $request->query('batteryStatus');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($batteryStatus) {
                            $apartementFilter = MobTabFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->batteryStatus === $batteryStatus;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if ($category_name === "Computer") {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار ماركة الكومبوتر موجود
                    if ($request->has('computerBrand')) {
                        $computerBrand = $request->query('computerBrand');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($computerBrand) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->brand === $computerBrand;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار فئة الكومبيوتر موجود
                    if ($request->has('computerCategory')) {
                        $computerCategory = $request->query('computerCategory');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($computerCategory) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->category === $computerCategory;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار حالة الجهاز موجود
                    if ($request->has('deviceStatus')) {
                        $deviceStatus = $request->query('deviceStatus');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($deviceStatus) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->status === $deviceStatus;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار المعالج موجود
                    if ($request->has('processor')) {
                        $processor = $request->query('processor');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($processor) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->processor === $processor;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الشاشة موجود
                    if ($request->has('screenType')) {
                        $screenType = $request->query('screenType');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($screenType) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->screenType === $screenType;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار قياس الشاشة موجود
                    if ($request->has('screenSize')) {
                        $screenSize = $request->query('screenSize');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($screenSize) {
                            $apartementFilter = ComputerFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->screenSize === $screenSize;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if ($category_name === "Accessories") {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = ExecoarFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = ExecoarFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = ExecoarFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع الجهاز الذي تصلح له موجود
                    if ($request->has('accessoriesDeviceType')) {
                        $accessoriesDeviceType = $request->query('accessoriesDeviceType');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($accessoriesDeviceType) {
                            $apartementFilter = ExecoarFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->deviceType === $accessoriesDeviceType;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if (in_array(
                    $category_name,
                    ["Refrigerator", "Washing Machine", "Fan", "Heater", "Blenders juicers", "Oven Microwave", "Screen", "Receiver", "Solar Energy"]
                )) {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = RestDevicesFilters::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = RestDevicesFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = RestDevicesFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار حالة الجهاز موجود
                    if ($request->has('deviceStatus')) {
                        $deviceStatus = $request->query('deviceStatus');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($deviceStatus) {
                            $apartementFilter = RestDevicesFilters::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->status === $deviceStatus;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if (in_array(
                    $category_name,
                    ["Bedroom", "Table", "Chair", "Bed", "Cabinet", "Sofa"]
                )) {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = FurnitureFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = FurnitureFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = FurnitureFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار مادة الصنع موجود
                    if ($request->has('material')) {
                        $material = $request->query('material');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($material) {
                            $apartementFilter = FurnitureFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->material === $material;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار حالة الأثاث موجود
                    if ($request->has('furnitureStatus')) {
                        $furnitureStatus = $request->query('furnitureStatus');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($furnitureStatus) {
                            $apartementFilter = FurnitureFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->status === $furnitureStatus;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if (in_array(
                    $category_name,
                    ["Men", "Women", "children"]
                )) {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = ClothesFasionFilter::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = ClothesFasionFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = ClothesFasionFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار حالة اللباس موجود
                    if ($request->has('clothesStatus')) {
                        $clothesStatus = $request->query('clothesStatus');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($clothesStatus) {
                            $apartementFilter = FurnitureFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->status === $clothesStatus;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                    // اذا معيار نوع اللباس موجود
                    if ($request->has('clothesType')) {
                        $clothesType = $request->query('clothesType');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($clothesType) {
                            $apartementFilter = FurnitureFilter::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->type === $clothesType;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if (in_array(
                    $category_name,
                    ["Livestock", "Birds", "Cat", "Dog", "Fish"]
                )) {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if (in_array(
                    $category_name,
                    ["gift", "Perfume", "Makeup", "Watch", "Glass"]
                )) {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if (in_array(
                    $category_name,
                    ["Restaurant", "Cafe", "Park", "Bakery"]
                )) {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if (in_array(
                    $category_name,
                    ["Book", "Stationery", "Musical Instrument"]
                )) {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }
                if (in_array(
                    $category_name,
                    ["Industrial equipment", "Sports and clubs", "Children equipment"]
                )) {
                    // اذا معيار الحد الأدنى من السعر موجود
                    if ($request->has('priceFrom')) {
                        $priceFrom = $request->query('priceFrom');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceFrom) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $priceFrom <= $apartementFilter->price;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار الحد الأعلى من السعر موجود
                    if ($request->has('priceTo')) {
                        $priceTo = $request->query('priceTo');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($priceTo) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->price <= $priceTo;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }

                    // اذا معيار نوع العملة موجود
                    if ($request->has('currency')) {
                        $currency = $request->query('currency');
                        $filterdAds = $filterdAds->filter(function ($ad) use ($currency) {
                            $apartementFilter = GeneralAdditionalFields::where('advertisement_id', $ad->id)->first();
                            return $apartementFilter->currency === $currency;
                        })->values();
                        //هون استدعيت هذا التابع مشان ترجع النتيجة بدون
                        // indexes
                    }
                }









                // return $filterdAds;



                $convertedAds = $this->convertToCardForm($filterdAds, $user_id);


                return response()->json([
                    "message" => "Get filterd Advertisements done Successfully",
                    "data" => $convertedAds
                ]);
            } else {
                return response()->json([
                    "message" => "no category with this name"
                ], 404);
            }
        } else {
            return response()->json([
                "message" => "request must have category field"
            ], 400);
        }
    }
    public function advertisementsSearch(Request $request, $user_id = null)
    {
        // return $request->query("search");

        $wordsArray = explode(" ", $request->query("search"));
        // return $wordsArray;
        $query = Advertisement::query();
        foreach ($wordsArray as $word) {
            $query->where('title', 'like', "%{$word}%");
        }
        $ads = $query->select('id', 'created_at', 'address', 'title', 'category_id')->where("status", "active")->get();

        if ($ads->count() == 0) {
            foreach ($wordsArray as $word) {
                $query->orWhere('title', 'like', "%{$word}%");
            }
        }
        $ads = $query->select('id', 'created_at', 'address', 'title', 'category_id')->where("status", "active")->get();


        $convertedAds = $this->convertToCardForm($ads, $user_id);


        return response()->json([
            "message" => "Get searched Advertisements done Successfully",
            "data" => $convertedAds
        ]);
        return $ads;
    }
    public function getAllUserAdvertisements($user_id)
    {
        $advertisements = Advertisement::with("category")->select("id", "category_id", "title", "status", "paidFor", "address")->where("user_id", $user_id)->get();
        $tempAd = [];
        $newAds = $advertisements->map(function ($ad, $index) use ($tempAd, $user_id) {
            // dd($ad->toArray());
            $tempAd = $ad->toArray();


            $tempAd["address"] = $this->getTranslatedCountryAndCityName(json_decode($tempAd["address"])->country, json_decode($tempAd["address"])->city);



            // //load category
            // $ad->load(['category' => function ($query) {
            //     $query->select('id', 'name_en'); // Specify the columns to select for the 'books' relationship
            // }]);




            if ($ad->category->name_en == "Apartment") {
                $ad->load('apartementFilter');
                $tempAd['price'] = $ad->apartementFilter?->price;
                $tempAd['newPrice'] = $ad->apartementFilter?->newPrice;
                $tempAd['currency'] = $ad->apartementFilter?->currency;
            }
            // dd($tempAd);
            if ($ad->category->name_en == "Farm") {

                $ad->load('farmFilter');
                $tempAd['price'] = $ad->farmFilter?->price;
                $tempAd['newPrice'] = $ad->farmFilter?->newPrice;
                $tempAd['currency'] = $ad->farmFilter?->currency;
            }
            if ($ad->category->name_en == "Land") {

                $ad->load('landFilter');
                $tempAd['price'] = $ad->landFilter?->price;
                $tempAd['newPrice'] = $ad->landFilter?->newPrice;
                $tempAd['currency'] = $ad->landFilter?->currency;
            }
            if ($ad->category->name_en == "Store") {

                $ad->load('commercialStoreFilter');
                $tempAd['price'] = $ad->commercialStoreFilter?->price;
                $tempAd['newPrice'] = $ad->commercialStoreFilter?->newPrice;
                $tempAd['currency'] = $ad->commercialStoreFilter?->currency;
            }
            if ($ad->category->name_en == "Office") {

                $ad->load('officeFilter');
                $tempAd['price'] = $ad->officeFilter?->price;
                $tempAd['newPrice'] = $ad->officeFilter?->newPrice;
                $tempAd['currency'] = $ad->officeFilter?->currency;
            }
            if ($ad->category->name_en == "Chalet") {

                $ad->load('shalehFilter');
                $tempAd['price'] = $ad->shalehFilter?->price;
                $tempAd['newPrice'] = $ad->shalehFilter?->newPrice;
                $tempAd['currency'] = $ad->shalehFilter?->currency;
            }
            if ($ad->category->name_en == "Villa") {

                $ad->load('vellaFilter');
                $tempAd['price'] = $ad->vellaFilter?->price;
                $tempAd['newPrice'] = $ad->vellaFilter?->newPrice;
                $tempAd['currency'] = $ad->vellaFilter?->currency;
            }
            if ($ad->category->name_en == "Spare parts") {

                $ad->load('sparePartsVehicleFilter');
                $tempAd['price'] = $ad->sparePartsVehicleFilter?->price;
                $tempAd['newPrice'] = $ad->sparePartsVehicleFilter?->newPrice;
                $tempAd['currency'] = $ad->sparePartsVehicleFilter?->currency;
            }
            if (in_array($ad->category->name_en, ["Car", "Motorcycle", "Truck", "Bus", "Jabala", "Crane", "Bulldozer"])) {

                $ad->load('commonVehicleFilter');
                $tempAd['price'] = $ad->commonVehicleFilter?->price;
                $tempAd['newPrice'] = $ad->commonVehicleFilter?->newPrice;
                $tempAd['currency'] = $ad->commonVehicleFilter?->currency;
            }
            if (in_array($ad->category->name_en, ["Mobile", "Tablet"])) {

                $ad->load('mobTabFilter');
                $tempAd['price'] = $ad->mobTabFilter?->price;
                $tempAd['newPrice'] = $ad->mobTabFilter?->newPrice;
                $tempAd['currency'] = $ad->mobTabFilter?->currency;
            }
            if ($ad->category->name_en == "Computer") {

                $ad->load('computerFilter');
                $tempAd['price'] = $ad->computerFilter?->price;
                $tempAd['newPrice'] = $ad->computerFilter?->newPrice;
                $tempAd['currency'] = $ad->computerFilter?->currency;
            }
            if ($ad->category->name_en == "Accessories") {

                $ad->load('execoarFilter');
                $tempAd['price'] = $ad->execoarFilter?->price;
                $tempAd['newPrice'] = $ad->execoarFilter?->newPrice;
                $tempAd['currency'] = $ad->execoarFilter?->currency;
            }
            if (in_array($ad->category->name_en, ["Refrigerator", "Washing Machine", "Fan", "Heater", "Blenders juicers", "Oven Microwave", "Screen", "Receiver", "Solar Energy"])) {

                $ad->load('restDevicesFilter');
                $tempAd['price'] = $ad->restDevicesFilter?->price;
                $tempAd['newPrice'] = $ad->restDevicesFilter?->newPrice;
                $tempAd['currency'] = $ad->restDevicesFilter?->currency;
            }
            if (in_array($ad->category->name_en, ["Bedroom", "Table", "Chair", "Bed", "Cabinet", "Sofa"])) {

                $ad->load('furnitureFilter');
                $tempAd['price'] = $ad->furnitureFilter?->price;
                $tempAd['newPrice'] = $ad->furnitureFilter?->newPrice;
                $tempAd['currency'] = $ad->furnitureFilter?->currency;
            }
            if (in_array($ad->category->name_en, ["Men", "Women", "children"])) {

                $ad->load('clothesFasionFilter');
                $tempAd['price'] = $ad->clothesFasionFilter?->price;
                $tempAd['newPrice'] = $ad->clothesFasionFilter?->newPrice;
                $tempAd['currency'] = $ad->clothesFasionFilter?->currency;
            }
            if (in_array($ad->category->name_en, [
                "Livestock",
                "Birds",
                "Cat",
                "Dog",
                "Fish",
                "gift",
                "Perfume",
                "Makeup",
                "Watch",
                "Glass",
                "Restaurant",
                "Cafe",
                "Park",
                "Bakery",
                "Book",
                "Stationery",
                "Musical Instrument",
                "Children equipment",
                "Sports and clubs",
                "Industrial equipment",
            ])) {

                $ad->load('generalAdditionalField');
                $tempAd['price'] = $ad->generalAdditionalField?->price;
                $tempAd['newPrice'] = $ad->generalAdditionalField?->newPrice;
                $tempAd['currency'] = $ad->generalAdditionalField?->currency;
            }

            return $tempAd;
        });

        return response()->json([
            "message" => "Get User Advertisements Successfully",
            "data" => $newAds
        ]);
    }
    public function deleteAdvertisement($id)
    {
        $ad = Advertisement::find($id);
        if ($ad) {
            // $ad->delete();


            //حذف الشكاوي المتعلقة بهذا الأعلان
            $ad->complaints->map(function ($c) {
                $c->delete();
            });

            //حذف الاعلان هذا من القوائم المفضلة
            $ad->favorites->map(function ($c) {
                $c->delete();
            });

            //حذف الاعجابات المتعلقة بهذا الاعلان
            // return $ad->likes;
            $ad->likes->map(function ($c) {
                $c->delete();
            });

            //حذف التعليقات والردود المتعلقة بها ان وجدت
            // return $ad->comments->load('reply');
            $ad->comments->load('reply')->map(function ($c) {
                if ($c->reply != null) {
                    $c->reply->delete();
                }
                $c->delete();
            });

            //حذف مسارات الصور وملفاتها
            // return $ad->images;
            $ad->images->map(function ($c) {
                //احذف ملف الصورة
                Storage::disk('public')->delete($c->url);

                //بعدين احذف مسارها من الجدول
                $c->delete();
            });

            //حذف البيانات الاضافية من جداول الفلاتر

            $ad->apartementFilter?->delete();
            $ad->farmFilter?->delete();
            $ad->landFilter?->delete();
            $ad->commercialStoreFilter?->delete();
            $ad->officeFilter?->delete();
            $ad->shalehFilter?->delete();
            $ad->vellaFilter?->delete();
            $ad->commonVehicleFilter?->delete();
            $ad->sparePartsVehicleFilter?->delete();
            $ad->mobTabFilter?->delete();
            $ad->computerFilter?->delete();
            $ad->execoarFilter?->delete();
            $ad->restDevicesFilter?->delete();
            $ad->furnitureFilter?->delete();
            $ad->clothesFasionFilter?->delete();
            $ad->generalAdditionalField?->delete();


            //حذف الاعلان نفسو
            $ad->delete();

            return response()->json([
                "message" => "delete done"
            ]);
        } else {

            return response()->json([
                "message" => "No Advertisement with this id"
            ], 404);
        }
    }
    public function updateAdvertisement(Request $request, $id)
    {
        $ad = Advertisement::find($id);

        if ($ad) {
            if ($request->has("adStatus") && $request->adStatus === "closed") {
                if ($ad->status == "active" || $ad->status == "pending") {
                    $ad->status = $request->adStatus;
                    $ad->save();
                }
            }
            if ($request->has("price")) {

                if ($ad->apartementFilter != null) {
                    $ad->apartementFilter->price = $request->price;
                    $ad->apartementFilter->save();
                }
                if ($ad->farmFilter != null) {
                    $ad->farmFilter->price = $request->price;
                    $ad->farmFilter->save();
                }
                if ($ad->landFilter != null) {
                    $ad->landFilter->price = $request->price;
                    $ad->landFilter->save();
                }
                if ($ad->commercialStoreFilter != null) {
                    $ad->commercialStoreFilter->price = $request->price;
                    $ad->commercialStoreFilter->save();
                }
                if ($ad->officeFilter != null) {
                    $ad->officeFilter->price = $request->price;
                    $ad->officeFilter->save();
                }
                if ($ad->shalehFilter != null) {
                    $ad->shalehFilter->price = $request->price;
                    $ad->shalehFilter->save();
                }
                if ($ad->vellaFilter != null) {
                    $ad->vellaFilter->price = $request->price;
                    $ad->vellaFilter->save();
                }
                if ($ad->commonVehicleFilter != null) {
                    $ad->commonVehicleFilter->price = $request->price;
                    $ad->commonVehicleFilter->save();
                }
                if ($ad->sparePartsVehicleFilter != null) {
                    $ad->sparePartsVehicleFilter->price = $request->price;
                    $ad->sparePartsVehicleFilter->save();
                }
                if ($ad->mobTabFilter != null) {
                    $ad->mobTabFilter->price = $request->price;
                    $ad->mobTabFilter->save();
                }
                if ($ad->mobTabFilter != null) {
                    $ad->mobTabFilter->price = $request->price;
                    $ad->mobTabFilter->save();
                }
                if ($ad->computerFilter != null) {
                    $ad->computerFilter->price = $request->price;
                    $ad->computerFilter->save();
                }
                if ($ad->execoarFilter != null) {
                    $ad->execoarFilter->price = $request->price;
                    $ad->execoarFilter->save();
                }
                if ($ad->execoarFilter != null) {
                    $ad->execoarFilter->price = $request->price;
                    $ad->execoarFilter->save();
                }
                if ($ad->restDevicesFilter != null) {
                    $ad->restDevicesFilter->price = $request->price;
                    $ad->restDevicesFilter->save();
                }
                if ($ad->restDevicesFilter != null) {
                    $ad->restDevicesFilter->price = $request->price;
                    $ad->restDevicesFilter->save();
                }
                if ($ad->furnitureFilter != null) {
                    $ad->furnitureFilter->price = $request->price;
                    $ad->furnitureFilter->save();
                }
                if ($ad->clothesFasionFilter != null) {
                    $ad->clothesFasionFilter->price = $request->price;
                    $ad->clothesFasionFilter->save();
                }
                if ($ad->generalAdditionalField != null) {
                    $ad->generalAdditionalField->price = $request->price;
                    $ad->generalAdditionalField->save();
                }
            }
            if ($request->has("newPrice")) {
                if ($ad->apartementFilter != null) {
                    $ad->apartementFilter->newPrice = $request->newPrice;
                    $ad->apartementFilter->save();
                }
                if ($ad->farmFilter != null) {
                    $ad->farmFilter->newPrice = $request->newPrice;
                    $ad->farmFilter->save();
                }
                if ($ad->landFilter != null) {
                    $ad->landFilter->newPrice = $request->newPrice;
                    $ad->landFilter->save();
                }
                if ($ad->commercialStoreFilter != null) {
                    $ad->commercialStoreFilter->newPrice = $request->newPrice;
                    $ad->commercialStoreFilter->save();
                }
                if ($ad->officeFilter != null) {
                    $ad->officeFilter->newPrice = $request->newPrice;
                    $ad->officeFilter->save();
                }
                if ($ad->shalehFilter != null) {
                    $ad->shalehFilter->newPrice = $request->newPrice;
                    $ad->shalehFilter->save();
                }
                if ($ad->vellaFilter != null) {
                    $ad->vellaFilter->newPrice = $request->newPrice;
                    $ad->vellaFilter->save();
                }
                if ($ad->commonVehicleFilter != null) {
                    $ad->commonVehicleFilter->newPrice = $request->newPrice;
                    $ad->commonVehicleFilter->save();
                }
                if ($ad->sparePartsVehicleFilter != null) {
                    $ad->sparePartsVehicleFilter->newPrice = $request->newPrice;
                    $ad->sparePartsVehicleFilter->save();
                }
                if ($ad->mobTabFilter != null) {
                    $ad->mobTabFilter->newPrice = $request->newPrice;
                    $ad->mobTabFilter->save();
                }
                if ($ad->mobTabFilter != null) {
                    $ad->mobTabFilter->newPrice = $request->newPrice;
                    $ad->mobTabFilter->save();
                }
                if ($ad->computerFilter != null) {
                    $ad->computerFilter->newPrice = $request->newPrice;
                    $ad->computerFilter->save();
                }
                if ($ad->execoarFilter != null) {
                    $ad->execoarFilter->newPrice = $request->newPrice;
                    $ad->execoarFilter->save();
                }
                if ($ad->execoarFilter != null) {
                    $ad->execoarFilter->newPrice = $request->newPrice;
                    $ad->execoarFilter->save();
                }
                if ($ad->restDevicesFilter != null) {
                    $ad->restDevicesFilter->newPrice = $request->newPrice;
                    $ad->restDevicesFilter->save();
                }
                if ($ad->restDevicesFilter != null) {
                    $ad->restDevicesFilter->newPrice = $request->newPrice;
                    $ad->restDevicesFilter->save();
                }
                if ($ad->furnitureFilter != null) {
                    $ad->furnitureFilter->newPrice = $request->newPrice;
                    $ad->furnitureFilter->save();
                }
                if ($ad->clothesFasionFilter != null) {
                    $ad->clothesFasionFilter->newPrice = $request->newPrice;
                    $ad->clothesFasionFilter->save();
                }
                if ($ad->generalAdditionalField != null) {
                    $ad->generalAdditionalField->newPrice = $request->newPrice;
                    $ad->generalAdditionalField->save();
                }
            }
            if ($request->has("currency")) {
                if ($ad->apartementFilter != null) {
                    $ad->apartementFilter->currency = $request->currency;
                    $ad->apartementFilter->save();
                }
                if ($ad->farmFilter != null) {
                    $ad->farmFilter->currency = $request->currency;
                    $ad->farmFilter->save();
                }
                if ($ad->landFilter != null) {
                    $ad->landFilter->currency = $request->currency;
                    $ad->landFilter->save();
                }
                if ($ad->commercialStoreFilter != null) {
                    $ad->commercialStoreFilter->currency = $request->currency;
                    $ad->commercialStoreFilter->save();
                }
                if ($ad->officeFilter != null) {
                    $ad->officeFilter->currency = $request->currency;
                    $ad->officeFilter->save();
                }
                if ($ad->shalehFilter != null) {
                    $ad->shalehFilter->currency = $request->currency;
                    $ad->shalehFilter->save();
                }
                if ($ad->vellaFilter != null) {
                    $ad->vellaFilter->currency = $request->currency;
                    $ad->vellaFilter->save();
                }
                if ($ad->commonVehicleFilter != null) {
                    $ad->commonVehicleFilter->currency = $request->currency;
                    $ad->commonVehicleFilter->save();
                }
                if ($ad->sparePartsVehicleFilter != null) {
                    $ad->sparePartsVehicleFilter->currency = $request->currency;
                    $ad->sparePartsVehicleFilter->save();
                }
                if ($ad->mobTabFilter != null) {
                    $ad->mobTabFilter->currency = $request->currency;
                    $ad->mobTabFilter->save();
                }
                if ($ad->mobTabFilter != null) {
                    $ad->mobTabFilter->currency = $request->currency;
                    $ad->mobTabFilter->save();
                }
                if ($ad->computerFilter != null) {
                    $ad->computerFilter->currency = $request->currency;
                    $ad->computerFilter->save();
                }
                if ($ad->execoarFilter != null) {
                    $ad->execoarFilter->currency = $request->currency;
                    $ad->execoarFilter->save();
                }
                if ($ad->execoarFilter != null) {
                    $ad->execoarFilter->currency = $request->currency;
                    $ad->execoarFilter->save();
                }
                if ($ad->restDevicesFilter != null) {
                    $ad->restDevicesFilter->currency = $request->currency;
                    $ad->restDevicesFilter->save();
                }
                if ($ad->restDevicesFilter != null) {
                    $ad->restDevicesFilter->currency = $request->currency;
                    $ad->restDevicesFilter->save();
                }
                if ($ad->furnitureFilter != null) {
                    $ad->furnitureFilter->currency = $request->currency;
                    $ad->furnitureFilter->save();
                }
                if ($ad->clothesFasionFilter != null) {
                    $ad->clothesFasionFilter->currency = $request->currency;
                    $ad->clothesFasionFilter->save();
                }
                if ($ad->generalAdditionalField != null) {
                    $ad->generalAdditionalField->currency = $request->currency;
                    $ad->generalAdditionalField->save();
                }
            }


            return response()->json([
                "message" => "edit advertisement done"
            ]);
        } else {
            return response()->json([
                "message" => "no advertisement with this id"
            ], 404);
        }
    }
}
