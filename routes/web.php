<?php

;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group([
    'prefix'     => 'admin',
    'namespace'  => 'Admin',
    'middleware' => 'auth'
],function (){
    Route::get('/', function (){
        return redirect('/home');
    })->name('inicio');
    Route::resource('students','StudentController');
    Route::resource('teachers','TeacherController');
    Route::resource('task','TaskController');
    Route::resource('advisory','AdvisoryController');
    Route::resource('course','CourseController');
    Route::resource('category','CategoryController');
    Route::resource('tag','TagController');
    Route::resource('level','LevelController');


    /*Route::get()->name('tags.tasks');*/

    Route::delete('comment/{comment}','AdminController@deleteComment')->name('comment.delete');
    Route::delete('offer/{offer}','AdminController@deleteOffer')->name('offer.delete');

    Route::delete('image/{image}','AdminController@deleteImage')->name('image.delete');
    Route::delete('document/{file}','AdminController@deleteDocument')->name('document.delete');

});


Route::get('/home', 'HomeController@index');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout')->name('logout');

/*Route::get('register','Auth\RegisterController@showResgistrationForm')->name('register');
Route::post('register','Auth\RegisterController@register');*/

Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestFrom')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset');
