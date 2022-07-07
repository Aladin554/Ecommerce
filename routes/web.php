<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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


Route::group(['prefix'=>'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login',[AdminController::class,'loginForm']);
    Route::post('/login',[AdminController::class,'store'])->name('admin.login');
});
Route::middleware(['auth:admin'])->group(function(){

Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');

/*----------Admin Profile--------*/

Route::get('/admin/profile',[AdminProfileController::class,'AdminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit',[AdminProfileController::class,'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/update',[AdminProfileController::class,'AdminProfileUpdate'])->name('admin.profile.update');
Route::get('/admin/change/password',[AdminProfileController::class,'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/password/update',[AdminProfileController::class,'AdminUpdatePassword'])->name('admin.password.update');
/*----------Admin Profile--------*/
});  // end Middleware admin


Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id=Auth::user()->id;
        $user=User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::get('/',[IndexController::class,'index']);

Route::get('/user/logout',[IndexController::class,'UserLogout'])->name('user.logout');
Route::get('/user/profile',[IndexController::class,'UserProfile'])->name('user.profile');

Route::post('/user/profile/store',[IndexController::class,'UserProfileStore'])->name('user.profile.store');

Route::get('/user/change/password',[IndexController::class,'UserChangePassword'])->name('user.change.password');
Route::post('/user/update/password',[IndexController::class,'UserPasswordUpdate'])->name('user.update.password');




//admin Brand All Routes


    Route::get('brand/view',[BrandController::class,'BrandView'])->name('all.brand');
    Route::post('brand/store',[BrandController::class,'BrandStore'])->name('brand.store');

    Route::get('brand/edit/{id}',[BrandController::class,'BrandEdit'])->name('brand.edit');
    Route::post('brand/update/{id}',[BrandController::class,'BrandUpdate'])->name('brand.update');
    Route::get('brand/delete/{id}',[BrandController::class,'BrandDelete'])->name('brand.delete');


    //admin category All Routes

    Route::get('category/view',[CategoryController::class,'CategoryView'])->name('all.category');
    Route::post('category/store',[CategoryController::class,'CategoryStore'])->name('category.store');

    Route::get('category/edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category.edit');
    Route::post('category/update/{id}',[CategoryController::class,'CategoryUpdate'])->name('category.update');
    Route::get('category/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category.delete');


    //admin category All Routes

    Route::get('subcategory/view',[SubCategoryController::class,'SubcategoryView'])->name('all.subcategory');
    Route::post('subcategory/store',[SubCategoryController::class,'SubcategoryStore'])->name('subcategory.store');

    Route::get('subcategory/edit/{id}',[SubCategoryController::class,'SubcategoryEdit'])->name('subcategory.edit');
    Route::post('subcategory/update/{id}',[SubcategoryController::class,'SubcategoryUpdate'])->name('subcategory.update');
    Route::get('subcategory/delete/{id}',[SubcategoryController::class,'SubcategoryDelete'])->name('subcategory.delete');


    //admin category All Routes

    Route::get('sub/subcategory/view',[SubCategoryController::class,'SubsubcategoryView'])->name('all.subsubcategory');
    Route::get('category/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    Route::get('category/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
    Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

Route::post('/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');


Route::prefix('product')->group(function(){

    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
    Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');


});

// Admin Slider All Routes 

Route::prefix('slider')->group(function(){

    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
    
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');

    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');

    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');

    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');

    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
    
    });

    ///////////////////Language\\\\\\\\\\\\\\\\\\

    Route::get('/language/english', [LanguageController::class, 'English'])->name('language.english');
    
    Route::get('/language/bangla', [LanguageController::class, 'Bangla'])->name('language.bangla');

    ////////Product Details//////////////

    Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

    

    //// Frontend Product Tags Page //////

    Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

    Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

    Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);


    // Product View Modal with Ajax
    Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']); 
    