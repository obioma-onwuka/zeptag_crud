<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FrontViewController;

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

Route::get('/', [FrontViewController::class, 'welcome']);




Route::controller(ContactController::class)->name('contacts')->group( function () {

    Route::get('/contacts', 'index')->name('.index'); //named route

    Route::get('/contacts/create', 'create')->name('.create'); //name route

    Route::post('/contacts', 'store')->name('.store'); //name route
    
    Route::get('/contacts/{contact}', 'show')->where('contact', '[0-9]+')->name('.show'); //ensures only number accepted

    Route::get('/contacts/{contact}/edit', 'edit')->name('.edit');

    Route::put('/contacts/{contact}', 'update')->name('.update');
    Route::delete('/contacts/{contact}', 'delete')->name('.delete');

    Route::delete('/contacts/{contact}/restore', [ContactController::class, 'restore'])->name('.restore')->withTrashed();
    Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])->name('.force-delete')->withTrashed();

});

Route::resource('/companies', CompanyController::class);

Route::resources([

    '/tags' =>TagController::class,
    '/tasks' =>TaskController::class,

]);

// Route::resource('/activities', ActivityController::class)->name([

//     'index' => 'activities.all',
//     'show' => 'activities.view',

// ]);

Route::resource('/contacts.notes', ContactController::class)->shallow()->except([

    'index', 'show'

]);

Route::resource('/activities', ActivityController::class)->parameters([


    'activities' => 'active'

]);



Route::fallback( function (){
    return "The requested resource is not found!";
});

