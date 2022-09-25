<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\StoreResource;
use App\Profile;

class HomeController extends Controller
{
    public function getAllStore()
    {
        $store = Profile::with('products')->get();
        // $countries = DB::table('country')->get();

        return response()->json([
            'success' => true,
            'data' => StoreResource::collection($store),
        ]);
    }

    function getCountries()
    {
        $cities = DB::table('city')->get();
        $countries = DB::table('country')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'cities' => $cities,
                'countries' => $countries
            ],
        ]);
    }
}
