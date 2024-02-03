<?php

use App\Livewire\Dashboard;
use App\Livewire\Settings;
use App\Livewire\Type;
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
    return view('auth.login');
});
Route::get('/register', function (){
    return view('auth.register');
})->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/agenda', Dashboard::class)->name('agenda');
    Route::get('/types', Type::class)->name('types');
    Route::get('/settings', Settings::class)->name('settings');
});
