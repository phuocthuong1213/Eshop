<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Frontend
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');


//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', 'ShowCategoryController@show_category_home')->name('show_category');

//Thương hiệu sản phẩm trang chủ
Route::get('/thuong-hieu-san-pham/{brand_id}', 'ShowBrandController@show_brand_home')->name('show_brand');

//Thương hiệu sản phẩm trang chủ
Route::get('/chi-tiet-san-pham/{product_id}/{slug}.html', 'DetailProductController@detail_product')->name('detail_product');

//Giỏ hàng
Route::post('/save-cart', 'CartProductController@save_cart')->name('cart_product');
Route::get('/save-cart', 'CartProductController@show_cart');
Route::get('/show-cart', 'CartProductController@show_cart')->name('show-cart');

#Xóa
Route::get('/delete-to-cart/{rowId}', 'CartProductController@delete_cart');

#Cập nhật số lượng
Route::post('/update-qty-cart', 'CartProductController@update_qty_cart');

#Khách hàng đăng ký
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::get('/add-customer', 'CheckoutController@add_customer');
#Checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/login-customer', 'CheckoutController@login_customer');

#Lưu thông tin gởi hàng đi
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer')->name('save_sipping');

Route::post('/add-customer', 'CheckoutController@add_customer');

#Thanh toán
Route::get('/payment', 'CheckoutController@payment');

#Đặt hàng
Route::post('/order-place', 'CheckoutController@order_place');




Auth::routes();

// Route::get('/', function () {
//     return view('home')->name('trang-chu');
// });

Route::get('/admin', 'AdminController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'AdminController@index')->name('dashboard');



//Backend
#Category Product
#Thêm danh mục!!!
Route::get('/add-category-product', 'CategoryProduct@add_category_product');

#Sửa danh mục
Route::post('/save-category-product', 'CategoryProduct@save_category_product')->name('save_category');
Route::get('/save-category-product', function () {
    return view('backend.add_category_product');
});

#update danh mục
Route::get('/edit-category-product/{id}', 'CategoryProduct@edit_category_product')->name('update_category');
Route::post('/edit-category-product/{id}', 'CategoryProduct@edit_category_product_post')->name('update_category_post');

#Delete danh mục
Route::get('/delete-category-product/{id}', 'CategoryProduct@delete_category_product')->name('delete_category');

#Hiển thị
Route::get('/all-category-product', 'CategoryProduct@all_category_product')->name('all_category');

Route::get('/unactive-category-product/{id}','CategoryProduct@unactive_category_product')->name('unactive');

Route::get('/active-category-product/{id}','CategoryProduct@active_category_product')->name('active');




#Brand Product

#Thêm thương hiệu!!!
Route::get('/add-brand-product', 'BrandProduct@get_add_brand_product');
Route::post('/add-brand-product', 'BrandProduct@add_brand_product')->name('add-brand-post');

#Hiển thị
Route::get('/all-brand-product', 'BrandProduct@all_brand_product')->name('all_brand');

#Thay đổi trạng thái thương hiệu
Route::get('/unactive-brand-product/{id}','BrandProduct@unactive_brand_product')->name('unactive_brand');

Route::get('/active-brand-product/{id}','BrandProduct@active_brand_product')->name('active_brand');

#Update thương hiệu
Route::get('/edit-brand-product/{id}', 'BrandProduct@get_edit_brand_product')->name('get_update_brand');

Route::post('/edit-brand-product/{id}', 'BrandProduct@edit_brand_product')->name('update_brand');

#Xóa thương hiệu
Route::get('/delete-brand-product/{id}', 'BrandProduct@delete_brand_product')->name('delete_brand');



#Add Product

#Thêm sản phẩm
Route::get('/add-product', 'ProductController@get_add_product');
Route::post('/add-product', 'ProductController@add_product')->name('add_product_post');

#Hiển thị
Route::get('/all-product', 'ProductController@all_product')->name('all_product');

#Thay đổi trạng thái sản phẩm
Route::get('/unactive-product/{id}','ProductController@unactive_product')->name('unactive_product');
Route::get('/active-product/{id}','ProductController@active_product')->name('active_product');

#Update sản phẩm
Route::get('/edit-product/{id}', 'ProductController@get_edit_product')->name('get_update_product');

Route::post('/edit-product/{id}', 'ProductController@edit_product')->name('update_product');

#Xóa sản phẩm
Route::get('/delete-product/{id}', 'ProductController@delete_product')->name('delete_product');


//Quản lý đơn hàng
Route::get('/mange-order', 'CartProductController@mange_order');
//Xem đơn hàng
Route::get('/view-order/{id}', 'CartProductController@view_order')->name('view_order');



