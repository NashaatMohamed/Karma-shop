
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Middleware\CheckRoles;

Route::group(['middleware' => ['checkroles','auth']], function() {
Route::controller(AdminController::class)->group(function(){
    Route::get("/homee","index")->name("AdminHome");
    Route::get("allusers","users_list")->name("UserList");
    Route::delete("users_delete","destroy_all")->name("UsersDelete");
    Route::delete("user_delete/{id}","destroy")->name("UserDelete");
    Route::Put("user_update/{id}","edit_user")->name("editUser");
    Route::get("user_create","create_user");
    Route::POST("user_create","Store_user")->name("createUser");
    Route::get("change_status/{id}/{status?}","change_user_status")->name("ChangeUserStatus");
    Route::get('test','test');
});
Route::resource("Brands",BrandController::class);
Route::post("brands",[BrandController::class,'editbrand'])->name("EditBrand");
Route::post("updatebrands",[BrandController::class,'updatebrand'])->name("UpdateBrand");
Route::delete("deletebrands",[BrandController::class,'deletebrand'])->name("DeleteBrand");

Route::controller(CategoriesController::class)->group(function(){
    Route::get("Cat_show","index")->name("CatShow");
    Route::get("Cat_get","create")->name("CatGet");
    Route::post("Cat_store","store")->name("CatStore");
    Route::post("Cat_edit","edit")->name("CatEdit");
    Route::post("Cat_update","update")->name("CatUpdate");
    Route::delete("Cat_delete","destroy")->name("CatDelete");
});

Route::controller(SubCategoriesController::class)->group(function(){
    Route::get("SubCat_show","index")->name("SubCatShow");
    Route::get("SubCat_get","create")->name("SubCatGet");
    Route::post("SubCat_store","store")->name("SubCatStore");
    Route::post("SubCat_edit","edit")->name("SubCatEdit");
    Route::post("SubCat_update","update")->name("SubCatUpdate");
    Route::delete("SubCat_delete","destroy")->name("SubCatDelete");
});

Route::controller(ProductController::class)->group(function(){
    Route::get("product_show","index")->name("productShow");
    Route::post("SubCat_get","Cat_SubCat")->name("CatSubCat");
    Route::get("product_get","create")->name("productGet");
    Route::post("product_store","store")->name("productStore");
    Route::post("product_edit","edit")->name("productEdit");
    Route::post("product_update","update")->name("productUpdate");
    Route::delete("product_delete","destroy")->name("productDelete");
});

});

