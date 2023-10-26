<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Guest\PageController as GuestPageController;

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
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

Route::get('/', [GuestPageController::class, 'index'])->name('guest.home');



Route::middleware(['auth', 'verified'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {

    Route::get('/', [AdminPageController::class, 'index'])->name('home');

    // Route::get('/test', function(){
    //   $type = Type::find(1);

    // } );

    Route::resource('projects', AdminProjectController::class );

  });

require __DIR__ . '/auth.php';