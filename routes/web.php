<?php

use App\Livewire\BranchIndex;
use App\Livewire\BranchView;
use App\Livewire\DepartmentIndex;
use App\Livewire\PermissionIndex;
use App\Livewire\RoleIndex;
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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/branch', BranchIndex::class)->name('branch.index');
    Route::get('/department', DepartmentIndex::class)->name('department.index');
    Route::get('/permission', PermissionIndex::class)->name('permission.index');
    Route::get('/role', RoleIndex::class)->name('role.index');



});
