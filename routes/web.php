<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\UserCreateCheck;
use App\Http\Controllers\UserSettingsContoller;
use App\Http\Controllers\HomeController;

/*Sayfa Açma İşlemleri*/


Route::get('Account',function(){
    return view('user_account');
})->name('UserAccount');

/*User Settings*/ 
Route::get('Settings',[UserSettingsContoller::class,'getSettingsPage'])->name('Settings');
Route::get('Logout',[UserSettingsContoller::class,'logoutFun'])->name('Logout');
Route::middleware('usersetupdcheck')->post('UserSettingsUpdate',[UserSettingsContoller::class,'updateUserForDb'])->name('UserSettingsUpdate');
Route::get('DeleteUser',[UserSettingsContoller::class,'deleteUserForDb'])->name('DeleteUserDb');
Route::middleware('checkPermission')->post('UserApproval',[UserSettingsContoller::class,'userApproval'])->name('UserApproval');

Route::get('UpdateRole',[UserSettingsContoller::class,'updateUserRole'])->name('UpdateRole');


/*Login İşlemleri */
Route::get('Login', function () {
    return view('login');
})->name('Login');
Route::middleware('signupcheck')->post('SignUp',[UserController::class,'signUpUserForDb'])->name('SignUp');
Route::middleware('signupcheck')->post('SignIn',[UserController::class,'signInUser'])->name('SignIn');

/*Post Sayfası Ekleme, Düzenleme, Silme İşlemleri*/ 
Route::get('AddPost', function () {
    return view('post_add');
})->name('AddPost');

Route::middleware('postcheck')->post('AddPostDb',[PostController::class,'addPostForDb'])->name('AddPostDb');
Route::get("GetPost",[PostController::class,'getPostFromDb'])->name('GetPost');
Route::get("GetPosts",[PostController::class,'getPostsFromDb'])->name('GetPosts');
Route::post("EditPost",[PostController::class,"editPost"])->name('EditPost')->middleware('checkPermission');
Route::post("EditPostOfDb",[PostController::class,"editPostOfDb"])->name('EditPostOfDb');
Route::middleware('checkPermission')->post("PostApproval",[PostController::class,"postApproval"])->name('PostApproval');
Route::middleware('checkPermission')->post("PostCancel",[PostController::class,"postCanceled"])->name('PostCancel');
Route::middleware('checkPermission')->post("PostDelete",[PostController::class,"postDeleted"])->name('PostDelete');

/*Anasayfa */ 
Route::get("/",[HomeController::class,'index'])->name("Anasayfa");


/*Post Detay Sayfası ve kullanıcı görüntüleme sayfası. */ 

Route::get('/posts/{url}', [PostController::class, 'show'])->name('posts.show');

Route::get('/staffs/{id}', [PostController::class, 'accountshow'])->name('staffs.show');


/*Users Sayfası*/

Route::get("Users",[UserSettingsContoller::class,'userspage'])->name("Users")->middleware('checkPermission');
Route::post("EditUserRole",[UserSettingsContoller::class,'editUserRole'])->name("EditUserRole")->middleware('checkPermission');
Route::post("EditUserRoleFun",[UserSettingsContoller::class,'editUserRoleDb'])->name("EditUserRoleFun")->middleware('checkPermission');


/*Comment Olayları*/
Route::post("AddComment",[PostController::class,"addComment"])->name("AddComment");



