<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use DB;
class DetailProductController extends Controller
{
    public function detail_product($product_id){
        
        $cat_list = Category::select(['category_id','category_name'])->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_list = Brand::select(['brand_id','brand_name'])->where('brand_status','1')->orderBy('category_id','desc')->get();
        $detail_product = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_id',$product_id)->get();
        foreach ($detail_product as $key => $value) {
            $category_id = $value->category_id;
        }
        $related_product = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        $data = [
            'category' => $cat_list,
            'brand' => $brand_list,
            'detail_product' => $detail_product,
            'related_product'=>$related_product
        ];
        return view('page.detail_product')->with($data);
    }
}
