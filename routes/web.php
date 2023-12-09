<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyControler;
use App\Http\Controllers\EmployeeControler;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserControler;
use App\Models\Company;
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



Route::get('/home', function () {
    return view('dashboard', [
        'records' => Company::paginate(10),
        'model' => 'company'
    ]);
})->name('dashboard')->middleware('guest');


Route::middleware(['auth', 'user'])->group(function () {
    Route::redirect('/', '/user');
    Route::get('/user', [UserControler::class, 'show'])->name('user.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::redirect('/', '/admin');
    Route::get('/admin', [AdminController::class, 'show'])->name('admin.show');
});


Route::resource('company', CompanyControler::class);
Route::resource('employee', EmployeeControler::class);

require __DIR__.'/auth.php';
