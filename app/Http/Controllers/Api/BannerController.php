<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function getHomeBanner(Request $request)
    {
        // init
        $cat = DB::table('tbl_category_banner')->get();

        if ($cat) {
      
            return response()->json(HomeBanner::collection($cat),
             200);
            
        }else {
             return response()->json([
                    'status' => 404,
                    'msg' => 'false',
                    'data' => $request->get('session_id'),
            ]);
        }

       
        
    }
}
