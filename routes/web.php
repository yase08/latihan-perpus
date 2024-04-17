<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\UserController;
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

// PUBLIC ROUTE
Route::get('/', function () {
    return view('pages.index');
});

// PROTECTED ROUTE BY LOGIN
Route::middleware("isLogin")->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name("dashboard");

    Route::get("/dashboard/collection", [CollectionController::class, "index"])->name("collection");
    Route::get("/dashboard/return-book", [BookController::class, ""])->name("collection");
    Route::get("/dashboard/borrow", [BookController::class, "indexBorrow"])->name("borrow");
    Route::get("/dashboard/book", [BookController::class, "index"])->name("book");
    Route::post("/dashboard/return-store/{id}", [BookController::class, "returnStore"])->name("return.store");
    Route::post("/borrow/store/{id}", [BookController::class, "borrow"])->name("borrow.store");
    Route::post("/collection/store/{id}", [CollectionController::class, "store"])->name("collection.store");
    Route::delete("/collection/delete/{id}", [CollectionController::class, "destroy"])->name("collection.delete");
    Route::get("/dashboard/return-book", [BookController::class, "return"])->name("return");

    // PROTECTED ROUTE BY ADMIN
    Route::middleware("isAdmin")->group(function () {
        // GET ROUTE
        Route::get("/dashboard/user", [UserController::class, "index"])->name("user");
        Route::get("/dashboard/user/create", [UserController::class, "create"])->name("user.create");
        Route::get("/dashboard/user/edit/{id}", [UserController::class, "edit"])->name("user.edit");

        Route::get("/dashboard/book/create", [BookController::class, "create"])->name("book.create");
        Route::get("/dashboard/book/edit/{id}", [BookController::class, "edit"])->name("book.edit");



        Route::get("/dashboard/category", [CategoryController::class, "index"])->name("category");
        Route::get("/dashboard/category/create", [CategoryController::class, "create"])->name("category.create");
        Route::get("/dashboard/category/edit/{id}", [CategoryController::class, "edit"])->name("category.edit");

        //POST ROUTE
        Route::post("/user/store", [UserController::class, "store"])->name("user.store");
        Route::post("/book/store", [BookController::class, "store"])->name("book.store");
        Route::post("/category/store", [CategoryController::class, "store"])->name("category.store");

        // PATCH ROUTE
        Route::patch("/user/update/{id}", [UserController::class, "update"])->name("user.update");
        Route::patch("/book/update/{id}", [BookController::class, "update"])->name("book.update");
        Route::patch("/category/update/{id}", [CategoryController::class, "update"])->name("category.update");

        //DELETE ROUTE
        Route::delete("/user/delete/{id}", [UserController::class, "destroy"])->name("user.delete");
        Route::delete("/book/delete/{id}", [BookController::class, "destroy"])->name("book.delete");
        Route::delete("/category/delete/{id}", [CategoryController::class, "destroy"])->name("category.delete");
    });
});

require __DIR__ . '/auth.php';
