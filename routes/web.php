

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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();
//Index Page
Route::get('/','IndexController@index');
Route::get('/home', 'HomeController@index')->name('home');
	//Product FIlter
	Route::match(['get', 'post'],'/products-filter', 'ProductsController@filter');
	//Listing Pages
	Route::get('products/{url}','ProductsController@products');

	//Product Detail Page
	Route::get('product/{id}','ProductsController@product');
	
	//Cart Page
	Route::match(['get','post'],'/cart','ProductsController@cart');
	//Add to Cart Route
	Route::match(['get','post'],'/add-cart','ProductsController@addtocart');
	//delete product from cart
	Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');
	//Get Product Attribute price

	Route::get('get-product-price','ProductsController@getProductPrice');
	//Update Product Quantity in Cart
	Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');
	//Apply COupon
	Route::post('/cart/apply-coupon','ProductsController@applyCoupon');
	//User Login/Register Page 
	Route::get('/login-register','UsersController@userLoginRegister');
	// Forgot Password
	Route::match(['get', 'post'],'forgot-password','UsersController@forgot_password');
	//User Register FOrm Submit
	Route::post('/user-register','UsersController@register');
	// Confirm Account
	Route::match(['GET','POST'],'/confirm/{code}','UsersController@confirmAccount');
	//Users Login FOrm Submit
	Route::post('user-login','UsersController@login');
	//USerLogout
	Route::get('/user-logout','UsersController@logout');
	// Search Products
	Route::post('/search-products','ProductsController@searchProducts');

	//Check if the user already exists
	Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');
	
	//All Route after login 
	Route::group(['middleware'=>['frontlogin']],function(){
	 	//User Account Page
	 	Route::match(['get','post'],'account','UsersController@account');
	 	//Check User Password
		Route::get('/check-user-pwd','UsersController@chkUserPassword');
		// User Password
		Route::post('/update-user-pwd','UsersController@updatePassword');
		//CheckOut Page
		Route::match(['get','post'],'checkout','ProductsController@checkout');
		//Order Review Page
		Route::match(['get','post'],'/order-review','ProductsController@orderReview');
			//Place Order
		Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
			//Thanks Page
		Route::get('/thanks','ProductsController@thanks');
		//Paypal Page
		Route::get('/paypal','ProductsController@paypal');
			// Users Orders Page
		Route::get('/orders','ProductsController@userOrders');
		// User Ordered Products Details
		Route::get('/orders/{id}','ProductsController@userOrderDetails');
	 });
	 
	 Route::group(['middleware'=>['adminlogin']],function(){
	//Admin
	Route::get('admin/dashboard','AdminController@dashboard');
	Route::get('/admin/setting','AdminController@setting');
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

	//Categories Route(admin)
	Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
	Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
	Route::get('/admin/view-category','CategoryController@viewCategories');
	//Products Route
	Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
	Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
	Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
	Route::get('/admin/delete-product-video/{id}','ProductsController@deleteProductVideo');
	Route::match(['get','post'],'/admin/delete-product/{id}','ProductsController@deleteProduct');

	Route::get('/admin/view-product','ProductsController@viewProduct');
	
	//Products Atrributes
	Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');
	Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttributes');
		Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImages');
	Route::match(['get','post'],'/admin/delete-productattribute/{id}','ProductsController@deleteProductAttribute');
	Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');

	//Coupons Routes
	Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
	Route::get('admin/view-coupons','CouponsController@viewCoupons');
	Route::match(['get','post'],'/admin/edit_coupon/{id}','CouponsController@editCoupon');
	Route::match(['get','post'],'/admin/delete_coupon/{id}','CouponsController@deleteCoupon');

	//Banners Routes
	Route::match(['get','post'],'/admin/add-banner','BannersController@addbanner');
	Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
	Route::get('admin/view-banner','BannersController@viewbanner');
	Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');
	//Admin View Routes
	Route::get('/admin/view-orders','ProductsController@viewOrders');
	// User Ordered Products Details
	Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');
	// Order Invoice
	Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');

	// Update Order Status
	Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');
	// Admin Users Route 
	Route::get('/admin/view-users','UsersController@viewUsers');
	// Add CMS Route
	Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');
	//View CMS page
	Route::get('/admin/view-cms-pages','CmsController@viewCmsPages');
	// Edit CMS Page
	Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');
	//Delete CMS Page
	Route::get('/admin/delete-cms-page/{id}','CmsController@deleteCmsPage'); 
	//Add Currency
	Route::match(['get','post'],'/admin/add-currency','CurrencyController@addCurrency');
	//View Currency
	Route::get('/admin/view-currencies','CurrencyController@viewCurrencies');
	//Edit Currency
	Route::match(['get','post'],'/admin/edit-currency/{id}','CurrencyController@editCurrency');
	//Delete
	Route::get('/admin/delete-currency/{id}','CurrencyController@deleteCurrency');

		});




Route::get('/logout','AdminController@logout');

//Display Contact Page
Route::match(['GET','POST'],'/page/contact','CmsController@contact');

//Display CMS page
Route::match(['get','post'],'/page/{url}','CmsController@cmsPage');



