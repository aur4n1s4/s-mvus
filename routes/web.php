<?php

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

Route::get('/', 'DashboardController@index');
Route::get('/about', 'DashboardController@about')->name('about');
Route::get('/service', 'DashboardController@service')->name('service');
Route::get('/dokter', 'DashboardController@dokter')->name('dokter');
Route::get('/kontak', 'DashboardController@contact')->name('contact');

Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
    Route::get('/', 'PendaftaranController@index')->name('index');
    Route::post('/store', 'PendaftaranController@store')->name('store');
    Route::post('status', 'PendaftaranController@status')->name('status');
    Route::get('cetak/{id}', 'PendaftaranController@cetakPdf')->name('cetak');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');

//== MASTER
Route::namespace('Master')
    ->middleware(['auth', 'permission:master'])
    ->group(function () {

        //=== User
        Route::prefix('user')->name('user.')
            ->group(function () {
                Route::get('{id}/edit', 'UserController@edit')->name('edit');
                Route::patch('{id}/update', 'UserController@update')->name('update');
                Route::delete('{id}/destroy', 'UserController@destroy')->name('destroy');

                Route::get('{id}/role', 'UserController@role')->name('role');
                Route::delete('{name}/role', 'UserController@roleDestroy')->name('role.destroy');
            });

        //=== Group Role & Permission
        Route::middleware('permission:role')
            ->group(function () {
                //== Role
                Route::prefix('role')->name('role.')->group(function () {
                    Route::get('index', 'RoleController@index')->name('index');
                    Route::post('store', 'RoleController@store')->name('store');
                    Route::get('edit/{id}', 'RoleController@edit')->name('edit');
                    Route::patch('update/{id}', 'RoleController@update')->name('update');
                    Route::delete('destroy/{id}', 'RoleController@destroy')->name('destroy');
                    Route::get('api', 'RoleController@api')->name('api');

                    Route::prefix('permission')->name('permission.')->group(function () {
                        Route::get('index/{id}', 'RoleController@permissions')->name('index');
                        Route::post('store', 'RoleController@storePermissions')->name('store');
                        Route::delete('destroy/{name}', 'RoleController@destroyPermission')->name('destroy');
                        Route::get('list/{id}', 'RoleController@listPermission')->name('listPermission');
                    });
                });

                //== Permission
                Route::prefix('permission')->name('permission.')->group(function () {
                    Route::get('index', 'PermissionController@index')->name('index');
                    Route::post('store', 'PermissionController@store')->name('store');
                    Route::get('edit/{id}', 'PermissionController@edit')->name('edit');
                    Route::patch('update/{id}', 'PermissionController@update')->name('update');
                    Route::delete('destroy/{id}', 'PermissionController@destroy')->name('destroy');
                    Route::get('api', 'PermissionController@api')->name('api');
                });
            });

        //=== Pegawai
        Route::middleware('permission:pegawai')
            ->group(function () {
                Route::prefix('pegawai')->name('pegawai.')->group(function () {
                    Route::get('index', 'PegawaiController@index')->name('index');
                    Route::get('create', 'PegawaiController@create')->name('create');
                    Route::post('store', 'PegawaiController@store')->name('store');
                    Route::get('{id}/edit', 'PegawaiController@edit')->name('edit');
                    Route::patch('{id}/update', 'PegawaiController@update')->name('update');
                    Route::delete('{id}/destroy', 'PegawaiController@destroy')->name('destroy');

                    Route::post('{pegawai_id}/addUser', 'PegawaiController@addUser')->name('addUser');
                    Route::get('list', 'PegawaiController@api')->name('list');
                });
            });


        //=== Poli
        Route::prefix('poli')->name('poli.')->group(function () {
            Route::get('index', 'PoliController@index')->name('index');
            Route::get('create', 'PoliController@create')->name('create');
            Route::post('store', 'PoliController@store')->name('store');
            Route::get('{id}/edit', 'PoliController@edit')->name('edit');
            Route::patch('{id}/update', 'PoliController@update')->name('update');
            Route::delete('{id}/destroy', 'PoliController@destroy')->name('destroy');
            Route::get('api', 'PoliController@api')->name('api');
        });
    });

Route::prefix('antrian')
    ->name('antrian.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('index', 'AntrianController@index')->name('index');
        Route::get('create', 'AntrianController@create')->name('create');
        Route::post('store', 'AntrianController@store')->name('store');
        Route::get('{id}/edit', 'AntrianController@edit')->name('edit');
        Route::patch('{id}/update', 'AntrianController@update')->name('update');
        Route::delete('{id}/destroy', 'AntrianController@destroy')->name('destroy');
        Route::post('{id}/status', 'AntrianController@status')->name('status');
        Route::get('api', 'AntrianController@api')->name('api');
    });

Route::prefix('pengunjung')
    ->name('pengunjung.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('index', 'PengunjungController@index')->name('index');
        Route::get('create', 'PengunjungController@create')->name('create');
        Route::post('store', 'PengunjungController@store')->name('store');
        Route::get('{id}/show', 'PengunjungController@show')->name('show');
        Route::get('{id}/edit', 'PengunjungController@edit')->name('edit');
        Route::patch('{id}/update', 'PengunjungController@update')->name('update');
        Route::delete('{id}/destroy', 'PengunjungController@destroy')->name('destroy');
        Route::get('api', 'PengunjungController@api')->name('api');
    });
