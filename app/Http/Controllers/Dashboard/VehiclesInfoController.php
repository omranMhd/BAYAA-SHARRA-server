<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehiclesInfoController extends Controller
{
    public function getVehicleBrands()
    {
        return response()->json([
            "message" => "get Vehicle Brands successfully !",
            "data" => [
                [
                    "brand" => ["en" => "TOYOTA", "ar" => "تويوتا"],
                    "models" => [
                        ["en" => "Land Cruiser", "ar" => "لاندكروزر"],
                        ["en" => "Camry", "ar" => "كامري"],
                        ["en" => "Hilux", "ar" => "هايلوكس"],
                    ]
                ],
                [
                    "brand" => ["en" => "FORD", "ar" => "فورد"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "CHEVROLET", "ar" => "شيفروليه"],
                    "models" => [
                        ["en" => "Caprice", "ar" => "كابريس"],
                        ["en" => "Tahoe", "ar" => "تاهو"],
                        ["en" => "Camaro", "ar" => "كامارو"],
                        ["en" => "Cruze", "ar" => "كروز"],
                    ]
                ],
                [
                    "brand" => ["en" => "NISSAN", "ar" => "نيسان"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "SAAB", "ar" => "ساب"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "HYUNDAI", "ar" => "هيونداي"],
                    "models" => [
                        ["en" => "Sonata", "ar" => "سوناتا"],
                        ["en" => "Elantra", "ar" => "الانترا"],
                        ["en" => "Accent", "ar" => "اكسنت"],
                        ["en" => "Azera", "ar" => "آزيرا"],
                    ]
                ],
                [
                    "brand" => ["en" => "GENESIS", "ar" => "جينيسس"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "LEXUS", "ar" => "ليكزس"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "GMC", "ar" => "جي إم سي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "MERCEDES", "ar" => "ميرسيدس"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "HONDA", "ar" => "هوندا"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "BMW", "ar" => "بي إم دبليو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "KIA", "ar" => "كيا"],
                    "models" => [
                        ["en" => "Optima", "ar" => "أوبتيما"],
                        ["en" => "Cerato", "ar" => "سيراتو"],
                        ["en" => "Rio", "ar" => "ريو"],
                        ["en" => "Sportage", "ar" => "سبورتاج"],
                        ["en" => "Soul", "ar" => "سول"],
                    ]
                ],
                [
                    "brand" => ["en" => "DODGE", "ar" => "دودج"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "CHRYSLER", "ar" => "كرايسلر"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "JEEP", "ar" => "جيب"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "MITSUBISHI", "ar" => "ميتسوبيشي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "MAZDA", "ar" => "مازدا"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "LANDROVER", "ar" => "لاندروفر"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "ISUZU", "ar" => "إسوزو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "CADILLAC", "ar" => "كاديلاك"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "PORSCHE", "ar" => "بورش"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "AUDI", "ar" => "أودي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "SUZUKI", "ar" => "سوزوكي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "INFINITY", "ar" => "انفينيتي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "HUMMER", "ar" => "هامار"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "LINCOLIN", "ar" => "لينكولن"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "VOLKSWAGEN", "ar" => "فولكس فاجن"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "DIAHATSU", "ar" => "ديهاتسو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "GEELY", "ar" => "جيلي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "MERCURY", "ar" => "ميركوري"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "VOLVO", "ar" => "فولفو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "PEUGEOT", "ar" => "بيجو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "BENTLEY", "ar" => "بينتلي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "JAGUAR", "ar" => "جاكوار"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "SUBARU", "ar" => "سوبارو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "MG", "ar" => "إم جي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "CHANGAN", "ar" => "شانجان"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "BUICK", "ar" => "بويك"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "MASERATI", "ar" => "مازيراتي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "ROLLSROYCE", "ar" => "رولزرويس"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "LAMBORGHINI", "ar" => "لامبورجيني"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "OPEL", "ar" => "اوبيل"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "SKODA", "ar" => "سكودا"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "FERRARI", "ar" => "فيراري"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "CITEROEN", "ar" => "سيتروين"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "CHERY", "ar" => "شيري"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "SEAT", "ar" => "سيات"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "DAEWOO", "ar" => "دايو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "FIAT", "ar" => "فيات"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "SANGYONG", "ar" => "سانغ يونغ"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "ASTONMARTIN", "ar" => "استون مارتن"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "PROTON", "ar" => "بروتون"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "RENAULT", "ar" => "رينو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "HAVAL", "ar" => "هافال"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "GAC", "ar" => "جي اي سي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "GREATWALL", "ar" => "غريت وول"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "FAW", "ar" => "فاو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "BYD", "ar" => "بي واي دي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "ALFAROMEO", "ar" => "الفا روميو"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "TATA", "ar" => "تاتا"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "JMC", "ar" => "جى ام سي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "JETOUR", "ar" => "جيتور"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "FOTON", "ar" => "فوتون"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "LIFAN", "ar" => "ليفان"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "MAXUS", "ar" => "ماكسوس"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "JAC", "ar" => "جاك"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "BAIC", "ar" => "بايك"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "DONGFENG", "ar" => "دونغ فينغ"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "TESLA", "ar" => "تيسلا"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "SOUEAST", "ar" => "سويست"],
                    "models" => []
                ],
                [
                    "brand" => ["en" =>  "MAHINDRE", "ar" => "ماهيندر"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "ZOTYE", "ar" => "زوتاي"],
                    "models" => []
                ],
                [
                    "brand" => ["en" => "HONGQI", "ar" => "هونغكي"],
                    "models" => []
                ],

            ]
        ]);
    }
}
