<?php

namespace App\Http\Traits;




trait CountriesInfo
{
    public function getCountriesInfo()
    {
        return     [
            [
                "country" => "SYRIA",
                "country_ar" => "سورية",
                "phoneCode" => "00963",
                "currency" => "SYP",
                "cities" => [
                    ["en" => "Damascus", "ar" => "دمشق", "location" => ["lat" => 33.513805, "lng" => 36.276527]],
                    ["en" => "Rif Dimashq", "ar" => "ريف دمشق", "location" => ["lat" => 33.571239, "lng" => 36.395120]],
                    ["en" => "Quneitra", "ar" => "القنيطرة", "location" => ["lat" => 33.184787, "lng" => 35.890766]],
                    ["en" => "Daraa", "ar" => "درعا", "location" => ["lat" => 32.622735, "lng" => 36.106375]],
                    ["en" => "As-Suwayda", "ar" => "السويداء", "location" => ["lat" => 32.712908, "lng" => 36.566267]],
                    ["en" => "Homs", "ar" => "حمص", "location" => ["lat" => 33.33, "lng" => 34.45]],
                    ["en" => "Hama", "ar" => "حماه", "location" => ["lat" => 33.33, "lng" => 34.45]],
                    ["en" => "Aleppo", "ar" => "حلب", "location" => ["lat" => 33.33, "lng" => 34.45]],
                    ["en" => "Idlib", "ar" => "إدلب", "location" => ["lat" => 33.33, "lng" => 34.45]],
                    ["en" => "Al-Hasakah", "ar" => "الحسكة", "location" => ["lat" => 33.33, "lng" => 34.45]],
                    ["en" => "Raqqa", "ar" => "الرقة", "location" => ["lat" => 33.33, "lng" => 34.45]],
                    ["en" => "Deir ez-Zore", "ar" => "ديرالزور", "location" => ["lat" => 33.33, "lng" => 34.45]],
                    ["en" => "Latakia", "ar" => "اللاذقية", "location" => ["lat" => 33.33, "lng" => 34.45]],
                    ["en" => "Tartus", "ar" => "طرطوس", "location" => ["lat" => 33.33, "lng" => 34.45]],
                ]
            ],
            [
                "country" => "JORDAN",
                "country_ar" => "الأردن",
                "phoneCode" => "00962",
                "currency" => "JOD",
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
            [
                "country" => "IRAQ",
                "country_ar" => "العراق",
                "phoneCode" => "00964",
                "currency" => "IQD",
                "cities" => [
                    ["en" => "Erbil", "ar" => "أربيل"],
                    ["en" => "Al-Anbar", "ar" => "الأنبار"],
                    ["en" => "Babil", "ar" => "بابل"],
                    ["en" => "Baghdad", "ar" => "بغداد"],
                    ["en" => "Basra", "ar" => "البصرة"],
                    ["en" => "Duhok", "ar" => "دهوك"],
                    ["en" => "Al-Qādisiyyah", "ar" => "القادسية"],
                    ["en" => "Diyala", "ar" => "ديالى"],
                    ["en" => "Dhi Qar", "ar" => "ذي قار"],
                    ["en" => "Sulaymaniyah", "ar" => "السليمانية"],
                    ["en" => "Salah Al-Din", "ar" => "صلاح الدين"],
                    ["en" => "Kirkuk", "ar" => "كركوك"],
                    ["en" => "Karbala", "ar" => "كربلاء"],
                    ["en" => "Muthanna", "ar" => "المثنى"],
                    ["en" => "Maysan", "ar" => "ميسان"],
                    ["en" => "Najaf", "ar" => "النجف"],
                    ["en" => "Ninawa", "ar" => "نينوى"],
                    ["en" => "Wasit", "ar" => "واسط"],

                ]
            ],
            [
                "country" => "LEBANON",
                "country_ar" => "لبنان",
                "phoneCode" => "00961",
                "currency" => "LBP",
                "cities" => [
                    ["en" => "Beirut", "ar" => "بيروت"],
                    ["en" => "Hermel", "ar" => "الهرمل"],
                    ["en" => "Baalbek", "ar" => "بعلبك"],
                    ["en" => "Akkar", "ar" => "عكار"],
                    ["en" => "Tripoli", "ar" => "طرابلس"],
                    ["en" => "Sida", "ar" => "صيدا"],
                    ["en" => "Sor", "ar" => "صور"],
                    ["en" => "Nabatieh", "ar" => "النبطية"],
                    ["en" => "Marjayoun", "ar" => "مرجعيون"],


                ]
            ],
            [
                "country" => "EGYPT",
                "country_ar" => "مصر",
                "phoneCode" => "0020",
                "currency" => "EGP",
                "cities" => [
                    ["en" => "Damietta", "ar" => "دمياط"],
                    ["en" => "Port Said", "ar" => "بورسعيد"],
                    ["en" => "Kafr El-Sheikh", "ar" => "كفر الشيخ"],
                    ["en" => "Dakahlia", "ar" => "الدقهلية"],
                    ["en" => "Western", "ar" => "الغربية"],
                    ["en" => "Eastern", "ar" => "الشرقية"],
                    ["en" => "Menoufia", "ar" => "المنوفية"],
                    ["en" => "Qalyubia", "ar" => "القليوبية"],
                    ["en" => "Ismailia", "ar" => "الإسماعيلية"],
                    ["en" => "North of Sinaa", "ar" => "شمال سيناء"],
                    ["en" => "South of Sinaa", "ar" => "جنوب سيناء"],
                    ["en" => "AlBohaira", "ar" => "البحيرة"],
                    ["en" => "Alexandria", "ar" => "الإسكندرية"],
                    ["en" => "Matrouh", "ar" => "مطروح"],
                    ["en" => "Cairo", "ar" => "القاهرة"],
                    ["en" => "Giza", "ar" => "الجيزة"],
                    ["en" => "Fayoum", "ar" => "الفيوم"],
                    ["en" => "Suez", "ar" => "السويس"],
                    ["en" => "Bani Sweif", "ar" => "بني سويف"],
                    ["en" => "Minya", "ar" => "المنيا"],
                    ["en" => "Asyut", "ar" => "أسيوط"],
                    ["en" => "Sohag", "ar" => "سوهاج"],
                    ["en" => "Qena", "ar" => "قنا"],
                    ["en" => "AlAuqsor", "ar" => "الأقصر"],
                    ["en" => "Aswan", "ar" => "أسوان"],
                    ["en" => "The Red Sea", "ar" => "البحر الأحمر"],
                    ["en" => "the new Valley", "ar" => "الوادي الجديد"],
                ]
            ],
            [
                "country" => "SAUDI ARABIA",
                "country_ar" => "المملكة العربية السعودية",
                "phoneCode" => "00966",
                "currency" => "SAR",
                "cities" => [
                    ["en" => "Riyadh", "ar" => "الرياض"],
                    ["en" => "Makkah", "ar" => "مكة"],
                    ["en" => "Al Madinah", "ar" => "المدينة المنورة"],
                    ["en" => "Eastern Province", "ar" => "المنطقة الشرقية"],
                    ["en" => "Asir", "ar" => "عسير"],
                    ["en" => "Tabuk", "ar" => "تبوك"],
                    ["en" => "Hail", "ar" => "حائل"],
                    ["en" => "Jizan", "ar" => "جيزان"],
                    ["en" => "Najran", "ar" => "نجران"],
                    ["en" => "Al Bahah", "ar" => "الباحة"],
                    ["en" => "Al Jawf", "ar" => "الجوف"],
                    ["en" => "Qassim", "ar" => "القسيم"],
                ]
            ],
            [
                "country" => "UNITED ARAB EMIRATES",
                "country_ar" => "الإمارات",
                "phoneCode" => "00971",
                "currency" => "AED",
                "cities" => [
                    ["en" => "Dubai", "ar" => "دبي"],
                    ["en" => "Abu Dhabi", "ar" => "أبوظبي"],
                    ["en" => "Sharjah", "ar" => "الشارقة"],
                    ["en" => "Ras Al Khaimah", "ar" => "رأس الخيمة"],
                    ["en" => "Umm Al Quwain", "ar" => "أم القيوين"],
                    ["en" => "Fujairah", "ar" => "الفجيرة"],
                    ["en" => "Al Ain", "ar" => "العين"],
                ]
            ],
            [
                "country" => "QATAR",
                "country_ar" => "قطر",
                "phoneCode" => "00974",
                "currency" => "QAR",
                "cities" => [
                    ["en" => "Al Rayyan", "ar" => "الريان"],
                    ["en" => "Doha", "ar" => "الدوحة"],
                    ["en" => "Al khor", "ar" => "الخور"],
                    ["en" => "Al Wakrah", "ar" => "الوكرة"],
                    ["en" => "North", "ar" => "الشمال"],
                    ["en" => "Umm Salal", "ar" => "ام صلال"],
                    ["en" => "Al-Daayen", "ar" => "الضعاين"],

                ]
            ],
            [
                "country" => "KUWAIT",
                "country_ar" => "الكويت",
                "phoneCode" => "00965",
                "currency" => "KWD",
                "cities" => [
                    ["en" => "Al kuwait", "ar" => "الكويت"],
                    ["en" => "Al ahmady", "ar" => "الأحمدي"],
                    ["en" => "Al Farwaniyah", "ar" => "الفروانية"],
                    ["en" => "Jahra", "ar" => "الجهراء"],
                    ["en" => "holy", "ar" => "حولي"],
                    ["en" => "Mubarak the Great", "ar" => "مبارك الكبير"],
                ]
            ],
            [
                "country" => "BAHRAIN",
                "country_ar" => "البحرين",
                "phoneCode" => "00973",
                "currency" => "BHD",
                "cities" => [
                    ["en" => "Manama", "ar" => "المنامة"],
                    ["en" => "Muharraq", "ar" => "المحرق"],
                    ["en" => "Northern", "ar" => "الشمالية"],
                    ["en" => "Southern", "ar" => "الجنوبية"],
                ]
            ],
            [
                "country" => "SULTANATE of OMAN",
                "country_ar" => "سلطنة عمان",
                "phoneCode" => "00968",
                "currency" => "OMR",
                "cities" => [
                    ["en" => "Nazwa", "ar" => "نزوى"],
                    ["en" => "Sohar", "ar" => "صحار"],
                    ["en" => "Al-Rustaq", "ar" => "الرستاق"],
                    ["en" => "Hema", "ar" => "هيما"],
                    ["en" => "Ibra", "ar" => "إبراء"],
                    ["en" => "Sor", "ar" => "صور"],
                    ["en" => "Ebre", "ar" => "عبري"],
                    ["en" => "Muscat", "ar" => "مسقط"],
                    ["en" => "Khasab", "ar" => "خصب"],
                    ["en" => "Salalah", "ar" => "صلالة"],
                    ["en" => "Al-Buraimi", "ar" => "البريمي"],
                ]
            ],
        ];
    }
    public function getCountryInfo($countryName)
    {
        $country_info = null;

        foreach ($this->getCountriesInfo() as $country) {

            if ($country['country'] === $countryName) {
                $country_info = $country;
                break;
            }
        }

        return $country_info;
    }
    public function getTranslatedCountryAndCityName($countryName, $cityName)
    {
        $country_info = $this->getCountryInfo($countryName);
        $countryName_en = $country_info["country"];
        $countryName_ar = $country_info["country_ar"];

        $cities = $country_info["cities"];

        $city_info = null;

        foreach ($cities as $city) {

            if ($city['en'] === $cityName) {
                $city_info = $city;
                break;
            }
        }

        $city_en = $city_info["en"];
        $city_ar = $city_info["ar"];
        return ["country_en" => $countryName_en, "country_ar" => $countryName_ar, "city_en" => $city_en, "city_ar" => $city_ar];
    }
}
