<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BkashController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\MpesaCallbackController;
use App\Http\Controllers\CategoryController;



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
// routes/web.php
Route::get('/products', [HomeController::class, 'products']);


Route::get('/simple', function () {
    return view('welcome');
});
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/about', [HomeController::class, 'about'])->name('home');
Route::get('/about', [AboutsController::class, 'index'])->name('about.index');


Route::post("/register/confirm",'App\Http\Controllers\HomeController@register')->name('register/confirm');
Route::get("/redirects",'App\Http\Controllers\HomeController@redirects');
 
#Route::get("/menu",'App\Http\Controllers\MenuController@menu');
Route::get('/menu', [HomeController::class, 'index'])->name('home');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('show');


Route::get('/trace-my-order', [ShipmentController::class, 'trace'])->name('trace-my-order');


Route::get('/my-order', [ShipmentController::class, 'my_order'])->name('my-order');


Route::get("/rate/{id}", [HomeController::class, 'rate'])->name('rate');


Route::get("/top/rated", [HomeController::class, 'top_rated'])->name('top/rated');



Route::get("edit/rate/{id}", [HomeController::class, 'edit_rate'])->name('edit/rate');



Route::post("coupon/apply", [ShipmentController::class, 'coupon_apply'])->name('coupon/apply');





Route::get("delete/rate", [HomeController::class, 'delete_rate'])->name('delete/rate');



Route::get("/rate/confirm/{value}", [HomeController::class, 'store_rate'])->name('rate.confirm');


Route::get("/cart", [CartController::class, 'index'])->name('cart');


