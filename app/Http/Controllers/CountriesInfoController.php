<?php

namespace App\Http\Controllers;

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
