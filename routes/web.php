<?php

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Middleware\RoleAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaterialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

*/

Route::controller(MaterialController::class)->group(function () {
    //show all material on index page
    Route::get('/', 'index')->name('home');

    Route::middleware(['auth'])->group(function () {
        //add new matrerial fron index page
        Route::post('/materials', 'store');
        //edit material on index page
        Route::get('/materials/{material}/edit', 'edit');
        //update material on index page
        Route::put('/materials/{material}', 'update');
        //destroy material from index page
        Route::delete('/materials/{material}', 'destroy');

        //orderby 
        Route::get('orderby/{orderby}', 'order');

    });
});

Route::controller(UserController::class)->group(function () {
    //Show reggister
    Route::get('/register', 'create')->middleware('guest');
    //Create new user and login
    Route::post('/users', 'store');
    //Show login form
    Route::get('/login', 'login')->name('login')->middleware('guest');
    //Log in user
    Route::post('/users/authenticate', 'authenticate');
    // Log User out
    Route::post('/logout', 'logout')->middleware('auth');

    // Manage accounts
    Route::get('/accounts', 'accounts')->middleware('admin');
    //Delete accounts
    Route::delete('/accounts/{account}', 'destroy')->middleware('admin');
    //orderby accounts
    Route::get('accounts/{account}', 'order')->middleware('admin');

});

Route::any('{query}', function () { return redirect('/'); })->where('query', '.*');


// Route::get('/', function () {
//     return view('index', ['materials' => Material::all()]);
// });

// Route::post('/materials', function (Request $request) {
  
//     $newMaterialItem = new Material;
//     $newMaterialItem->name =$request->material;
//     $newMaterialItem->save();

//     return redirect('/');

// });


// Route::get('/{id}', function ($id) {
//     //return view('index', ['materials' => Material::find($id)]);
//     return Material::find($id);
// });



// Route::get('/{id}', function ($id) {
//     dd($id);
//     return ('<h1>id is </h1>' . $id);
// });