Route::post('/menu/{product}', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/mails/shipped/{total}', [ShipmentController::class, 'place_order'])->name('mails.shipped');
Route::post('/confirm_place_order/{total}', [ShipmentController::class, 'send'])->name('confirm_place_order');

Route::post('/checkout/{total}', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/reserve/confirm', [HomeController::class, 'reservation_confirm'])->name('reserve.confirm');

Route::post('/trace/confirm', [ShipmentController::class, 'trace_confirm'])->name('trace.confirm');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('ssl/pay', [BkashController::class, 'ssl']);
Route::get('ssl/pay2', [BkashController::class, 'ssl2']);

Route::group(['middleware' => ['customAuth']], function () {

    // Payment Routes for bKash
    Route::post('bkash/get-token', 'BkashController@getToken')->name('bkash-get-token');
    Route::post('bkash/create-payment', 'BkashController@createPayment')->name('bkash-create-payment');
    Route::post('bkash/execute-payment', 'BkashController@executePayment')->name('bkash-execute-payment');
    Route::get('bkash/query-payment', 'BkashController@queryPayment')->name('bkash-query-payment');
    Route::post('bkash/success', 'BkashController@bkashSuccess')->name('bkash-success');

    // Refund Routes for bKash
    Route::get('bkash/refund', 'BkashRefundController@index')->name('bkash-refund');
    
    Route::post('bkash/refund', 'BkashRefundController@refund')->name('bkash-refund');

});


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


// Mpesa

Route::post('/mpesa/callback/', [MpesaCallbackController::class, 'edit'])->name('mpesa');
Route::post('/stk_push', [MpesaCallbackController::class, 'stk_push']);
Route::get('/order-status/{tran_id}', [MpesaCallbackController::class, 'get_order_status']);



// Admin start Route


Route::get('/admin/home', [AdminController::class, 'home'])->name('/admin/home');

Route::get('/admin/food-menu', [AdminController::class, 'food_menu'])->name('/admin/food-menu');

Route::get('/orders/process', [AdminController::class, 'orders_process'])->name('/orders/process');
Route::get('/orders/cancel', [AdminController::class, 'orders_cancel'])->name('/orders/cancel');

Route::get('/add/menu', [AdminController::class, 'add_menu'])->name('/add/menu');
Route::get('/add/chef', [AdminController::class, 'add_chef'])->name('/add/chef');

Route::get('/admin/chefs', [AdminController::class, 'chefs'])->name('/admin/chefs');




Route::get('/admin/orders-incomplete', [AdminController::class, 'order_incomplete'])->name('/admin/orders-incomplete');
Route::get('/orders-complete', [AdminController::class, 'order_complete'])->name('/orders-complete');
Route::get('/admin/reservation', [AdminController::class, 'reservation'])->name('/admin/reservation');
Route::get('/admin/coupon', [AdminController::class, 'coupon_show'])->name('/admin/coupon');
Route::get('/admin/show', [AdminController::class, 'admin_show'])->name('/admin/show');
Route::get('/customer', [AdminController::class, 'user_show'])->name('/customer');
Route::get('/admin/charge', [AdminController::class, 'charge'])->name('/admin/charge');
Route::get('/admin/banner/all', [AdminController::class, 'banner'])->name('/admin/banner/all');
Route::get('/admin/customize', [AdminController::class, 'customize'])->name('/admin/cutomize');
Route::get('/admin/add/banner', [AdminController::class, 'banner_add'])->name('/admin/add/banner');

Route::post('/menu/add/process', [AdminController::class, 'menu_add_process'])->name('/menu/add/process');
Route::post('/chef/add/process', [AdminController::class, 'chef_add_process'])->name('/chef/add/process');


Route::get('/menu/delete/{id}', [AdminController::class, 'menu_delete_process'])->name('/menu/delete');
Route::get('/chef/delete/{id}', [AdminController::class, 'chef_delete_process'])->name('/chef/delete');


Route::get('/menu/edit/{id}', [AdminController::class, 'menu_edit'])->name('/menu/edit');
Route::get('/chef/edit/{id}', [AdminController::class, 'chef_edit'])->name('/chef/edit');

Route::post('/menu/edit/process/{id}', [AdminController::class, 'menu_edit_process'])->name('/menu/edit/process');
Route::post('/edit/chef/process/{id}', [AdminController::class, 'chef_edit_process'])->name('/edit/chef/process');
Route::post('/invoice/approve/{id}', [AdminController::class, 'invoice_approve'])->name('/invoice/approve');
Route::get('/invoice/details/{id}', [AdminController::class, 'invoice_details'])->name('invoice/details');
Route::get('/invoice/cancel-order/{id}', [AdminController::class, 'invoice_cancel'])->name('/invoice/cancel-order');


Route::get('/invoice/complete/{id}', [AdminController::class, 'invoice_complete'])->name('invoice/complete');

Route::get('/order/location', [AdminController::class, 'order_location'])->name('/order/location');
Route::post('/invoice/location/edit', [AdminController::class, 'edit_order_location'])->name('/invoice/location/edit');
Route::get('/delivery-boy', [AdminController::class, 'delivery_boy'])->name('/delivery-boy');

// categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); // Show all categories
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create'); // Show form to create a category
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store'); // Save a new category
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show'); // Show a single category
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); // Show form to edit a category
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); // Update an existing category
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // Delete a category
// selectors
Route::get('/api/categories', [CategoryController::class, 'index']);

// Admin

// Show all categories
Route::get('/admin/categories', [CategoryController::class, 'allcats'])->name('admin.categories.index');

// Show form to create a new category
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');

// Save a new category
Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');

// Show a single category using slug
Route::get('/admin/categories/{slug}', [CategoryController::class, 'show'])->name('admin.categories.show');

// Show form to edit a category using slug
Route::get('/admin/categories/{slug}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');

// Update an existing category using slug
Route::put('/admin/categories/{slug}', [CategoryController::class, 'update'])->name('admin.categories.update');

// Delete a category using slug
Route::delete('/admin/categories/{slug}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');


