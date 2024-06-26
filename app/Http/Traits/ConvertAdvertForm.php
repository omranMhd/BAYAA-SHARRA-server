<?php

namespace App\Http\Traits;

use App\Models\Favorite;
use App\Http\Traits\CountriesInfo;




trait ConvertAdvertForm
{
    use CountriesInfo;
    //هذا التابع يقوم بأخذ عدة اعلانات وتحوليها لشكل فيه مغلومات اضافية تناسب العرض ضمن كارد
    //طبعا كل اعلان هو عبارة عن موديل يمثل ريكورد من جدول الاعلانات
    public function convertToCardForm($advertisements, $user_id = null)
    {
        $tempAd = [];
        $newAds = $advertisements->map(function ($ad, $index) use ($advertisements, $tempAd, $user_id) {
            // dd($ad->toArray());
            $tempAd = $ad->toArray();


            $tempAd["address"] = $this->getTranslatedCountryAndCityName(json_decode($tempAd["address"])->country, json_decode($tempAd["address"])->city);

            //load images
            $ad->load('images');

            $tempAd['cardPhoto'] = $ad->images->select('url')->first();
            if ($tempAd['cardPhoto'] != null) {

                $tempAd['cardPhoto'] = $tempAd['cardPhoto']["url"];
            }

            //هون اعرف اذا هذا الاعلان من ضمن القائمة المفضلة للمستخدم في حال ارسلنا رقمه
            if ($user_id != null) {
                if (Favorite::where('user_id', $user_id)->where('advertisement_id', $ad->id)->exists()) {
                    $tempAd['isAdInFavoriteList'] = true;
                } else {
                    $tempAd['isAdInFavoriteList'] = false;
                }
            }

            // dd($tempAd);

            //load category
            $ad->load(['category' => function ($query) {
                $query->select('id', 'name_en'); // Specify the columns to select for the 'books' relationship
            }]);




            if ($ad->category->name_en == "Apartment") {
                $ad->load('apartementFilter');
                $tempAd['price'] = $ad->apartementFilter?->price;
                $tempAd['newPrice'] = $ad->apartementFilter?->newPrice;
                $tempAd['currency'] = $ad->apartementFilter?->currency;
                $tempAd['sellOrRent'] = $ad->apartementFilter?->sellOrRent;
                $tempAd['paymentMethodRent'] = $ad->apartementFilter?->paymentMethodRent;
            }
            // dd($tempAd);
            if ($ad->category->name_en == "Farm") {

                $ad->load('farmFilter');
                $tempAd['price'] = $ad->farmFilter?->price;
                $tempAd['newPrice'] = $ad->farmFilter?->newPrice;
                $tempAd['currency'] = $ad->farmFilter?->currency;
                $tempAd['sellOrRent'] = $ad->farmFilter?->sellOrRent;
                $tempAd['paymentMethodRent'] = $ad->farmFilter?->paymentMethodRent;
            }
            if ($ad->category->name_en == "Land") {

                $ad->load('landFilter');
                $tempAd['price'] = $ad->landFilter?->price;
                $tempAd['newPrice'] = $ad->landFilter?->newPrice;
                $tempAd['currency'] = $ad->landFilter?->currency;
                $tempAd['sellOrRent'] = $ad->landFilter?->sellOrRent;
                $tempAd['paymentMethodRent'] = $ad->landFilter?->paymentMethodRent;
            }
            if ($ad->category->name_en == "Store") {

                $ad->load('commercialStoreFilter');
                $tempAd['price'] = $ad->commercialStoreFilter?->price;
                $tempAd['newPrice'] = $ad->commercialStoreFilter?->newPrice;
                $tempAd['currency'] = $ad->commercialStoreFilter?->currency;
                $tempAd['sellOrRent'] = $ad->commercialStoreFilter?->sellOrRent;
                $tempAd['paymentMethodRent'] = $ad->commercialStoreFilter?->paymentMethodRent;
            }
            if ($ad->category->name_en == "Office") {

                $ad->load('officeFilter');
                $tempAd['price'] = $ad->officeFilter?->price;
                $tempAd['newPrice'] = $ad->officeFilter?->newPrice;
                $tempAd['currency'] = $ad->officeFilter?->currency;
                $tempAd['sellOrRent'] = $ad->officeFilter?->sellOrRent;
                $tempAd['paymentMethodRent'] = $ad->officeFilter?->paymentMethodRent;
            }
            if ($ad->category->name_en == "Chalet") {

                $ad->load('shalehFilter');
                $tempAd['price'] = $ad->shalehFilter?->price;
                $tempAd['newPrice'] = $ad->shalehFilter?->newPrice;
                $tempAd['currency'] = $ad->shalehFilter?->currency;
                $tempAd['sellOrRent'] = $ad->shalehFilter?->sellOrRent;
                $tempAd['paymentMethodRent'] = $ad->shalehFilter?->paymentMethodRent;
            }
            if ($ad->category->name_en == "Villa") {

                $ad->load('vellaFilter');
                $tempAd['price'] = $ad->vellaFilter?->price;
                $tempAd['newPrice'] = $ad->vellaFilter?->newPrice;
                $tempAd['currency'] = $ad->vellaFilter?->currency;
                $tempAd['sellOrRent'] = $ad->vellaFilter?->sellOrRent;
                $tempAd['paymentMethodRent'] = $ad->vellaFilter?->paymentMethodRent;
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
                $tempAd['sellOrRent'] = $ad->commonVehicleFilter?->sellOrRent;
                $tempAd['paymentMethodRent'] = $ad->commonVehicleFilter?->paymentMethodRent;
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

            // return $ad->load('images', 'category');
            // $photos = $ad->images;
            // $advertisements[$index]->mainPhoto = $ad->images;
            // $advertisements[$index]->categoryy = $category->name_en;
            // return $advertisements[$index];
        });

        return $newAds;
    }
}
