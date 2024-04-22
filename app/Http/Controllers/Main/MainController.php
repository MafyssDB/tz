<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Promotion\PromotionResource;

use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;


class MainController extends Controller
{
    public function index()
    {
        $popularProducts = Product::orderBy('popular', 'desc')->paginate(10);
        $popularCategories = Category::orderBy('popular', 'desc')->get()->take(4);
        $categories = Category::all();
        $promotions = Promotion::all();
        return response()->json([
            'popularProducts' => ProductResource::collection($popularProducts)->response()->getData(),
            'popularCategories' => CategoryResource::collection($popularCategories)->response()->getData(),
            'categories' => CategoryResource::collection($categories)->response()->getData(),
            'promotions' => PromotionResource::collection($promotions)->response()->getData(),
        ]);
    }
}
