<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
if(Auth::check()) {
        return view('layouts.main');
    } else {
        return redirect()->route('login');
    }
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('foods', FoodController::class)->except(['update']);

    Route::resources([
        'categories' => CategoryController::class,
        'roles' => RoleController::class,
        'users' => UserController::class,
        'orders' => OrderController::class,
    ]);

    Route::post('foods/update/{food}', [FoodController::class, 'update'])->name('foods.update');
});


Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');

Route::get('reports/create', [ReportController::class, 'create'])->name('reports.create')->middleware('auth');
Route::post('create', [ReportController::class, 'store'])->name('reports.store')->middleware('auth');



// Route::get('/test', function () {
//     return view('test');;
// });

// Route::view('/test', 'test');

// Route::get('/user', [UserController::class, 'getUser'])->name('get-name');
// Route::get('/user/{id}/test', [UserController::class, 'getUser']);


// Route::get('/user/{id}', function (string $id) {
//     return $id;
// })->whereNumber('id');

// Route::group([
//     'as' => 'foods.',
//     'prefix' => 'foods'
// ], function() {
//     Route::get('/', [FoodController::class, 'index'])->name('index');
//     Route::get('/create', [FoodController::class, 'create'])->name('create');
//     Route::get('/', [FoodController::class, 'store'])->name('store');
//     Route::get('/{food}', [FoodController::class, 'show'])->name('show');
// });
