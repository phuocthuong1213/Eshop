<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use App\Brand;
class ShowBrandController extends Controller
{
    public function show_brand_home($brand_id){
        $cat_list = Category::select(['category_id','category_name'])->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_list = Brand::select(['brand_id','brand_name'])->where('brand_status','1')->orderBy('category_id','desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->get();
        $data = [
            'category' => $cat_list,
            'brand' => $brand_list,
            'brand_by_id' =>$brand_by_id
        ];
        return view('page.show_brand')->with($data);
    }
}
