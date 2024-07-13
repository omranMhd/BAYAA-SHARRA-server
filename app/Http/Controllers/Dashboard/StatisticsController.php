<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function getSomeStatistics()
    {
        $data = [];
        //كل المستخدمين
        // return User::where("type", "user")->count();

        $data['users'] = User::where("type", "user")->count();

        //عدد كل الإعلانات
        // return Advertisement::count();

        $data['advertisements'] = Advertisement::count();

        // عدد كل الاعلانات المغلقة
        // return Advertisement::where("status","closed")->count();

        $data['closed_advertisements'] = Advertisement::where("status", "closed")->count();

        //عدد كل الأعلانات النشطة
        // return Advertisement::where("status", "active")->count();

        $data['active_advertisements'] = Advertisement::where("status", "active")->count();

        //عدد كل الأعلانات المغلقة والمدفوعة الرسوم
        // return Advertisement::where("status", "closed")->where("paidFor", 1)->count();

        $data['closed_paidFor_advertisements'] = Advertisement::where("status", "closed")->where("paidFor", 1)->count();


        return response()->json([
            "messsage" => "get Some Statistics done successfully",
            "data" => $data
        ]);
    }
}
