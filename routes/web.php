<?php

use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::livewire("/","pages::hello")->name("home");

Route::prefix('users')->name('users.')->group(function(){
    Route::livewire("/login",'pages::auth.login')->name("login");
    Route::livewire("/signup",'pages::auth.signup')->name("signup");
    Route::delete("/logout",[LogoutController::class,'logout'])->name("logout")->middleware('auth');
});

Route::middleware('auth')->prefix('products')->name('products.')->group(function (){
    Route::livewire("","pages::products.list")->name("products");
    Route::livewire("/new","pages::products.new")->name("new_product");
    Route::livewire("/{product}/edit","pages::products.edit")->name("edit_product");
    Route::livewire("/{product}/delete","pages::products.delete")->name("delete_product");
});


Route::middleware('auth')->prefix('perfil')->name('perfil.')->group(function (){
    Route::livewire("","pages::perfil.display")->name("perfil");
    Route::livewire("/new","pages::perfil.new")->name("sign");
});
