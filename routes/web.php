<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', [AuthenticatedSessionController::class, 'create'])
->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //company routes start
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/company/list', [CompanyController::class, 'index'])->name('company.list');
    Route::get('/company/view/{id}', [CompanyController::class, 'edit'])->name('company.view');
    Route::post('/company/update/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::post('/company/destroy/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');

    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/list', [EmployeeController::class, 'index'])->name('employee.list');
    Route::get('/employee/view/{id}', [EmployeeController::class, 'edit'])->name('employee.view');
    Route::post('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
});

require __DIR__.'/auth.php';
