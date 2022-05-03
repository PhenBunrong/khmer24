<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
// Route::get('/about', [WebsiteController::class, 'about']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// user management
Route::group(['prefix' => 'user','middleware' => ['auth', 'check_user_is_active', 'super_admin'],'namespace' => 'Admin'], function () {
    Route::get('/index', 'UserController@index')->name('admin_user_index');
    Route::get('/view/{id}', 'UserController@view')->name('admin_user_view');
    Route::get('/create', 'UserController@create')->name('admin_user_create');
    Route::post('/store', 'UserController@store')->name('admin_user_store');
    Route::get('/edit/{id}', 'UserController@edit')->name('admin_user_edit');
    Route::post('/update', 'UserController@update')->name('admin_user_update');
    Route::post('/delete', 'UserController@delete')->name('admin_user_delete');

    Route::post('/test', 'UserController@test')->name('admin_user_test');
});

Route::group(['prefix' => 'user-role', 'middleware' => ['auth', 'check_user_is_active', 'super_admin'], 'namespace' => 'Admin'], function () {
    Route::get('/index', 'UserRoleController@index')->name('admin_user_role_index');
    Route::get('/view/{id}', 'UserRoleController@view')->name('admin_user_role_view');
    Route::get('/create', 'UserRoleController@create')->name('admin_user_role_create');
    Route::post('/store', 'UserRoleController@store')->name('admin_user_role_store');
    Route::get('/edit', 'UserRoleController@edit')->name('admin_user_role_edit');
    Route::post('/update', 'UserRoleController@update')->name('admin_user_role_update');
    Route::post('/delete', 'UserRoleController@delete')->name('admin_user_role_delete');
});

Route::group(
    [
        'prefix' => 'admin/product',
        'middleware' => ['auth'],
        'namespace' => 'Product'
    ],
    function () {

        // basic_page
        Route::resource('product', 'ProductController');

        Route::resource('brand', 'BrandController');
        Route::resource('main_category', 'MainCategoryController');
        Route::resource('category', 'CategoryController');
        Route::resource('sub_category', 'SubCategoryController');
        Route::resource('color', 'ColorController');
        Route::resource('size', 'SizeController');
        Route::resource('unit', 'UnitController');
        Route::resource('status', 'StatusController');
        Route::resource('writer', 'WriterController');
        Route::resource('publication', 'PublicationController');
        Route::resource('vendor', 'VendorController');

        Route::get('/get-all-cateogory-selected-by-main-category/{main_category_id}', 'CategoryController@get_category_by_main_category')->name('get_all_cateogory_selected_by_main_category');
        Route::get('/get-all-sub-cateogory-selected-by-category/{category_id}', 'CategoryController@get_sub_category_by_category')->name('get_all_sub_category_by_category');
        Route::get('/get-all-main-category-josn', 'MainCategoryController@get_main_category_json')->name('get_main_category_json');
        Route::get('/get-all-category-josn', 'CategoryController@get_category_json')->name('get_category_json');
    } 
);

// Route::group([ 'prefix' => 'admin/product','middleware' => ['auth'], 'namespace' => 'Product'], function () {

//     // basic_page
//     Route::resource('product', 'ProductController');

//     // Route::get('/brand','BrandController@index')->name('brand.index');
//     // Route::get('/brand/get/{id}','BrandController@get')->name('brand.get');
//     // Route::get('/brand/create','BrandController@create')->name('brand.create');
//     // Route::get('/brand/show/{id}','BrandController@show')->name('brand.show');
//     // Route::get('/brand/edit/{id}','BrandController@edit')->name('brand.edit');
//     // Route::post('/brand','BrandController@store')->name('brand.store');
//     // Route::put('/brand/{id}','BrandController@update')->name('brand.update');
//     // Route::delete('/brand/{id}','BrandController@destroy')->name('brand.destroy');

//     Route::get('/get-all-cateogory-selected-by-main-category/{main_category_id}', 'CategoryController@get_category_by_main_category')->name('get_all_cateogory_selected_by_main_category');
//     Route::get('/get-all-sub-cateogory-selected-by-category/{category_id}', 'CategoryController@get_sub_category_by_category')->name('get_all_sub_category_by_category');
//     Route::get('/get-all-main-category-josn', 'MainCategoryController@get_main_category_json')->name('get_main_category_json');
//     Route::get('/get-all-category-josn', 'CategoryController@get_category_json')->name('get_category_json');
// });

Route::group(
    [ 
        'prefix' => 'file-manager', 
        'middleware' => ['auth'], 
        'namespace' => 'Admin' 
    ], 
    function () { 
        Route::post('/store-file', 'FileManagerController@store_file')->name('admin_fm_store_file');
        Route::get('/get-files', 'FileManagerController@get_files')->name('admin_fm_get_files');
        Route::delete('/delete-file/{image}', 'FileManagerController@delete_file')->name('admin_fm_delete_file');
    }
);