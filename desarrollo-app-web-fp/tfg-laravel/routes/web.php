<?php
use Illuminate\Support\Facades\Input;
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

// Language autodetection
Route::middleware(['languageAutodetection'])->group(function(){
    
    // W34MARKETING
    Route::prefix('w34-login')->group(function (){
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register');
    });
    //W34 Tables
    Route::group(['prefix' => 'show'], function () {
        Route::get('clients', 'HomeController@showClients');
        Route::get('establishments/{id?}', 'HomeController@showEstablishments');
        Route::get('clientele/{id?}', 'HomeController@showClientele');
        Route::get('admin', 'HomeController@getUsers');
        Route::get('del/Clients', 'HomeController@showdelClients');
        Route::get('del/Establishments/{id?}', 'HomeController@showdelEstablishments');
        Route::get('categorytypes', 'HomeController@showCatTypes');
        Route::get('qualitytypes', 'HomeController@showQualTypes');
        Route::get('categorytypesajax', 'HomeController@showCatTypesAjax');
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::get('select', 'HomeController@getUsers');
        Route::get('select/users/{id?}', 'HomeController@getUserClients');
        Route::post('addperm/{user_id?}/{client_id?}', 'HomeController@addUserPerm');
        Route::post('delperm/{user_id}/{client_id}', 'HomeController@delUserPerm');
    });
    Route::group(['prefix' => 'del'], function () {
        Route::post('client/{id}', 'HomeController@delClient');
        Route::post('establishment/{id}', 'HomeController@delEstablishment');
        Route::post('category_types/{id}/{changefor}', 'HomeController@delCategoryTypes');
        Route::post('quality_types/{id}/{changefor}', 'HomeController@delQualityTypes');
    });
    Route::group(['prefix' => 'recover'], function () {
        Route::post('client/{id}', 'HomeController@recoverClient');
        Route::post('establishment/{id}', 'HomeController@recoverEstablishment');
    });
    Route::group(['prefix' => 'update'], function () {
        Route::post('Clients', 'ClientController@edit');
        Route::post('Establishments', 'EstablishmentController@edit');
        Route::post('category-types', 'HomeController@editCategoryTypes');
        Route::post('quality-types', 'HomeController@editQualityTypes');
    });
    Route::group(['prefix' => 'add'], function () {
        Route::post('Clients','ClientController@create');
        Route::post('Establishments/{client_id}', 'EstablishmentController@create');
        Route::post('quality-types', 'HomeController@addQualityType');
        Route::post('category-types', 'HomeController@addCategoryType');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('config', 'UserController@config')->name('userconf');
        Route::post('update', 'UserController@update')->name('userupdate');
        Route::get('confpwd', function () {
            return view('public.w34-login.changepass');
        })->name('userpwdchange');
        Route::post('changepwd', 'UserController@changePasword')->name('userchangepwd');
    });
    Route::group(['prefix' => 'client'], function () {
        Route::post('change/{perm}/{user_id}/{client_id}', 'ClientController@changePerms');
    }); 

    // Password Reset Routes...
    Route::prefix('password')->group(function (){
        Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('reset', 'Auth\ResetPasswordController@reset');
    });
    Route::prefix('captive-portal')->group(function(){
        Route::get('/', 'CaptivePortalController@index')->name('index');
        Route::get('/{guid?}', 'CaptivePortalController@index')->name('captive.form');
        Route::get('/{guid?}/success', 'CaptivePortalController@successLogin');
        Route::post('/register-clientele', 'CaptivePortalController@registerClientele')->name('register.clientele');
    });
});