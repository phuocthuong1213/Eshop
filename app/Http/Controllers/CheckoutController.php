<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use  Illuminate\Support\Facades\Redirect;
session_start();
use App\Customer;
use App\Sipping;
use App\Payment;
use App\Order;
use App\DetailOrder;
use Cart;
use DB;
class CheckoutController extends Controller
{
    public function login_checkout(){
        return view('page.login_checkout');
    }
    public function add_customer(Request $request){
        $data = [
            'error' => [],
        ];

        if(empty($request->customer_name)){
            $data['error']['name'] = "Bạn không được để trống tên tài khoản!!!";
        }else{
            $customer_name = $request->customer_name;
        }

        if(empty($request->customer_email)){
            $data['error']['email'] = "Bạn không được để trống email!!!";
        }else{  
            $customer_email = $request->customer_email;
        }

        if(empty($request->customer_password)){
            $data['error']['password'] = "Bạn không được để trống mật khẩu!!!";
        }else{  
            $customer_password = $request->customer_password;
        }

        if(empty($request->customer_number)){
            $data['error']['number'] = "Bạn không được để trống số điên thoại!!!";
        }else{  
            $customer_number = $request->customer_number;
        }
        
        if(empty($data['error'])){
            $data = array(
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_password'=>md5($customer_password),
                'customer_phone'=>$customer_number,
            );
            $customer_id = DB::table('tbl_customer')->insertGetId($data);
            Session::put('customer_id',$customer_id);
            Session::put('customer_name',$request->customer_name);   
            return redirect('/checkout');
            // $find = Customer::where('customer_email', $customer_email)->first();
            // if($find) {
            //     $messenger['succes'] = "Tên đăng nhập Email đã được đăng ký!!!";
            //     return view('page.login_checkout')->with($messenger);
            // }else{
               
            // }
        }else{
            return view('page.login_checkout')->with($data);
        } 
    }
   
    public function checkout(){
        return view('page.checkout');
    }

    public function save_checkout_customer(Request $request){

       $data = [
            'error' => [],
        ];

        if(empty($request->shipping_name)){
            $data['error']['name'] = "Bạn không được để trống tên tài khoản!!!";
        }else{
            $shipping_name = $request->shipping_name;
        }

        if(empty($request->shipping_email)){
            $data['error']['email'] = "Bạn không được để trống email!!!";
        }else{  
            $shipping_email = $request->shipping_email;
        }

        if(empty($request->shipping_address)){
            $data['error']['password'] = "Bạn không được để trống địa chỉ!!!";
        }else{  
            $shipping_address = $request->shipping_address;
        }

        if(empty($request->shipping_phone)){
            $data['error']['number'] = "Bạn không được để trống số điên thoại!!!";
        }else{  
            $shipping_phone = $request->shipping_phone;
        }

        if(empty($data['error'])){
            $data = array(
                'shipping_name' => $shipping_name,
                'shipping_email' => $shipping_email,
                'shipping_address'=>$shipping_address,
                'shipping_phone'=> $shipping_phone,
                'shipping_nodes' => $request->shipping_nodes
            );
            $shipping = new Sipping($data);
            $shipping_id = $shipping->insertGetId($data);
            Session::put('shipping_id',$shipping_id);
            return redirect('/payment');
        }else{
            return view('page.checkout')->with($data);
        }
    }

    public function order_place(Request $request){  
        #Insert payment
        $data = array(
            'payment_method' => $request->payment_option,
            'payment_status' => 'Đang chờ xử lý',
        ); 
        $payment = new Payment($data);
        $payment->save();
        $payment_id = $payment->id;

        #Insert order
        $order_data = array(
            'customer_id' => Session::get('customer_id'),
            'shipping_id' => Session::get('shipping_id'),
            'payment_id'=> $payment_id,
            'order_total'=>Cart::total(0),
            'order_status'=>'Đang chờ xử lý',
        ); 

        $order = new Order($order_data);
        $order->save();
        $order_id = $order->id;

        #Insert detail order
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_detail_data = array(
                'product_id' => $v_content->id,
                'order_id' => $order_id,
                'product_price'=> $v_content->price,
                'product_name'=>$v_content->name,
                'product_qty' => $v_content->qty,
            ); 
            $detail_order = new DetailOrder($order_detail_data);
            $detail_order->save();
        }

        if($data['payment_method'] == 1){
            echo "Thanh toán tiền mặt";
        }else if($data['payment_method'] == 2){
            Cart::destroy();
            return view('page.handcase');
        }else{
            echo "Thẻ ghi nợ";
        }
    }

    public function payment(){
        return view('page.payment');
    }

    public function logout_checkout(){
        Session::flush();
        return redirect('login-checkout');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        Session::put('customer_id',$result->customer_id);
        return redirect('/checkout');
    }
}
