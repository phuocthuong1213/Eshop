<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Str;
use App\Brand;
use App\Category;
use App\Product;
use DB;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    #Thêm sản phẩm
    public function get_add_product(){
        $cat_list = Category::select(['category_id','category_name'])->get();
        $brand_list = Brand::select(['brand_id','brand_name'])->get();
        return view('backend.add_product')->with(compact('cat_list','brand_list'));
    }
    public function add_product(Request $request){
        $cat_list = Category::select(['category_id','category_name'])->get();
        $brand_list = Brand::select(['brand_id','brand_name'])->get();
        $data_error = [
            'error' => []
        ];
        if(empty($request->images)){
            $data_error['error']['images'] = "Bạn chưa chọn hình ảnh!!!";
        }else{
            $filename = $request->images->getClientOriginalName();
        }

        if(empty($request->product_name)){
            $data_error['error']['pro_name'] = "Bạn chưa bạn chưa nhập tên sản phẩm!!!";
        }else{
            $product_name = $request->product_name;
        }

        if(empty($request->product_price)){
            $data_error['error']['pro_price'] = "Bạn chưa bạn chưa nhập giá sản phẩm!!!";
        }else{
            $product_price = $request->product_price;
        }

        if(empty($request->product_desc)){
            $data_error['error']['pro_desc'] = "Bạn chưa bạn chưa nhập mô tả sản phẩm!!!";
        }else{
            $product_desc = $request->product_desc;
        }

        if(empty($request->product_content)){
            $data_error['error']['pro_content'] = "Bạn chưa bạn chưa nhập chi tiết sản phẩm!!!";
        }else{
            $product_content = $request->product_content;
        }
        if(empty($data_error['error'])){
            $data = array(
                'product_name' => $product_name,
                'product_slug' => Str::slug($product_name),
                'product_price' => $product_price,
                'product_desc' => $product_desc,
                'product_content' => $product_content,
                'product_images' => $filename,
                'product_status' => $request->product_status,
                'category_id' => $request->category_id,
                'brand_id' =>$request->brand_id
            );
            $find = Product::where('product_name', $product_name)->first();
            if($find) {
                $messenger['succes'] = "Tên sản phẩm bị trùng mời bạn nhập lại";
                return view('backend.add_product')->with(compact('cat_list','brand_list','messenger'));
            }else{
                $messenger['succes'] = "Thêm sản phẩm thành công";
                $product = new Product($data);
                $product->save();
                $request->images->storeAs('avatarProduct',$filename);
                return view('backend.add_product')->with(compact('cat_list','brand_list','messenger'));
            }
        }else{
            return view('backend.add_product')->with(compact('cat_list','brand_list','data_error'));
        }
    }

    #Hiển thị tất cả sản phẩm
    public function all_product(){
        $data['list_product'] = DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->paginate(5);
        return view('backend.all_product')->with($data);
    }

      #Thay đổi trạng thái danh mục
    public function unactive_product(Request $request){
        $id = $request->id;
        
        Product::where('product_id',$id)->update(['product_status'=>1]);
        return redirect()->route('all_product');
       
    }

    public function active_product(Request $request){
        $id = $request->id;
        Product::where('product_id',$id)->update(['product_status'=>0]);
        return redirect()->route('all_product');
    }

     #Update thương hiệu
     public function get_edit_product(Request $request,$id){
        $id = $request->id;
        $product = Product::findOrFail($id);
        $cat_list = Category::select(['category_id','category_name'])->get();
        $brand = Brand::select(['brand_id','brand_name'])->get();
        $data = [
            "product" => $product,
            "category" => $cat_list,
            "brand" => $brand,
           
        ];
        return view('backend.edit_product',$data);
    }
    public function edit_product(Request $request,$id){
        $product = Product::findOrFail($id);
        $cat_list = Category::select(['category_id','category_name'])->get();
        $brand = Brand::select(['brand_id','brand_name'])->get();
        $data = [
            "product" => $product,
            "category" => $cat_list,
            "brand" => $brand,
            'error' => [],
        ];
        if(empty($request->product_name)){
            $data['error']['name'] = "Bạn chưa bạn chưa nhập tên sản phẩm!!!";
        }else{
            $product_name = $request->product_name;
        }
        if(empty($request->product_price)){
            $data['error']['price'] = "Bạn chưa bạn chưa nhập giá sản phẩm!!!";
        }else{
            $product_price = $request->product_price;
        }
        if(empty($request->product_desc)){
            $data['error']['desc'] = "Bạn chưa bạn chưa nhập mô tả sản phẩm!!!";
        }else{
            $product_desc = $request->product_desc;
        }
        
        if(empty($request->product_content)){
            $data['error']['content'] = "Bạn chưa bạn chưa nhập chi tiết sản phẩm!!!";
        }else{
            $product_content = $request->product_content;
        } 
            
        if($request->hasFile('images')){
            $img = $request->images->getClientOriginalName();
            $update['product_images'] = $img;
            $request->images->storeAs('avatarProduct',$img);
        }
                 
        if(empty($data['error'])){
                $update['product_name'] = $product_name;
                $update['product_slug'] = Str::slug($product_name);
                $update['product_price'] = $product_price;
                $update['product_desc'] = $product_desc;
                $update['product_content'] = $product_content;
                $update['category_id'] = $request->category_id;
                $update['brand_id'] = $request->brand_id;
                $product = new Product();
                $product::where('product_id',$id)->update($update);   
                return redirect()->route('all_product');   
        }else
            return view('backend.edit_product')->with($data);
    }
    #Delete sản phẩm
     public function delete_product(Request $request,$id){
        $id = $request->id;
        Product::destroy($id);
        return back();
    }
}
