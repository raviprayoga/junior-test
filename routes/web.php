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

Route::group(['middleware' => 'jwt.verify'], function () {
        // company
        Route::get('/home', 'UserController@getHome')->name('home'); 
        Route::get('/home', 'UserController@getCompany');
        Route::get('/home', 'UserController@uploadCompany');
        Route::post('/upload_company/proses_upload_company', 'UserController@proses_upload_company');
        Route::get('/upload/delate_company/{id}', 'UserController@hapus');
        Route::match(['get','post'], '/edit{id}','UserController@editCompany');
        Route::get('/CompaniesExport', 'UserController@getCompaniesExport');
        Route::post('/importCompanies', 'UserController@getCompaniesImport');
        // Route::get('/home', 'UserController@searchCompany');
        
        // employe
        Route::get('/employe', 'UserController@getEmploye')->name('employe');
        Route::get('/employe', 'UserController@employe');
        Route::get('/employe', 'UserController@uploadEmploye');
        Route::post('/upload_employe/proses_upload_employe', 'UserController@proses_upload_employe');
        Route::get('/upload/delate_employe/{id}', 'UserController@hapus_employe');
        Route::match(['get','post'], '/edit{id}/editEmploye', 'UserController@editEmploye');
        Route::post('/importEmployes', 'UserController@getEmployeesImport');
        // Route::get('/searchemploye', 'UserController@searchEmploye');
        
        // mail
        Route::get('/email', 'UserController@mail');

        // Item
        Route::get('/item','itemController@getItem')->name('item');
        Route::post('/upload_items/proses_upload_items', 'itemController@proses_upload_items')->name('addItems');
        Route::get('/hapusItems/{id}', 'itemController@itemDelete');
        Route::match(['get','post'], '/editItems{id}/edit', 'itemController@editItems');
        
        // Sells
        Route::get('/sells', 'sellController@getSells')->name('sells');
        Route::post('/upload_sell/proses_upload_sell', 'sellController@proses_upload_sells')->name('addSells');
        Route::get('/hapusSells/{id}', 'sellController@sellsDelete');
        Route::match(['get','post'], '/editSells{id}/edit', 'sellController@editSells');

        // Sell_summary
        Route::get('/sell_summary', 'sellController@getSellSummarys')->name('summary');

        // Detail_Summary
        Route::get('/detail/{id}', 'sellController@getDetail');
});






