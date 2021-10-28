<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|{{(@in_array(['color_id'=>$color->id],$color_array))?"selected":""}}
{{(@in_array(['size_id'=>$size->id],$size_array))?"selected":""}}

| Here is where you can register web routes for your application. These

 $this->validate($request,[
            'size_id' => 'required',
            'color_id' => 'required'
        ]);
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
     Route::get('/', function () {
      return view('welcome');
      });
      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

      @if(session()->has('success'))
   <script type="text/javascript">
      $(function(){
       $.notify("{{(session()->get('success')}}",{globalPosition:'top right', 
       className:'success'});
      });
   </script>
  @endif
//ffffffffffffffff{{$service->short_title}}
|
*/

Route::get('/', function () {
      return view('welcome');
      });


Route::get("/","Youtube@index");
Route::get('about-us','Youtube@aboutUs')->name ('about.us');
Route::get('contact-us','Youtube@contactUs')->name ('contact.us');
Route::post('/contact/store','Youtube@store')->name ('contact.store');
Route::get('/shopping-cart','Youtube@shoppimgCart')->name ('shopping.cart');
Route::get('/product-list','Youtube@productList')->name ('products.list');
Route::get('/product-category/{category_id}','Youtube@categoryWiseproduct')
->name ('category.wise.product');
Route::get('/product-brand/{brand_id}','Youtube@brandWiseproduct')
->name ('brand.wise.product');
Route::get('/product-detail/{slug}','Youtube@productDetails')
->name ('product.details.info');



//shopping-cart

Route::post('/add-to-cart','CartController@addtoCart')->name('insert.cart');
Route::get('/show-cart','CartController@showCart')->name('show.cart');
Route::post('/update-cart','CartController@updateCart')->name('update.cart');
Route::get('/delete-cart/{rowId}','CartController@deleteCart')->name('delete.cart');

//customer

Route::get('/customer-login','CheckoutController@customerLogin')->name('customer.login');
Route::get('/customer-singup','CheckoutController@customerSingup')->name('customer.singup');
Route::post('/singup-store','CheckoutController@signupStore')->name('singup.store');
Route::get('/email-verify','CheckoutController@emailVerify')->name('email.verify');
Route::post('/verify-store','CheckoutController@verifyStore')->name('verify.store');
Route::get('/checkout','CheckoutController@checkOut')->name('customer.checkout');
Route::post('/checkout/store','CheckoutController@checkStore')->name('customer.checkout.store');
Route::get('/payment','CheckoutController@payment')->name('customer.payment');














Auth::routes();
//customer-dashboard  Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth','customer']],function(){
      Route::get('/dashboard','DashboardController@dashboard')->name('dashboard');
      Route::get('/customer-edit-profile','DashboardController@editProfile')->name('customer.edit.profile');
      Route::post('/customer-update-profile','DashboardController@updateProfile')->name('customer.update.profile');
      Route::get('/customer-password-change','DashboardController@passwordChange')->name('customer.password.change');
      Route::post('/customer-password-update','DashboardController@passwordUpdate')->name('customer.password.update');
      Route::get('/payment','DashboardController@payment')->name('customer.payment');
      Route::post('/payment/store','DashboardController@paymentStore')->name('customer.payment.store');
      Route::get('/order-list','DashboardController@orderList')->name('customer.order.list');
});


