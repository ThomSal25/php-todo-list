<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

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

Route::get('/', [TodoListController::class, 'index']);
Route::get('/user', [TodoListController::class, 'userView']);
Route::get('/showAllRoute', [TodoListController::class, 'showAll'])->name('showAll');
Route::get('/showOpenRoute', [TodoListController::class, 'showOpen'])->name('showOpen');
Route::get('/showDoneRoute', [TodoListController::class, 'showDone'])->name('showDone');

Route::post('/saveItemRoute', [TodoListController::class, 'saveItem'])->name('saveItem');
Route::post('/markCompleteRoute/{id}', [TodoListController::class, 'markComplete'])->name('markComplete');
Route::post('/toggleCompleteRoute/{id}', [TodoListController::class, 'toggleComplete'])->name('toggleComplete');
Route::post('/deleteEntryRoute/{id}', [TodoListController::class, 'deleteEntry'])->name('deleteEntry');

Route::get('/dbconn', function(){
    return view('dbconn');
});
