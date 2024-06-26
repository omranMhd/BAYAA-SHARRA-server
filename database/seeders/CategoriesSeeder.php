<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{

    private $mainCategories = [
        ['id' => 1, 'name_en' => 'RealEstates', 'name_ar' => 'عقارات'], //عقارات
        ['id' => 2, 'name_en' => 'vehicles', 'name_ar' => 'مركبات'], //مركبات
        ['id' => 3, 'name_en' => 'Electrical Electronic Devices', 'name_ar' => 'أجهزة كهربائية إلكترونية'], //أجهزة كهربائية وإلكترونية
        ['id' => 4, 'name_en' => 'Furniture', 'name_ar' => 'أثاث ومفروشات'], //أثاث ومفروشات
        ['id' => 5, 'name_en' => 'Animals', 'name_ar' => 'حيوانات'], //حيوانات
        ['id' => 6, 'name_en' => 'Personal Collections', 'name_ar' => 'مقتنيات شخصية'], //مقتنيات شخصية
        ['id' => 7, 'name_en' => 'Clothing and fashion', 'name_ar' => 'ألبسة و موضة'], //ألبسة وموضة
        ['id' => 8, 'name_en' => 'Food and drinks', 'name_ar' => 'طعام و شراب'], //طعام وشراب
        ['id' => 9, 'name_en' => 'Services', 'name_ar' => 'خدمات'], //خدمات
        ['id' => 10, 'name_en' => 'Jobs', 'name_ar' => 'وظائف'], //وظائف
        ['id' => 11, 'name_en' => 'Books and hobbies', 'name_ar' => 'كتب وهوايات'], //كتب وهوايات
        ['id' => 12, 'name_en' => 'Children equipment', 'name_ar' => 'مستلزمات اطفال'], //مستلزمات أطفال وألعاب
        ['id' => 13, 'name_en' => 'Sports and clubs', 'name_ar' => 'رياضة و نوادي'], //رياضة و نوادي
        ['id' => 14, 'name_en' => 'Industrial equipment', 'name_ar' => 'مستلزمات صناعية'], //عدد ومستلزمات صناعية
    ];
    private $realEstateSubCategory = [
        ['id' => 15, 'name_en' => 'Apartment', 'name_ar' => 'شقة', 'parent_id' => 1], //شقة
        ['id' => 16, 'name_en' => 'Farm', 'name_ar' => 'مزرعة', 'parent_id' => 1], //مزرعة
        ['id' => 17, 'name_en' => 'Land', 'name_ar' => 'أرض', 'parent_id' => 1], //أرض
        ['id' => 18, 'name_en' => 'Store', 'name_ar' => 'محل تجاري', 'parent_id' => 1], //محل تجاري
        ['id' => 19, 'name_en' => 'Office', 'name_ar' => 'مكتب', 'parent_id' => 1], //مكتب
        ['id' => 20, 'name_en' => 'Chalet', 'name_ar' => 'شاليه', 'parent_id' => 1], //شاليه
        ['id' => 21, 'name_en' => 'Villa', 'name_ar' => 'فيلا', 'parent_id' => 1], //فيلا
    ];

    private $vehiclesSubCategory = [
        ['id' => 22, 'name_en' => 'Car', 'name_ar' => 'سيارة', 'parent_id' => 2], //سيارة
        ['id' => 23, 'name_en' => 'Motorcycle', 'name_ar' => 'دراجة', 'parent_id' => 2], //دراجة
        ['id' => 24, 'name_en' => 'Truck', 'name_ar' => 'شاحنة', 'parent_id' => 2], //شاحنة
        ['id' => 25, 'name_en' => 'Bus', 'name_ar' => 'باص', 'parent_id' => 2], //باص
        ['id' => 26, 'name_en' => 'Jabala', 'name_ar' => 'جبالة', 'parent_id' => 2], //جبالات
        ['id' => 27, 'name_en' => 'Crane', 'name_ar' => 'رافعة', 'parent_id' => 2], //رافعة
        ['id' => 28, 'name_en' => 'Bulldozer', 'name_ar' => 'جرافة', 'parent_id' => 2], //جرافة
        ['id' => 29, 'name_en' => 'Spare parts', 'name_ar' => 'قطع غيار', 'parent_id' => 2], //قطع غيار
    ];

    private $electricalElectronicDevicesSubCategory = [
        ['id' => 30, 'name_en' => 'Mobile', 'name_ar' => 'موبايل', 'parent_id' => 3], //موبايل
        ['id' => 31, 'name_en' => 'Computer', 'name_ar' => 'كومبيوتر', 'parent_id' => 3], //كومبيوتر
        ['id' => 32, 'name_en' => 'Tablet', 'name_ar' => 'تابليت', 'parent_id' => 3], //تابليت
        ['id' => 33, 'name_en' => 'Accessories', 'name_ar' => 'إكسسوارات', 'parent_id' => 3], //إكسسوار وملحقات
        ['id' => 34, 'name_en' => 'Refrigerator', 'name_ar' => 'برادات', 'parent_id' => 3], //برادات
        ['id' => 35, 'name_en' => 'Washing Machine', 'name_ar' => 'غسالات', 'parent_id' => 3], //غسالات
        ['id' => 36, 'name_en' => 'Fan', 'name_ar' => 'مروحة', 'parent_id' => 3], //مروحة
        ['id' => 37, 'name_en' => 'Heater', 'name_ar' => 'مدفئة', 'parent_id' => 3], //مدفئة
        ['id' => 38, 'name_en' => 'Blenders juicers', 'name_ar' => 'خلاط عصارة', 'parent_id' => 3], //خلاط عصارة
        ['id' => 39, 'name_en' => 'Oven Microwave', 'name_ar' => 'فرن مايكرويف', 'parent_id' => 3], //فرن مايكرويف
        ['id' => 40, 'name_en' => 'Screen', 'name_ar' => 'شاشة', 'parent_id' => 3], //شاشة
        ['id' => 41, 'name_en' => 'Receiver', 'name_ar' => 'ريسيفر', 'parent_id' => 3], //ريسيفر
        ['id' => 42, 'name_en' => 'Solar Energy', 'name_ar' => 'طاقة شمسية', 'parent_id' => 3], //طاقة شمسية
    ];

    private $furnitureSubCategory = [
        ['id' => 43, 'name_en' => 'Bedroom', 'name_ar' => 'غرفة نوم', 'parent_id' => 4], //غرفة نوم
        ['id' => 44, 'name_en' => 'Table', 'name_ar' => 'طاولة', 'parent_id' => 4], //طاولة
        ['id' => 45, 'name_en' => 'Chair', 'name_ar' => 'كرسي', 'parent_id' => 4], //كرسي
        ['id' => 46, 'name_en' => 'Bed', 'name_ar' => 'سرير', 'parent_id' => 4], //سرير
        ['id' => 47, 'name_en' => 'Cabinet', 'name_ar' => 'خزانة', 'parent_id' => 4], //خزانة
        ['id' => 48, 'name_en' => 'Sofa', 'name_ar' => 'كنبات', 'parent_id' => 4], //كنبات
    ];

    private $AnimalsSubCategory = [
        ['id' => 49, 'name_en' => 'Livestock', 'name_ar' => 'مواشي', 'parent_id' => 5], //ماشية
        ['id' => 50, 'name_en' => 'Birds', 'name_ar' => 'طيور', 'parent_id' => 5], //طيور
        ['id' => 51, 'name_en' => 'Cat', 'name_ar' => 'قطة', 'parent_id' => 5], //قطة
        ['id' => 52, 'name_en' => 'Dog', 'name_ar' => 'كلب', 'parent_id' => 5], //كلب
        ['id' => 53, 'name_en' => 'Fish', 'name_ar' => 'سمك', 'parent_id' => 5], //سمك
    ];



    private $PersonalCollectionsSubCategory = [
        ['id' => 54, 'name_en' => 'gift', 'name_ar' => 'هدايا', 'parent_id' => 6], //هدايا
        ['id' => 55, 'name_en' => 'Perfume', 'name_ar' => 'عطر', 'parent_id' => 6], //عطر
        ['id' => 56, 'name_en' => 'Makeup', 'name_ar' => 'مكياج', 'parent_id' => 6], //مكياج
        ['id' => 57, 'name_en' => 'Watch', 'name_ar' => 'ساعة يد', 'parent_id' => 6], //ساعة يد
        ['id' => 58, 'name_en' => 'Glass', 'name_ar' => 'نظارات', 'parent_id' => 6], //نظارات
    ];

    private $ClothingAndFashionSubCategory = [
        ['id' => 59, 'name_en' => 'Men', 'name_ar' => 'رجالي', 'parent_id' => 7],
        ['id' => 60, 'name_en' => 'Women', 'name_ar' => 'نسائي', 'parent_id' => 7],
        ['id' => 61, 'name_en' => 'children', 'name_ar' => 'أطفال', 'parent_id' => 7],
    ];

    private $FoodAndDrinksSubCategory = [
        ['id' => 62, 'name_en' => 'Restaurant', 'name_ar' => 'مطعم', 'parent_id' => 8], //مطعم
        ['id' => 63, 'name_en' => 'Cafe', 'name_ar' => 'مقهى', 'parent_id' => 8], //مقهى
        ['id' => 64, 'name_en' => 'Park', 'name_ar' => 'منتزه', 'parent_id' => 8], //منتزه
        ['id' => 65, 'name_en' => 'Bakery', 'name_ar' => 'مخبز', 'parent_id' => 8], //مخبز
    ];

    private $BooksAndHobbiesSubCategory = [
        ['id' => 66, 'name_en' => 'Book', 'name_ar' => 'كتب', 'parent_id' => 11], //كتاب
        ['id' => 67, 'name_en' => 'Stationery', 'name_ar' => 'قرطاسية', 'parent_id' => 11], //قرطاسية
        ['id' => 68, 'name_en' => 'Musical Instrument', 'name_ar' => 'آلة موسيقية', 'parent_id' => 11], //آلة موسيقية
    ];


    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($this->mainCategories as $category) {
            Category::create($category);
        }

        // Category::insert($this->mainCategories);

        foreach ($this->realEstateSubCategory as $category) {
            Category::create($category);
        }
        foreach ($this->vehiclesSubCategory as $category) {
            Category::create($category);
        }
        foreach ($this->electricalElectronicDevicesSubCategory as $category) {
            Category::create($category);
        }
        foreach ($this->furnitureSubCategory as $category) {
            Category::create($category);
        }
        foreach ($this->AnimalsSubCategory as $category) {
            Category::create($category);
        }
        foreach ($this->PersonalCollectionsSubCategory as $category) {
            Category::create($category);
        }
        foreach ($this->ClothingAndFashionSubCategory as $category) {
            Category::create($category);
        }

        foreach ($this->FoodAndDrinksSubCategory as $category) {
            Category::create($category);
        }

        foreach ($this->BooksAndHobbiesSubCategory as $category) {
            Category::create($category);
        }
    }
}
