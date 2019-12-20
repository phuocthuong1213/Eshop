<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;
use App\Category;
use App\Product;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cat_list = Category::select(['category_id','category_name'])->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_list = Brand::select(['brand_id','brand_name'])->where('brand_status','1')->orderBy('category_id','desc')->get();
        $product_list = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->limit(8)->get();
        $data = [
            'category' => $cat_list,
            'brand' => $brand_list,
            'product' => $product_list
        ];
        return view('home')->with($data);
    }
}
