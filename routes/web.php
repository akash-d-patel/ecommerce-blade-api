<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PDFController;

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
// Demo routes
Auth::routes();

//Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('forgot', 'Auth\ForgotPasswordController@showLinkRequestForm');

Route::group(['middleware' => 'auth'], function () {
   Route::get('/', 'DashboardController@index');
   Route::resource('users', UserController::class);
   Route::resource('attributes', AttributeController::class);
   Route::resource('brands', BrandController::class);
   Route::get('importcsv/brands', 'BrandController@importcsv')->name('importcsv.brands');
   Route::post('import/brands', 'BrandController@import')->name('import.brands');
   Route::resource('categories', CategoryController::class);
   Route::resource('products', ProductController::class);

   /* exports */
   Route::get('export/products', 'ProductController@export')->name('export.products');
   Route::get('pdf/products', 'ProductController@index')->name('pdf.products');
   Route::get('pdf/generate', 'ProductController@generatePDF')->name('pdf.generate');

   Route::resource('attributes/{attribute}/attribute-value', AttributevalueController::class);
   Route::resource('testimonials', TestimonialController::class);
   Route::resource('seo', SeoController::class);
   Route::resource('news', NewsController::class);

   /* Products */
   Route::resource('products/{product}/images', ProductImageController::class, array("as" => "products"));
   Route::resource('products/{product}/product_description', ProductDescriptionController::class);
   Route::resource('menus', MenuController::class);
   Route::resource('brands/{brand}/files', FileController::class);
   Route::resource('brands/{brand}/images', BrandImageController::class, array("as" => "brands"));
   Route::resource('categories/{category}/images', CategoryImageController::class, array("as" => "categories"));
   Route::resource('news/{news}/images', NewsImageController::class, array("as" => "news"));
   Route::resource('coupons', CouponController::class);
   Route::resource('products/{product}/reviews', ReviewController::class);
   Route::resource('news/{news}/reviews', NewsReviewController::class, array("as" => "news"));
   Route::resource('countries', CountryController::class);
   Route::resource('states', StateController::class);
   Route::resource('cities',CityController::class);
   Route::resource('addresses',AddressController::class);
   Route::resource('newsLetters',NewsLetterController::class);
   Route::get('states-list','DropdownController@getStateList')->name('states.list');
   Route::get('cities-list','DropdownController@getCityList')->name('cities.list');
   Route::resource('tax',TaxController::class);
   Route::resource('currency',CurrencyController::class);
   Route::resource('timezone',TimezoneController::class);
   Route::resource('languages',LanguageController::class);
   Route::resource('email_templates',EmailTemplateController::class);
   Route::resource('todos',TodoController::class);
   Route::resource('messages',MessageController::class);
   Route::resource('brands/{brand}/seo',BrandsSeoController::class, array("as"=>"brands"));
   Route::resource('userMessages',UserMessageController::class);
   Route::resource('products/{product}/seo',ProductsSeoController::class, array("as"=>"products"));
   Route::resource('categories/{category}/seo',CategorySeoController::class,array("as"=>"categories"));
   Route::resource('banners',BannerController::class);
   Route::resource('banners/{banner}/images',BannerImageController::class,array("as"=>"banners"));
   Route::resource('clients',ClientController::class);
   Route::resource('roles',RoleController::class);
   Route::resource('user_roles',UserRoleController::class);
   Route::resource('permissions',PermissionController::class);
   Route::resource('role_permissions',RolePermissionController::class);

   Route::get('/profile', 'ProfileController@index')->name('profile');
   Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');

});
