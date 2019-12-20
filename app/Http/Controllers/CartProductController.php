<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use Session;
use  Illuminate\Support\Facades\Redirect;
use Cart;
use App\Customer;
use App\Order;
session_start();
class CartProductController extends Controller
{
    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $qty = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
        
        
        $data['id'] = $productId;
        $data['qty'] = $qty;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_images;
        $data['weight'] = 0;
        cart::add($data);
        return redirect('/show-cart');
    }

    public function update_qty_cart(Request $request){
        $rowID = $request->rowId_cart;
        $qty = $request->quantity;
        Cart::update($rowID,$qty);
        return redirect('/show-cart');
    }

    public function show_cart(){
        return view('page.cart_product');
    }
    public function delete_cart($rowId){
        Cart::update($rowId,0);
        return redirect('/show-cart');
    }

    #Quản lý đơn hàng
    public function mange_order(){
        $data = [
            'orders'=> Order::all()
        ];
        return view('backend.mange_order')->with($data);
    }

    public function view_order(Request $request,$id){
        $data = [
            'order'=> Order::findOrFail($id) 
        ];
        return view('backend.view_order')->with($data);
    }
}
