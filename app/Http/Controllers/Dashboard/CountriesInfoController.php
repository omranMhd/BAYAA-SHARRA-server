<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CountriesInfo;

class CountriesInfoController extends Controller
{
    use CountriesInfo;
    public function getInfo()
    {
        return response()->json($this->getCountriesInfo());
    }
}
