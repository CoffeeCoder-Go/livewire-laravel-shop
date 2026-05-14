<?php

use Illuminate\Support\Facades\Route;

Route::livewire("/","pages::hello")->name("home");
Route::livewire("/products","pages::products.list")->name("products");
Route::livewire("/products/new","pages::products.new")->name("new_product");