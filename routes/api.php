<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Api\LoginController@login');
//Route::post('register', Api\LoginController::class);
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('users', UserController::class);
    Route::resource('userMessages', UserMessageController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('cities', CityController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('email_templates', EmailTemplateController::class);
    Route::resource('todos', TodoController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('timezone', TimezoneController::class);
    Route::resource('currency', CurrencyController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('products', ProductController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('news', NewsController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('tax', TaxController::class);
    Route::resource('newsLetters', NewsLetterController::class);
    Route::resource('seo', SeoController::class);
    Route::resource('attributes/{attribute}/attribute-value', AttributevalueController::class);
    Route::resource('brands/{brand}/files', FileController::class);
    Route::resource('banners/{banner}/images', BannerImageController::class, array("as" => "banners"));
    Route::resource('categories/{category}/images', CategoryImageController::class, array("as" => "categories"));
    Route::resource('products/{product}/images', ProductImageController::class, array("as" => "products"));
    Route::resource('brands/{brand}/images', BrandImageController::class, array("as" => "brands"));
    Route::resource('news/{news}/images', NewsImageController::class, array("as" => "news"));
    Route::resource('brands/{brand}/seo', BrandsSeoController::class, array("as" => "brands"));
    Route::resource('categories/{category}/seo', CategorySeoController::class, array("as" => "categories"));
    Route::resource('products/{product}/seo', ProductsSeoController::class, array("as" => "products"));
    Route::resource('products/{product}/reviews', ReviewController::class);
    Route::resource('products/{product}/product_description', ProductDescriptionController::class);
    Route::resource('news/{news}/reviews', NewsReviewController::class, array("as" => "news"));
    Route::resource('clients', ClientController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('user_roles',UserRoleController::class);
    Route::resource('permissions',PermissionController::class);
    Route::resource('role_permissions',RolePermissionController::class);
});
