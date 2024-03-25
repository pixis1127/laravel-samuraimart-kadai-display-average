<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MajorCategory;
use App\Models\Product;


class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $major_categories = MajorCategory::all();

        $recently_products = Product::orderBy('created_at', 'desc')->take(4)->get();
       
        $recommend_products = Product::where('recommend_flag', true)->take(3)->get();

        $featured_products = Product::withAvg('reviews', 'score')->orderBy('reviews_avg_score', 'desc')->take(4)->get();//平均評価を算出、評価が高い順に並び替え

        return view('web.index', compact('major_categories', 'categories', 'recently_products', 'recommend_products', 'featured_products'));
    }
}
