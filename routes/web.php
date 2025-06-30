<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SairController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'loginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('produtos/{name}', [ProductController::class, 'show'])->name('auth.produtos.show');
Route::get('categorias/{name}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('marcas/{name}', [BrandController::class, 'show'])->name('brands.show');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');

    Route::get('dashboard/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('dashboard/usuarios/cadastrar', [UserController::class, 'create'])->name('users.create');
    Route::get('dashboard/usuarios/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('dashboard/usuarios', [UserController::class, 'store'])->name('users.store');
    Route::put('dashboard/usuarios/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('dashboard/usuarios/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('dashboard/categorias', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('dashboard/categorias/cadastrar', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('dashboard/categorias/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('dashboard/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('dashboard/categories/ajax-store', [CategoryController::class, 'ajaxStore'])->name('categories.ajaxStore');
    Route::put('dashboard/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('dashboard/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('dashboard/marcas', [BrandController::class, 'index'])->name('brands.index');
    Route::get('dashboard/marcas/cadastrar', [BrandController::class, 'create'])->name('brands.create');
    Route::get('dashboard/marcas/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('dashboard/marcas', [BrandController::class, 'store'])->name('brands.store');
    Route::post('dashboard/marcas/ajax-store', [BrandController::class, 'ajaxStore'])->name('brands.ajaxStore');
    Route::put('dashboard/marcas/{id}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('dashboard/marcas/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');

    Route::get('dashboard/produtos', [ProductController::class, 'index'])->name('products.index');
    Route::get('dashboard/produtos/cadastrar', [ProductController::class, 'create'])->name('products.create');
    Route::get('dashboard/produtos/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('dashboard/produtos', [ProductController::class, 'store'])->name('products.store');
    Route::put('dashboard/produtos/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('dashboard/produtos/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    
});