<?php

use App\Http\Livewire\Tool\ToolList;
use App\Http\Livewire\User\UserList;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Status\StatusList;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

use App\Http\Livewire\Authentication\RoleList;
use App\Http\Livewire\Authentication\PermissionList;

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
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('user', UserList::class);
    Route::get('tools', ToolList::class);
    
    Route::get('status', StatusList::class);

    Route::get('permission', PermissionList::class);
    Route::get('role', RoleList::class);

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';