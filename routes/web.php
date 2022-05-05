<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);
Route::get('/', function (){
    return redirect('/login');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});





