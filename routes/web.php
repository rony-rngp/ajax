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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/index', [App\Http\Controllers\TeacherController::class, 'index'])->name('teacher.index');
Route::get('/teacher/all', [App\Http\Controllers\TeacherController::class, 'all_teacher'])->name('teacher.all');
Route::post('/teacher/add', [App\Http\Controllers\TeacherController::class, 'add'])->name('teacher.add');
Route::get('/teacher/edit', [App\Http\Controllers\TeacherController::class, 'edit_teacher'])->name('teacher.edit');
Route::post('/teacher/update', [App\Http\Controllers\TeacherController::class, 'update'])->name('teacher.update');
Route::post('/teacher/delete', [App\Http\Controllers\TeacherController::class, 'delete'])->name('teacher.delete');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
