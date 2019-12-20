<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use App\Brand;
class ShowCategoryController extends Controller
{
    public function show_category_home($category_id){
        $cat_list = Category::select(['category_id','category_name'])->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_list = Brand::select(['brand_id','brand_name'])->where('brand_status','1')->orderBy('category_id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$category_id)->get();
        $data = [
            'category' => $cat_list,
            'brand' => $brand_list,
            'category_by_id' =>$category_by_id
        ];
        return view('page.show_category')->with($data);
    }
}
