<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StudyGroupsController;

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

Route::get('/', function() {
    return redirect()->route('students.index');
});

// Students
Route::get('students', [StudentsController::class, 'index'])->name('students.index');
Route::get('students/create', [StudentsController::class, 'create'])->name('students.create');
Route::post('students', [StudentsController::class, 'store'])->name('students.store');
Route::get('students/{student}/edit', [StudentsController::class, 'edit'])->name('students.edit');
Route::put('students/{student}', [StudentsController::class, 'update'])->name('students.update');
Route::delete('students/{student}', [StudentsController::class, 'destroy'])->name('students.destroy');

// Study Groups
Route::get('study-groups', [StudyGroupsController::class, 'index'])->name('study-groups.index');
Route::get('study-groups/create', [StudyGroupsController::class, 'create'])->name('study-groups.create');
Route::post('study-groups', [StudyGroupsController::class, 'store'])->name('study-groups.store');
Route::get('study-groups/{studyGroup}/edit', [StudyGroupsController::class, 'edit'])->name('study-groups.edit');
Route::put('study-groups/{studyGroup}', [StudyGroupsController::class, 'update'])->name('study-groups.update');
Route::delete('study-groups/{studyGroup}', [StudyGroupsController::class, 'destroy'])->name('study-groups.destroy');