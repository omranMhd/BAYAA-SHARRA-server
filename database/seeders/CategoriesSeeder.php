<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{

    private $mainCategories = [
        ['id' => 1, 'name' => 'RealEstates'], //عقارات
        ['id' => 2, 'name' => 'vehicles'], //مركبات
        ['id' => 3, 'name' => 'Electrical Electronic Devices'], //أجهزة كهربائية وإلكترونية
        ['id' => 4, 'name' => 'Furniture'], //أثاث ومفروشات
        ['id' => 5, 'name' => 'Animals'], //حيوانات
        ['id' => 6, 'name' => 'Personal Collections'], //مقتنيات شخصية
        ['id' => 7, 'name' => 'Clothing and fashion'], //ألبسة وموضة
        ['id' => 8, 'name' => 'Food and drinks'], //طعام وشراب
        ['id' => 9, 'name' => 'Services'], //خدمات
        ['id' => 10, 'name' => 'Jobs'], //وظائف
        ['id' => 11, 'name' => 'Books and hobbies'], //كتب وهوايات
        ['id' => 12, 'name' => 'Toys Children\'s equipment'], //مستلزمات أطفال وألعاب
        ['id' => 13, 'name' => 'Sports and clubs'], //رياضة و نوادي
        ['id' => 14, 'name' => 'Industrial equipment'], //عدد ومستلزمات صناعية
    ];
    private $realEstateSubCategory = [
        ['id' => 15, 'name' => 'Apartment', 'parent_id' => 1], //شقة
        ['id' => 16, 'name' => 'Farm', 'parent_id' => 1], //مزرعة
        ['id' => 17, 'name' => 'Land', 'parent_id' => 1], //أرض
        ['id' => 18, 'name' => 'Commercial store', 'parent_id' => 1], //محل تجاري
        ['id' => 19, 'name' => 'Office', 'parent_id' => 1], //مكتب
        ['id' => 20, 'name' => 'Chalet', 'parent_id' => 1], //شاليه
        ['id' => 21, 'name' => 'Villa', 'parent_id' => 1], //فيلا
    ];

    private $vehiclesSubCategory = [
        ['id' => 22, 'name' => 'Car', 'parent_id' => 2], //سيارة
        ['id' => 23, 'name' => 'Motorcycle', 'parent_id' => 2], //دراجة
        ['id' => 24, 'name' => 'Truck', 'parent_id' => 2], //شاحنة
        ['id' => 25, 'name' => 'Bus', 'parent_id' => 2], //باص
        ['id' => 26, 'name' => 'Jabala', 'parent_id' => 2], //جبالات
        ['id' => 27, 'name' => 'Crane', 'parent_id' => 2], //رافعة
        ['id' => 28, 'name' => 'Bulldozer', 'parent_id' => 2], //جرافة
        ['id' => 29, 'name' => 'Spare parts', 'parent_id' => 2], //قطع غيار
    ];

    private $electricalElectronicDevicesSubCategory = [
        ['id' => 30, 'name' => 'Mobile', 'parent_id' => 3], //موبايل
        ['id' => 31, 'name' => 'Computer', 'parent_id' => 3], //كومبيوتر
        ['id' => 32, 'name' => 'Tablet', 'parent_id' => 3], //تابليت
        ['id' => 33, 'name' => 'Accessories', 'parent_id' => 3], //إكسسوار وملحقات
        ['id' => 34, 'name' => 'Refrigerator', 'parent_id' => 3], //برادات
        ['id' => 35, 'name' => 'Washing Machine', 'parent_id' => 3], //غسالات
        ['id' => 36, 'name' => 'Fan', 'parent_id' => 3], //مروحة
        ['id' => 37, 'name' => 'Heater', 'parent_id' => 3], //مدفئة
        ['id' => 38, 'name' => 'Blenders juicers', 'parent_id' => 3], //خلاط عصارة
        ['id' => 39, 'name' => 'Oven Microwave', 'parent_id' => 3], //فرن مايكرويف
        ['id' => 40, 'name' => 'Screen', 'parent_id' => 3], //شاشة
        ['id' => 41, 'name' => 'Receiver', 'parent_id' => 3], //ريسيفر
        ['id' => 42, 'name' => 'Solar Energy', 'parent_id' => 3], //طاقة شمسية
    ];

    private $furnitureSubCategory = [
        ['id' => 43, 'name' => 'Bedroom', 'parent_id' => 4], //غرفة نوم
        ['id' => 44, 'name' => 'Table', 'parent_id' => 4], //طاولة
        ['id' => 45, 'name' => 'Chair', 'parent_id' => 4], //كرسي
        ['id' => 46, 'name' => 'Bed', 'parent_id' => 4], //سرير
        ['id' => 47, 'name' => 'Cabinet', 'parent_id' => 4], //خزانة
        ['id' => 48, 'name' => 'Sofa', 'parent_id' => 4], //كنبات
    ];

    private $AnimalsSubCategory = [
        ['id' => 49, 'name' => 'Livestock', 'parent_id' => 5], //ماشية
        ['id' => 50, 'name' => 'Birds', 'parent_id' => 5], //طيور
        ['id' => 51, 'name' => 'Cat', 'parent_id' => 5], //قطة
        ['id' => 52, 'name' => 'Dog', 'parent_id' => 5], //كلب
        ['id' => 53, 'name' => 'Fish', 'parent_id' => 5], //سمك
    ];



    private $PersonalCollectionsSubCategory = [
        ['id' => 54, 'name' => 'gift', 'parent_id' => 6], //هدايا
        ['id' => 55, 'name' => 'Perfume', 'parent_id' => 6], //عطر
        ['id' => 56, 'name' => 'Makeup', 'parent_id' => 6], //مكياج
        ['id' => 57, 'name' => 'Watch', 'parent_id' => 6], //ساعة يد
        ['id' => 58, 'name' => 'Glass', 'parent_id' => 6], //نظارات
    ];

    private $ClothingAndFashionSubCategory = [
        ['id' => 59, 'name' => 'Men', 'parent_id' => 7],
        ['id' => 60, 'name' => 'Women', 'parent_id' => 7],
        ['id' => 61, 'name' => 'children', 'parent_id' => 7],
    ];

    private $FoodAndDrinksSubCategory = [
        ['id' => 62, 'name' => 'Restaurant', 'parent_id' => 8], //مطعم
        ['id' => 63, 'name' => 'Cafe', 'parent_id' => 8], //مقهى
        ['id' => 64, 'name' => 'Park', 'parent_id' => 8], //منتزه
        ['id' => 65, 'name' => 'Bakery', 'parent_id' => 8], //مخبز
    ];

    private $BooksAndHobbiesSubCategory = [
        ['id' => 66, 'name' => 'Book', 'parent_id' => 11], //كتاب
        ['id' => 67, 'name' => 'Stationery', 'parent_id' => 11], //قرطاسية
        ['id' => 68, 'name' => 'Musical Instrument', 'parent_id' => 11], //آلة موسيقية
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
