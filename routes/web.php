<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('email',  [App\Http\Controllers\HomeController::class, 'sendActiveUsersEmail'])->name('sendUsersMail');


Auth::routes();


//user route group
 Route::middleware(['auth'])->name('user.')->group(function () {
 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 Route::post('/userImport', [App\Http\Controllers\HomeController::class, 'import'])->name('import');
 Route::get('/userExport', [App\Http\Controllers\HomeController::class, 'export'])->name('export');

 Route::get('/fetch', [App\Http\Controllers\HomeController::class, 'fetchDataFromAPI'])->name('fetchDataFromAPI');
 Route::get('/viewFetch', [App\Http\Controllers\HomeController::class, 'viewFetch'])->name('viewFetch');

 });


//admin route group
Route::name('admin.')->prefix('admin')->group(function () {

 Route::middleware(['guest:admin'])->group(function(){
    Route::get('/',[App\Http\Controllers\Admin\Auth\LoginController::class,'showAdminLoginForm'])->name('login-view');
    Route::post('/',[App\Http\Controllers\Admin\Auth\LoginController::class,'adminLogin'])->name('login');

   Route::get('/register',[App\Http\Controllers\Admin\Auth\RegisterController::class,'showAdminRegisterForm'])->name('register-view');
    Route::post('/register',[App\Http\Controllers\Admin\Auth\RegisterController::class,'createAdmin'])->name('register');
 });


    Route::middleware(['auth:admin'])->group(function(){
 
     Route::get('/dashboard',[App\Http\Controllers\Admin\AdminHomeController::class,'index'])->name('home');

    });

});


