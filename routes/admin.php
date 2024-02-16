<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->middleware(['web', 'verified'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('admin.users');  // Add 'admin.' prefix
    Route::get('add_user', [UserController::class, 'create'])->name('admin.add_user');  // Add 'admin.' prefix
    Route::post('storeUser', [UserController::class, 'store'])->name('admin.storeUser');  // Add 'admin.' prefix
    Route::get('edit_user/{id}', [UserController::class, 'edit']);
    Route::put("updateUser/{id}", [UserController::class,"update"])->name('updateUser');
    //Testimonials
    Route::get('add_testimonial', [TestimonialController::class, 'create'])->name('admin.add_testimonial');  // Add 'admin.' prefix
    Route::post('storeTestimonial', [TestimonialController::class, 'store'])->name('admin.storeTestimonial');
    Route::get('testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials');
    Route::get('editTestimonial/{id}', [TestimonialController::class, 'edit']);
    Route::put("updateTestimonial/{id}", [TestimonialController::class,"update"])->name('admin.updateTestimonial');
    Route ::get('deleteTestimonial/{id}',[TestimonialController::class,'destroy'])->name('admin.deleteTestimonial');
    //Categories
    Route::get('add_category', [CategoryController::class, 'create'])->name('admin.add_category');
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('storeCategory', [CategoryController::class, 'store'])->name('admin.storeCategory');
    Route::get('edit_category/{id}', [CategoryController::class, 'edit']);
    Route::put("updateCategory/{id}", [CategoryController::class,"update"])->name('admin.updateCategory');
    Route ::get('deleteCategory/{id}',[CategoryController::class,'destroy'])->name('admin.deleteCategory');
    //Cars
    Route::get('add_car', [CarController::class, 'create'])->name('admin.add_car');
    Route::post('storeCar', [CarController::class, 'store'])->name('admin.storeCar');
    Route::get('cars', [CarController::class, 'index'])->name('admin.cars');
    Route::get('editCar/{id}', [CarController::class, 'edit']);
    Route::put("updateCar/{id}", [CarController::class,"update"])->name('admin.updateCar');
    Route::get('deleteCar/{id}',[CarController::class,'destroy'])->name('admin.deleteCar');
    //Contact
    Route::get('message', [ContactController::class, 'index'])->name('admin.message');
    Route::get('show_message/{id}', [ContactController::class, 'show'])->name('admin.show_message');
    Route::get('admin/deleteMessage/{id}', [ContactController::class, 'destroy'])->name('admin.deleteMessage');

    


   

});

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');