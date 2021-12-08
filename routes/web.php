<?php

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
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/user','UserController');
    Route::get('/aksesuser/{id}','UserController@aksesuser')->name('user.aksesuser');
    Route::post('/updateaksesuser/{id}','UserController@update_aksesuser')->name('user.updateaksesuser');
    Route::resource('/menu','MenuController');
    Route::resource('/kantor','KantorController');
    Route::resource('/unit','UnitController');
    Route::resource('/jabatan','JabatanController');
    
    Route::resource('/divisi','DivisiController');
    Route::resource('/rank','RankController');
    Route::resource('/groupmenu','GroupMenuController');
    Route::resource('/kategori','KategoriController');
    Route::resource('/asset','AssetController');

    Route::get('support_ticket/','SupportTicketController@admin_index')->name('tiket.index');
	Route::get('support_ticket/{id}/show','SupportTicketController@admin_show')->name('support_ticket.admin_show');
    Route::post('support_ticket_admin/reply','SupportTicketController@admin_store')->name('support_ticket.admin_store');
    
    Route::resource('support_ticket_user','SupportTicketController');
	Route::post('support_ticket/reply','SupportTicketController@seller_store')->name('support_ticket.seller_store');
});
