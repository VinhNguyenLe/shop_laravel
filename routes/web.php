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
Route::get('/', 'HomeController@index');
Route::get('/tim-kiem', 'HomeController@search');

Route::get('/lien-he','ContactController@contact');

Route::get('/add-contact','ContactController@add_contact');
Route::get('/edit-contact/{contactId}','ContactController@edit_contact');
Route::get('/all-contact','ContactController@all_contact');
Route::get('/delete-contact/{contactId}','ContactController@delete_contact');
Route::post('/save-contact','ContactController@save_contact');
Route::post('/update-contact/{contactId}','ContactController@update_contact');

Route::get('/enable-contact/{contactId}','ContactController@enale_contact');
Route::get('/disable-contact/{contactId}','ContactController@disable_contact');


//Home
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryController@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}', 'BrandController@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@details_product');

//Backend
//Admin
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/filter-by-date', 'AdminController@filter_by_date');

Route::get('/logout', 'AdminController@log_out');

Route::post('/admin-dashboard', 'AdminController@dashboard');

//Category Product
Route::get('/add-category-product', 'CategoryController@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryController@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryController@delete_category_product');
Route::get('/all-category-product', 'CategoryController@all_category_product');

Route::get('/active-category-product/{category_product_id}', 'CategoryController@active_category_product');
Route::get('/unactive-category-product/{category_product_id}', 'CategoryController@unactive_category_product');

Route::post('/save-category-product', 'CategoryController@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'CategoryController@update_category_product');

//Brand Product
Route::get('/add-brand-product', 'BrandController@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'BrandController@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'BrandController@delete_brand_product');
Route::get('/all-brand-product', 'BrandController@all_brand_product');

Route::get('/active-brand-product/{brand_product_id}', 'BrandController@active_brand_product');
Route::get('/unactive-brand-product/{brand_product_id}', 'BrandController@unactive_brand_product');

Route::post('/save-brand-product', 'BrandController@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'BrandController@update_brand_product');

Route::group(['middleware' => 'auth.roles'], function(){
    //Product
    Route::get('/add-product', 'ProductController@add_product');
    Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
    Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
    Route::get('/all-product', 'ProductController@all_product');

    Route::get('/active-product/{product_id}', 'ProductController@active_product');
    Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');

    Route::post('/save-product', 'ProductController@save_product');
    Route::post('/update-product/{product_id}', 'ProductController@update_product');
});

//Comment
Route::post('/load-comment', 'ProductController@load_comment');
Route::post('/send-comment', 'ProductController@send_comment');

Route::get('/list-comment', 'ProductController@list_comment');
Route::post('/reply-comment', 'ProductController@reply_comment');




Route::group(['middleware' => 'admin.roles'], function(){
    //User
    Route::get('/user', 'UserController@index');
    Route::get('/add-user', 'UserController@add_user');
    Route::post('/store-users', 'UserController@store_users');
    Route::post('/assign-roles', 'UserController@assign_roles');
    Route::get('/delete-user-roles/{admin_id}', 'UserController@delete_user_roles');

});
//Cart
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');

Route::get('/gio-hang', 'CartController@show_cart_ajax');
Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
Route::post('/update-cart-ajax', 'CartController@update_cart_ajax');
Route::get('/delete-product-ajax/{session_id}', 'CartController@delete_product_ajax');
Route::get('/delete-all-product-ajax', 'CartController@delete_all_product_ajax');

//Coupon
Route::post('/check-coupon', 'CouponController@check_coupon');
Route::get('/unset-coupon', 'CouponController@unset_coupon');

Route::get('/show-all-coupon', 'CouponController@show_all_coupon');

Route::get('/add-coupon', 'CouponController@add_coupon');
Route::post('/insert-coupon-code', 'CouponController@insert_coupon_code');
Route::get('/list-coupon', 'CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}', 'CouponController@delete_coupon');

//Checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::get('/checkout', 'CheckoutController@checkout');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::get('/delete-fee','CheckoutController@delete_fee');
Route::post('/confirm-order', 'CheckoutController@confirm_order');

Route::post('/add-customer', 'CheckoutController@add_customer');
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');
Route::post('/order-place', 'CheckoutController@order_place');

//*Admin manager order
Route::get('/manager-order', 'OrderController@manager_order');
Route::get('/view-order/{order_code}', 'OrderController@view_order');
Route::get('/print-order/{checkout_code}', 'OrderController@print_order');

Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');
//* Home
Route::get('/history', 'OrderController@history');
Route::get('/view-history/{order_code}', 'OrderController@view_history');




// Route::get('/manager-order', 'CheckoutController@manager_order');
// Route::get('/view-order/{orderId}', 'CheckoutController@view_order');

//Delivery
Route::get('/delivery', 'DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');

//Slider
Route::get('/manage-slider','SliderController@manage_slider');
Route::get('/add-slider','SliderController@add_slider');
Route::get('/delete-slide/{slide_id}','SliderController@delete_slide');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','SliderController@active_slide');

//CSV
Route::post('/export-category-csv','CategoryController@export_category_csv');
Route::post('/export-brand-csv','BrandController@export_brand_csv');
Route::post('/export-product-csv','ProductController@export_product_csv');
// Route::post('/import-csv','CategoryController@import_csv');


//Authentication Roles
Route::get('/register-auth','AuthController@register_auth');
Route::get('/login-auth','AuthController@login_auth');
Route::get('/logout-auth','AuthController@logout_auth');
//!
Route::get('/change-password','AuthController@change_password_auth');

Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');

//Gallery
Route::get('/add-gallery/{productId}', 'GalleryController@add_gallery');
Route::post('/select-gallery', 'GalleryController@select_gallery');
Route::post('/insert-gallery/{productId}', 'GalleryController@insert_gallery');
Route::post('/update-gallery-name', 'GalleryController@update_gallery_name');
Route::post('/remove-gallery', 'GalleryController@delete_gallery');


//Send Mail
Route::get('/send-mail', 'MailController@send_mail');
Route::get('mail', 'MailController@mail');

//! Login facebook google
Route::get('/login-facebook','LoginFacebookController@login_facebook');
Route::get('/admin/callback','LoginFacebookController@callback_facebook');
Route::get('/login-google','LoginFacebookController@login_google');
Route::get('/google/callback','LoginFacebookController@callback_google');

Route::get('/trang-chu', 'HomeController@index');