Route::get('/admin-add', [AdminController::class, 'add_admin'])->name('/admin-add');
Route::get('/add/delivery_boy', [AdminController::class, 'add_delivery_boy'])->name('/add/delivery_boy');
Route::post('/admin-add-process', [AdminController::class, 'add_admin_process'])->name('/admin-add-process');
Route::get('/admin/delete/{id}', [AdminController::class, 'delete_admin'])->name('/admin/delete');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit_admin'])->name('/admin/edit');
Route::post('/admin-edit-process/{id}', [AdminController::class, 'edit_admin_process'])->name('/admin-edit-process');
Route::post('/add-delivery-boy-process', [AdminController::class, 'add_delivery_boy_process'])->name('/add-delivery-boy-process');
Route::get('/delivery_boy/delete/{id}', [AdminController::class, 'delete_delivery_boy'])->name('/delivery_boy/delete');
Route::get('/delivery_boy/edit/{id}', [AdminController::class, 'edit_delivery_boy'])->name('/delivery_boy/edit');
Route::post('/edit_delivery_boy_process/{id}', [AdminController::class, 'edit_delivery_boy_process'])->name('/edit_delivery_boy_process');
Route::post('/banner/add/process', [AdminController::class, 'banner_add_process'])->name('/banner/add/process');
Route::get('/admin/banner/edit/{id}', [AdminController::class, 'banner_edit'])->name('/admin/banner/edit');
Route::post('/banner/edit/process/{id}', [AdminController::class, 'banner_edit_process'])->name('/banner/edit/process');
Route::get('/admin/banner/delete/{id}', [AdminController::class, 'banner_delete_process'])->name('/admin/banner/delete');
Route::get('/add/coupon', [AdminController::class, 'add_coupon'])->name('/add/coupon');
Route::post('/coupon-add-process', [AdminController::class, 'add_coupon_process'])->name('/coupon-add-process');
Route::get('/admin/coupon/delete/{id}', [AdminController::class, 'delete_coupon'])->name('/admin/coupon/delete');
Route::get('/admin/coupon/edit/{id}', [AdminController::class, 'edit_coupon'])->name('/admin/coupon/edit');
Route::post('/coupon-edit-process/{id}', [AdminController::class, 'edit_coupon_process'])->name('/coupon-edit-process');
Route::get('/add/charge', [AdminController::class, 'add_charge'])->name('/add/charge');
Route::post('/charge-add-process', [AdminController::class, 'add_charge_process'])->name('/charge-add-process');
Route::get('/admin/charge/delete/{id}', [AdminController::class, 'delete_charge'])->name('/admin/charge/delete');
Route::get('/admin/charge/edit/{id}', [AdminController::class, 'edit_charge'])->name('/admin/edit/delete');
Route::post('/charge-edit-process/{id}', [AdminController::class, 'edit_charge_process'])->name('/charge-edit-process');
Route::get('/customize/edit', [AdminController::class, 'customize_edit'])->name('/customize/edit');
Route::post('/customize_edit_process', [AdminController::class, 'edit_customize_process'])->name('/customize_edit_process');
// Blogs
use App\Http\Controllers\BlogPostController;

// Public Routes (for displaying posts)
Route::get('blog', [BlogPostController::class, 'index'])->name('blog.index'); // List all posts
Route::get('blog/{slug}', [BlogPostController::class, 'show'])->name('blog_details'); // Show a single post by slug

Route::get('category/{slug}', [HomeController::class, 'category'])->name('categories'); 

Route::get('api/category/{slug}', [HomeController::class, 'SingleCategory']); 
// Admin Routes (for managing posts)
Route::prefix('admin/blog')->name('admin.blog.')->middleware('auth')->group(function() {
    // List all blog posts for admin
    Route::get('/', [BlogPostController::class, 'index'])->name('index');

    // Create a new blog post
    Route::get('create', [BlogPostController::class, 'create'])->name('create');
    Route::post('create', [BlogPostController::class, 'store'])->name('store');

    // Edit an existing blog post
    Route::get('{blogPost}/edit', [BlogPostController::class, 'edit'])->name('edit');
    Route::post('{blogPost}/edit', [BlogPostController::class, 'update'])->name('update');

    // Delete a blog post
    Route::delete('{blogPost}', [BlogPostController::class, 'destroy'])->name('destroy');
});
// Group routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('admin/about/edit', [AboutsController::class, 'edit'])->name('about.edit');
    Route::post('about/update', [AboutsController::class, 'update'])->name('about.update');
});