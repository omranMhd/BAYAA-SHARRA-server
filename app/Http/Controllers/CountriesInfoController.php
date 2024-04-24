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
                "phoneCode" => "00963",
                "currency " => "SYP",
                "cities" => [
                    "Al-Hasakah",
                    "Aleppo",
                    "As-Suwayda",
                    "Damascus",
                    "Deir ez-Zore",
                    "Hama",
                    "Homs",
                    "Idlib",
                    "Latakia",
                    "Raqqa",
                    "Rif Dimashq",
                    "Tartus",
                    "Daraa",
                    "Quneitra",
                ]
            ],
            [
                "country" => "JORDAN",
                "phoneCode" => "00962",
                "currency " => "JOD",
                "cities" => [
                    "Amman",
                    "Ajloun",
                    "Balqa",
                    "Irbid",
                    "Jerash",
                    "Karak",
                    "Maan",
                    "Madaba",
                    "Tafilah",
                    "Zarqa",
                    "Aqaba",
                    "Mafraq",
                ]
            ],
            [
                "country" => "Saudi Arabia",
                "phoneCode" => "00966",
                "currency " => "SAR",
                "cities" => [
                    "Riyadh",
                    "Makkah",
                    "Al Madinah",
                    "Eastern Province",
                    "Asir",
                    "Tabuk",
                    "Hail",
                    "Jizan",
                    "Najran",
                    "Al Bahah",
                    "Al Jawf",
                    "Medina",
                    "Qassim",
                ]
            ],
            [
                "country" => "IRAQ",
                "phoneCode" => "00964",
                "currency " => "IQD",
                "cities" => [
                    "Al-Anbar",
                    "Al-Basrah",
                    "Al-Muthanna",
                    "Al-Qadisiya",
                    "Al-Sulaymaniyah",
                    "Al-Najaf",
                    "Al-Karbala",
                    "Al-Wasit",
                    "Al-Dhi Qar",
                    "Al-Babil",
                    "Al-Salah ad-Din",
                    "Al-Kirkuk",
                    "Al-Maysan",
                    "Al-Dohuk",
                    "Al-Erbil",
                    "Al-Sulaymaniyah"
                ]
            ],
            [
                "country" => "UAE",
                "phoneCode" => "00971",
                "currency " => "AED",
                "cities" => [
                    "Dubai",
                    "Abu Dhabi",
                    "Sharjah",
                    "Ras Al Khaimah",
                    "Umm Al Quwain",
                    "Fujairah",
                    "Al Ain",
                ]
            ],
        ]);
    }
}