Route::group(['middleware'=>['auth','admin']],function(){
      //admin-dashboard
      Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
      Route::prefix('users')->group(function(){
            Route::get('/view','Backend\UserController@view')->name('users.view');   
            Route::get('/add','Backend\UserController@add')->name('users.add');
            Route::post('/store','Backend\UserController@store')->name('users.store');
            Route::get('/edit/{id}','Backend\UserController@edit')->name('users.edit');
            Route::post('/update/{id}','Backend\UserController@update')->name('users.update');
            Route::get('/delete/{id}','Backend\UserController@delete')->name('users.delete');
      });
      
      
      
      Route::prefix('profiles')->group(function(){
            Route::get('/view','Backend\ProfileController@view')->name('profiles.view');
            Route::get('/edit','Backend\ProfileController@edit')->name('profiles.edit');
            Route::post('/store','Backend\ProfileController@update')->name('profiles.update');
            Route::get('/password/view','Backend\ProfileController@passwordView')->name('profiles.password.view');
            Route::post('/password/update','Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
           
      });
      
      Route::prefix('logos')->group(function(){
            Route::get('/view','Backend\LogoController@view')->name('logos.view');
            Route::get('/add','Backend\LogoController@add')->name('logos.add');
            Route::post('/store','Backend\LogoController@store')->name('logos.store');
            Route::get('/edit/{id}','Backend\LogoController@edit')->name('logos.edit');
            Route::post('/update/{id}','Backend\LogoController@update')->name('logos.update');
            Route::get('/delete/{id}','Backend\LogoController@delete')->name('logos.delete');
      });
      
      
      Route::prefix('sliders')->group(function(){
            Route::get('/view','Backend\SliderController@view')->name('sliders.view');
            Route::get('/add','Backend\SliderController@add')->name('sliders.add');
            Route::post('/store','Backend\SliderController@store')->name('sliders.store');
            Route::get('/edit/{id}','Backend\SliderController@edit')->name('sliders.edit');
            Route::post('/update/{id}','Backend\SliderController@update')->name('sliders.update');
            Route::get('/delete/{id}','Backend\SliderController@delete')->name('sliders.delete');
      });
      
      
    
      
      Route::prefix('contacts')->group(function(){
            Route::get('/view','Backend\ContactController@view')->name('contacts.view');
            Route::get('/add','Backend\ContactController@add')->name('contacts.add');
            Route::post('/store','Backend\ContactController@store')->name('contacts.store');
            Route::get('/edit/{id}','Backend\ContactController@edit')->name('contacts.edit');
            Route::post('/update/{id}','Backend\ContactController@update')->name('contacts.update');
            Route::get('/delete/{id}','Backend\ContactController@delete')->name('contacts.delete');
            Route::get('/communicate','Backend\ContactController@viewCommunucate')->name ('contacts.communicate');
            Route::get('/communicate/delete/{id}','Backend\ContactController@deleteCommunucate')->name ('contacts.communucate.delete');


      });
      
      Route::prefix('abouts')->group(function(){
            Route::get('/view','Backend\AboutController@view')->name('abouts.view');
            Route::get('/add','Backend\AboutController@add')->name('abouts.add');
            Route::post('/store','Backend\AboutController@store')->name('abouts.store');
            Route::get('/edit/{id}','Backend\AboutController@edit')->name('abouts.edit');
            Route::post('/update/{id}','Backend\AboutController@update')->name('abouts.update');
            Route::get('/delete/{id}','Backend\AboutController@delete')->name('abouts.delete');
      });


      Route::prefix('categories')->group(function(){
            Route::get('/view','Backend\CategoryController@view')->name('categories.view');
            Route::get('/add','Backend\CategoryController@add')->name('categories.add');
            Route::post('/store','Backend\CategoryController@store')->name('categories.store');
            Route::get('/edit/{id}','Backend\CategoryController@edit')->name('categories.edit');
            Route::post('/update/{id}','Backend\CategoryController@update')->name('categories.update');
            Route::get('/delete/{id}','Backend\CategoryController@delete')->name('categories.delete');
      });

      Route::prefix('brands')->group(function(){
            Route::get('/view','Backend\BrandController@view')->name('brands.view');
            Route::get('/add','Backend\BrandController@add')->name('brands.add');
            Route::post('/store','Backend\BrandController@store')->name('brands.store');
            Route::get('/edit/{id}','Backend\BrandController@edit')->name('brands.edit');
            Route::post('/update/{id}','Backend\BrandController@update')->name('brands.update');
            Route::get('/delete/{id}','Backend\BrandController@delete')->name('brands.delete');
      });


      Route::prefix('colors')->group(function(){
            Route::get('/view','Backend\ColorController@view')->name('colors.view');
            Route::get('/add','Backend\ColorController@add')->name('colors.add');
            Route::post('/store','Backend\ColorController@store')->name('colors.store');
            Route::get('/edit/{id}','Backend\ColorController@edit')->name('colors.edit');
            Route::post('/update/{id}','Backend\ColorController@update')->name('colors.update');
            Route::get('/delete/{id}','Backend\ColorController@delete')->name('colors.delete');
      });


      Route::prefix('sizes')->group(function(){
            Route::get('/view','Backend\SizeController@view')->name('sizes.view');
            Route::get('/add','Backend\SizeController@add')->name('sizes.add');
            Route::post('/store','Backend\SizeController@store')->name('sizes.store');
            Route::get('/edit/{id}','Backend\SizeController@edit')->name('sizes.edit');
            Route::post('/update/{id}','Backend\SizeController@update')->name('sizes.update');
            Route::get('/delete/{id}','Backend\SizeController@delete')->name('sizes.delete');
      });

      Route::prefix('products')->group(function(){
            Route::get('/view','Backend\ProductController@view')->name('products.view');
            Route::get('/add','Backend\ProductController@add')->name('products.add');
            Route::post('/store','Backend\ProductController@store')->name('products.store');
            Route::get('/edit/{id}','Backend\ProductController@edit')->name('products.edit');
            Route::post('/update/{id}','Backend\ProductController@update')->name('products.update');
            Route::get('/delete/{id}','Backend\ProductController@delete')->name('products.delete');
            Route::get('/details/{id}','Backend\ProductController@details')->name('products.details');
      });

      Route::prefix('customers')->group(function(){
            Route::get('/view','Backend\CustomerController@view')->name('customers.view');
            Route::get('/draft/view','Backend\CustomerController@draftView')->name('customers.draft.view');
            Route::get('/delete','Backend\CustomerController@delete')->name('customers.delete');
          
      });
      
      
});
