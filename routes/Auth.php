<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;

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

Route::controller(AuthenticationController::class)->group(function(){
    Route::get("register","register")->name("register");
    Route::Post("register","store_user")->name("storeUser");
    Route::get("login","Login")->name("login");
    Route::post("login","auth_user")->name("authUser");
    Route::get("profile","profile")->name("profile")->middleware('auth');
    Route::put("profile","update_profile")->name("updateProfile");
    Route::put("image","update_image")->name("updateImage");
    Route::get("logout","logout")->name("Logout");
    Route::get("contact","Contact_us")->name("ContactUS");
    Route::Post("contact","Contact_store")->name("ContactStore");
    Route::get("forgetpassword","forget_password")->name("ForgetPassword"); // to show form to put your email
    Route::post("forgetpassword","send_forget_password_email")->name("SendForgetPasswordEmail"); // to send email
    Route::get("ResetPassword/{token}","reset_password")->name("ResetPassword"); // show form to write password and confirmpassword
    Route::post("ConfirmPassword","confirm_password")->name("ConfirmPassword"); // update password
});


