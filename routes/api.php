<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public routes

// Route::resource("products", ProductController::class);
Route::get("/products/search/{name}", [ProductController::class, "search"]);
Route::post("/register", [AuthController::class, "register"]);  // signing up
Route::post("/login", [AuthController::class, "login"]);  // logging in
Route::get("/products", [ProductController::class, "index"]);
Route::get("/products/{product}", [ProductController::class, "show"]);


//protected routes 
Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::post("/products", [ProductController::class, "store"]);
    Route::put("/products/{id}", [ProductController::class, "update"]);
    Route::delete("/products/{id}", [ProductController::class, "destroy"]);
    Route::post("/logout", [AuthController::class, "logout"]);  // logging out



});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
