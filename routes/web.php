<?php

use App\Http\Controllers\UserController;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
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


// login
Route::get('/login', function () {
    return view('auth/login');
});
Route::get('locale/{locale}', function ($locale){
    \Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('/login','authController@login')->name('login');
Route::post('/loginpost','authController@loginpost');
Route::get('user', 'authController@getAuthenticatedUser')->middleware('jwt.verify');
// signup
Route::get('/signup','authController@signup')->name('signup');
Route::post('/registerPost', 'authController@registerPost');
// logout
Route::get('/','authController@logout')->name('logout');

// Route::group(['middleware' => 'auth'], function() {
    // company
    Route::get('/home', 'UserController@getHome')->name('home'); 
    Route::get('/home', 'UserController@getCompany');
    Route::get('/home', 'UserController@uploadCompany');
    Route::post('/upload_company/proses_upload_company', 'UserController@proses_upload_company');
    Route::get('/upload/delate_company/{id}', 'UserController@hapus');
    Route::match(['get','post'], '/edit{id}','UserController@editCompany');
    Route::get('/CompaniesExport', 'UserController@getCompaniesExport');
    Route::post('/importCompanies', 'UserController@getCompaniesImport');
    Route::get('/search', 'UserController@searchCompany');

    // employe
    Route::get('/employe', 'UserController@getEmploye')->name('employe');
    Route::get('/employe', 'UserController@employe');
    Route::get('/employe', 'UserController@uploadEmploye');
    Route::post('/upload_employe/proses_upload_employe', 'UserController@proses_upload_employe');
    Route::get('/upload/delate_employe/{id}', 'UserController@hapus_employe');
    Route::match(['get','post'], '/edit{id}/editEmploye', 'UserController@editEmploye');
    Route::post('/importEmployes', 'UserController@getEmployeesImport');
    Route::get('/searchemploye', 'UserController@searchEmploye');

    // mail
    Route::get('/email', 'UserController@mail');

// });




