<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReviewsController;

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

// Home page
Route::get('/', [IndexController::class, 'IndexPage'])->name('index');

// Blog page
Route::get('/blog', [BlogController::class, 'BlogPage'])->name('blog');

// Room page
Route::get('/room', [RoomController::class, 'RoomPage'])->name('room');
Route::post('/room/booking', [RoomController::class, 'storeBooking'])->name('room.booking');
Route::post('/room/check-availability', [RoomController::class, 'checkAvailability'])->name('room.check-availability');

// Test route for debugging
Route::get('/test-booking-form', function() {
    return view('test-booking-form');
});

// Gallery page
Route::get('/gallerys', [GalleryController::class, 'GalleryPage'])->name('gallerys');

// Reviews page
Route::get('/reviews', [ReviewsController::class, 'ReviewsPage'])->name('reviews');
Route::post('/reviews/store', [ReviewsController::class, 'store'])->name('reviews.store');
Route::get('/reviews/image/{id}', [ReviewsController::class, 'getReviewImage'])->name('reviews.image');

// Events page
Route::get('/event', [EventController::class, 'EventPage'])->name('event');
Route::post('/event/booking', [EventController::class, 'storeBooking'])->name('event.booking');

// Debug route for images
Route::get('/test-image/{id}', function($id) {
    $image = \App\Models\ReviewImage::findOrFail($id);
    echo "Image found! ID: $id<br>";
    echo "Filename: " . $image->filename . "<br>";
    echo "MIME: " . $image->mime_type . "<br>";
    echo "Size: " . strlen($image->image) . " bytes<br>";
    echo "<img src='" . route('reviews.image', $id) . "' alt='Test Image' style='max-width: 300px;'>";
});

