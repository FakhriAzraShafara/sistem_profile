<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agama42Controller;
use App\Http\Controllers\User42Controller;
use App\Http\Controllers\Detail_data42Controller;
use Illuminate\Support\Facades\Auth;

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

    if (Auth::check()) {
        $role = Auth::user()->role;
    } else {
        $role = null;
    }

    return view('dashboard', [
        'role'=>$role
    ]);
})->name('index42');

Route::middleware(['auth', 'hakakses:role'])->group(function () {

    // User
    Route::get('/users42', [User42Controller::class, 'users42'])->name('users42');
    Route::get('/detailUser42/{id}', [User42Controller::class, 'detailUser42'])->name('detailUser42');
    Route::get('/profile42', [User42Controller::class, 'profile42'])->name('profile42');


    Route::get('/updatePassword42', [User42Controller::class, 'updatePassword42'])->name('updatePassword42');
    Route::post('/updatePasswordProses42/{id}', [User42Controller::class, 'updatePasswordProses42'])->name('updatePasswordProses42');

    Route::get('/logout42', [User42Controller::class, 'logout42'])->name('logout42');

    // Detail data
    Route::get('/detailData42', [Detail_data42Controller::class, 'detailData42'])->name('detailData42');

    Route::get('/createData42', [Detail_data42Controller::class, 'createData42'])->name('createData42');
    Route::post('/createDataProses42', [Detail_data42Controller::class, 'createDataProses42'])->name('createDataProses42');

    Route::get('/updateData42', [Detail_data42Controller::class, 'updateData42'])->name('updateData42');
    Route::post('/updateDataProses42', [Detail_data42Controller::class, 'updateDataProses42'])->name('updateDataProses42');
});

Route::middleware(['auth', 'hakadmin:role'])->group(function () {
    // agama
    Route::get('/agama42', [Agama42Controller::class, 'agama42'])->name('agama42');

    Route::get('/createAgama42', [Agama42Controller::class, 'createAgama42'])->name('createAgama42');
    Route::post('/createAgama42Proses', [Agama42Controller::class, 'createAgama42Proses'])->name('createAgama42Proses');

    Route::get('/deleteAgama42Proses/{id}', [Agama42Controller::class, 'deleteAgama42Proses'])->name('deleteAgama42Proses');

    Route::get('/updateAgama42/{id}', [Agama42Controller::class, 'updateAgama42'])->name('updateAgama42');
    Route::post('/updateAgama42Proses/{id}', [Agama42Controller::class, 'updateAgama42Proses'])->name('updateAgama42Proses');

    // user
    Route::get('/deleteUser42/{id}', [User42Controller::class, 'deleteUser42'])->name('deleteUser42');
    Route::get('/approveUser42/{id}', [User42Controller::class, 'approveUser42'])->name('approveUser42');
});

Route::get('/login42', [User42Controller::class, 'login42'])->name('login42');
Route::post('/loginProses42', [User42Controller::class, 'loginProses42'])->name('loginProses42');

Route::get('/register42', [User42Controller::class, 'register42'])->name('register42');
Route::post('/registerProses42', [User42Controller::class, 'registerProses42'])->name('registerProses42');


