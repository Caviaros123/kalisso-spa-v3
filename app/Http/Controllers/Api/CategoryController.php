<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function index()
    {

        # code...
        $products = Category::all();

        $this->response['message'] = 'success';
        $this->response['data'] = $products;

        return response()->json($this->response, 200);
    }

    public function getCategory(Request $request)
    {
        $category = Category::all();
        return response()->json([
            'success'=> true,
            'data' => CategoryResource::collection($category)
        ]);
    }
}
