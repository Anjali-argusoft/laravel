<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
// use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/home', function () {
    echo "This is Home Page";
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');

Route::get('/categories/all', [CategoryController::class, 'getcategories'])->name('categories');

Route::post('/categories/add', [CategoryController::class, 'addCategory'])->name('addCategories');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);

Route::get('/category/delete/{id}', [CategoryController::class, 'Delete']);
