<?php

use App\Http\Controllers\PasswordDefaultUpdateController;
use App\Livewire\BranchIndex;
use App\Livewire\BranchView;
use App\Livewire\DepartmentIndex;
use App\Livewire\PermissionIndex;
use App\Livewire\PrivilegeIndex;
use App\Livewire\RoleIndex;
use App\Livewire\UserDefaultPasswordIndex;
use App\Livewire\UserIndex;
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

Route::get('/', function () {
    return view('welcome');
})->middleware('default');

Route::get('/password-default/update', UserDefaultPasswordIndex::class)->name('password-default-update.index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified','default',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/branch', BranchIndex::class)->name('branch.index');
    Route::get('/department', DepartmentIndex::class)->name('department.index');
    Route::get('/permission', PermissionIndex::class)->name('permission.index');
    Route::get('/role', RoleIndex::class)->name('role.index');
    Route::get('/privilege', PrivilegeIndex::class)->name('privilege.index');
    Route::get('/user', UserIndex::class)->name('user.index');





});
