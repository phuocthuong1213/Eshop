<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use DB;
use App\Brand;
class CategoryProduct extends Controller
{

   


    public function __construct() {
        $this->middleware('auth');
    }

    public function add_category_product(){
        return view('backend.add_category_product');
    }

    #Hiển thị
    public function all_category_product(){
        $data['all_category'] = DB::table('tbl_category')->orderBy('category_id','desc')->paginate(5);
        
        return view('backend.all_category_product')->with($data);
    }

    #Thay đổi trạng thái danh mục
    public function unactive_category_product(Request $request){
        $id = $request->id;
        
        Category::where('category_id',$id)->update(['category_status'=>1]);
        return redirect()->route('all_category');
       
    }

    public function active_category_product(Request $request){
        $id = $request->id;
        Category::where('category_id',$id)->update(['category_status'=>0]);
        return redirect()->route('all_category');
    }

    #Thêm danh mục
    public function save_category_product(Request $request){
        $data = [
            'error' => []
        ];

        if(empty($request->category_product_name)){
            $data['error']['name'] = "Bạn không được để trống tên danh mục!!!";
        }else{
            $category_product_name = $request->category_product_name;
        }

        if(empty($request->category_product_status)){
            $data['error']['status'] = "Bạn không được để trống mô tả!!!";
        }else{  
            $category_product_desc = $request->category_product_desc;
        }
        
        if(empty($data['error'])){
            $data = array(
                'category_name' => $category_product_name,
                'category_desc' => $category_product_desc,
                'category_status' => $request->category_product_status,
            );
            $find = Category::where('category_name', $request->category_product_name)->first();
            if($find) {
                $messenger['succes'] = "Tên danh mục bị trùng mời bạn nhập lại";
                return view('backend.add_category_product')->with($messenger);
            }else{
                $messenger['succes'] = "Thêm danh mục sản phẩm thành công";
                $category = new Category($data);
                $category->save();
                return view('backend.add_category_product')->with($messenger);
            }
        }else{
            return view('backend.add_category_product')->with($data);
        } 
        // DB::table('tbl_category')->insert($data);   
    }

    #Update danh mục

    public function edit_category_product(Request $request){
        $id = $request->id;
        $cat = Category::findOrFail($id);
        $data = [
            "cat" => $cat
        ];
        return view('backend.edit_category_product')->with($data);
    }

    public function edit_category_product_post(Request $request, $id){
        $cat = Category::findOrFail($id);

        // $request->validate([
        //     'category_name' => 'required|unique:category|max:255',
        //     'category_desc' => 'required',
        // ]);

        $data = [
            "cat" => $cat,
            "error" => []
        ];
   
        if(empty($request->category_product_name)){
            $data['error']['name'] = "Bạn không được để trống tên danh mục!!!";
        }else{
            $category_product_name = $request->category_product_name;
        }

        if(empty($request->category_product_desc)){
            $data['error']['desc'] = "Bạn không được để trống mô tả!!!";
        }else{
            $category_product_desc = $request->category_product_desc;
        }
    
        if(empty($data['error'])){
            $data = array(
                'category_name' => $category_product_name,
                'category_desc' => $request->category_product_desc,
             );
            Category::where('category_id',$id)->update($data);  
            return redirect()->route('all_category');
        }else{
            return view('backend.edit_category_product')->with($data);
        }    
    }

    #Delete danh mục sản phẩm
    public function delete_category_product(Request $request,$id){
        $id = $request->id;
        Category::destroy($id);
        return back();
    }

    //End function admin

    

}
