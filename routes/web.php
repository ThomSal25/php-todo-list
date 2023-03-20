<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImageController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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

Route::get('todo/list', [TodoListController::class, 'indexTodo']);
Route::post('/todo/saveWithVue', [TodoListController::class, 'saveWithVue']);
Route::put('todo/updateTodo/{id}', [TodoListController::class, 'updateWithVue']);
Route::delete('todo/deleteTodo/{id}', [TodoListController::class, 'deleteWithVue']);
Route::get('todo/img', [TodoListController::class, 'loadImg']);

// Route::get('/login', [LoginController::class, 'index']);
Route::controller(LoginController::class)->group(function(){
    Route::get('login', 'index')->name('login');
    Route::get('registration', 'registration')->name('registration');
    Route::get('logout', 'logout')->name('logout');

    Route::post('validate_registration', 'validate_registration')->name('sample.validate_registration');
    Route::post('validate_login', 'validate_login')->name('sample.validate_login');
    Route::get('dashboard', 'dashboard')->name('dashboard');
}); 

// Image
Route::get('/image', [ImageController::class,'indexImage'])->name('image.index');
Route::post('/image', [ImageController::class,'storeImage'])->name('image.store');
Route::get('/image', [ImageController::class, 'showAllImages']);