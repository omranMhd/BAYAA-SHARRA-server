<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountriesInfoController extends Controller
{
    public function getInfo()
    {
        return response()->json([
            [
                "country" => "SYRIA",
                "country_ar" => "سورية",
                "phoneCode" => "00963",
                "currency " => "SYP",
                "cities" => [
                    ["en" => "Damascus", "ar" => "دمشق"],
                    ["en" => "Rif Dimashq", "ar" => "ريف دمشق"],
                    ["en" => "Quneitra", "ar" => "القنيطرة"],
                    ["en" => "Daraa", "ar" => "درعا"],
                    ["en" => "As-Suwayda", "ar" => "السويداء"],
                    ["en" => "Homs", "ar" => "حمص"],
                    ["en" => "Hama", "ar" => "حماه"],
                    ["en" => "Aleppo", "ar" => "حلب"],
                    ["en" => "Idlib", "ar" => "إدلب"],
                    ["en" => "Al-Hasakah", "ar" => "الحسكة"],
                    ["en" => "Raqqa", "ar" => "الرقة"],
                    ["en" => "Deir ez-Zore", "ar" => "ديرالزور"],
                    ["en" => "Latakia", "ar" => "اللاذقية"],
                    ["en" => "Tartus", "ar" => "طرطوس"],
                ]
            ],
            [
                "country" => "JORDAN",
                "country_ar" => "الأردن",
                "phoneCode" => "00962",
                "currency " => "JOD",
                "cities" => [
                    ["en" => "Amman", "ar" => "عمان"],
                    ["en" => "Ajloun", "ar" => "عجلون"],
                    ["en" => "Balqa", "ar" => "البلقاء"],
                    ["en" => "Irbid", "ar" => "إربد"],
                    ["en" => "Jerash", "ar" => "جرش"],
                    ["en" => "Karak", "ar" => "الكرك"],
                    ["en" => "Maan", "ar" => "معان"],
                    ["en" => "Madaba", "ar" => "مأدبة"],
                    ["en" => "Tafilah", "ar" => "الطفيلة"],
                    ["en" => "Zarqa", "ar" => "الزرقاء"],
                    ["en" => "Aqaba", "ar" => "العقبة"],
                    ["en" => "Mafraq", "ar" => "المفرق"],
                ]
            ],
            // [
            //     "country" => "Saudi Arabia",
            //     "country_ar" => "المملكة العربية السعودية",
            //     "phoneCode" => "00966",
            //     "currency " => "SAR",
            //     "cities" => [
            //         "Riyadh",
            //         "Makkah",
            //         "Al Madinah",
            //         "Eastern Province",
            //         "Asir",
            //         "Tabuk",
            //         "Hail",
            //         "Jizan",
            //         "Najran",
            //         "Al Bahah",
            //         "Al Jawf",
            //         "Medina",
            //         "Qassim",
            //     ]
            // ],
            // [
            //     "country" => "IRAQ",
            //     "country_ar" => "العراق",
            //     "phoneCode" => "00964",
            //     "currency " => "IQD",
            //     "cities" => [
            //         "Al-Anbar",
            //         "Al-Basrah",
            //         "Al-Muthanna",
            //         "Al-Qadisiya",
            //         "Al-Sulaymaniyah",
            //         "Al-Najaf",
            //         "Al-Karbala",
            //         "Al-Wasit",
            //         "Al-Dhi Qar",
            //         "Al-Babil",
            //         "Al-Salah ad-Din",
            //         "Al-Kirkuk",
            //         "Al-Maysan",
            //         "Al-Dohuk",
            //         "Al-Erbil",
            //         "Al-Sulaymaniyah"
            //     ]
            // ],
            // [
            //     "country" => "UAE",
            //     "country_ar" => "الإمارات",
            //     "phoneCode" => "00971",
            //     "currency " => "AED",
            //     "cities" => [
            //         "Dubai",
            //         "Abu Dhabi",
            //         "Sharjah",
            //         "Ras Al Khaimah",
            //         "Umm Al Quwain",
            //         "Fujairah",
            //         "Al Ain",
            //     ]
            // ],
        ]);
    }
}
