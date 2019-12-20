<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Category;
use DB;
class BrandProduct extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    #Thêm thương hiệu
    public function get_add_brand_product(Request $request){
        $cat_list = Category::select(['category_id','category_name'])->get();
        $cate = [
            'category' => $cat_list,
        ];
        return view('backend.add_brand_product',$cate);
    }
    public function add_brand_product(Request $request){
        $cat_list = Category::select(['category_id','category_name'])->get();
        $cate = [
            'category' => $cat_list,
            'error' => [],
            'succes' => null,
        ];

        $data = array(
            'brand_name' =>  $request->brand_product_name,
            'brand_desc' =>  $request->brand_product_desc,
            'brand_status' => $request->brand_product_status,
            'category_id' => $request->list_category_product,
        );
        $find = Brand::where('brand_name', $request->brand_product_name)->first();
        if($find) {
            $cate['succes'] = "Tên thương hiệu bị trùng mời bạn nhập lại";
            return view('backend.add_brand_product',$cate);
        }else{
            if(strlen($data['brand_name']) <= 0){
                $cate['error']['brand_name'] = 'Bạn chưa nhập tên thương hiệu!!!';
            }

            if(strlen($data['brand_desc']) <= 0){
                $cate['error']['brand_desc'] = 'Bạn chưa nhập mô tả thương hiệu!!!';
            }

            if(count($cate['error']) > 0) {
                return view('backend.add_brand_product',$cate);
            }

            $cate['succes'] = "Thêm thương hiệu sản phẩm thành công";
            $brand = new Brand($data);
            $brand->save();
            return view('backend.add_brand_product',$cate);
        }  
      
    }
    #Hiển thị thương hiệu
    public function all_brand_product(){
        $data['all_brand'] = DB::table('tbl_brand')->orderBy('brand_id','desc')->paginate(5);
        return view('backend.all_brand_product')->with($data);
    }


    #Thay đổi trạng thái thương hiệu
    public function unactive_brand_product(Request $request){
        $id = $request->id; 
        Brand::where('brand_id',$id)->update(['brand_status'=>1]);
        return redirect()->route('all_brand');
    }

    public function active_brand_product(Request $request){
        $id = $request->id;
        Brand::where('brand_id',$id)->update(['brand_status'=>0]);
        return redirect()->route('all_brand');
    }

    #Update thương hiệu
    public function get_edit_brand_product(Request $request,$id){
        $cat_list = Category::select(['category_id','category_name'])->get();
        $brand_list = Brand::findOrFail($id);
        $data = [
            'category' => $cat_list,
            'brand' => $brand_list
        ];
        return view('backend.edit_brand_product',$data);
    }
    public function edit_brand_product(Request $request,$id){
        $cat_list = Category::select(['category_id','category_name'])->get();
        $brand_list = Brand::findOrFail($id);
        $data = [
            'category' => $cat_list,
            'brand' => $brand_list,
            "error" => []
        ]; 
        
        if(empty($request->brand_product_name)){
            $data['error']['name'] = "Bạn không được để trống tên thương hiệu!!!";
        }else{
            $brand_product_name = $request->brand_product_name;
        }

        if(empty($request->brand_product_desc)){
            $data['error']['desc'] = "Bạn không được để trống tên mô tả thương hiệu!!!";
        }else{
            $brand_product_desc = $request->brand_product_desc;
        }
        if($request->list_category_product == 0){
            $data['error']['list'] = "Bạn được để trống danh sách danh mục!!!";
        }else{
            $list_category_product = $request->list_category_product;
        }
        
        if(empty($data['error'])){
            $data = array(
                'brand_name' => $brand_product_name,
                'brand_desc' => $brand_product_name,
                'category_id' =>$list_category_product
             );
            Brand::where('brand_id',$id)->update($data);  
            return redirect()->route('all_brand');
        }else{
            return view('backend.edit_brand_product')->with($data);
        }    
        return view('backend.edit_brand_product',$data);
    }

    #Delete thương hiệu sản phẩm
    public function delete_brand_product(Request $request,$id){
        $id = $request->id;
        Brand::destroy($id);
        return back();
    }
}
