<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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
Route::get('testHome', [Controller::class, 'home'])->name('testHome');
Route::get('carsList', [Controller::class, 'listing'])->name('carsList');
Route::get('Testimonial', [Controller::class, 'testimonials'])->name('Testimonial');
Route::get('Blog', [Controller::class, 'blog'])->name('Blog');
Route::get('AboutUs', [Controller::class, 'about'])->name('AboutUs');
Route::get('ContactUs', [Controller::class, 'contact'])->name('ContactUs');
Route::get('Single/{id}', [Controller::class, 'single'])->name('Single');
 //ContactUs
Route::post('sendContactUs', [Controller::class, 'send_contactUs'])->name('sendContactUs');

