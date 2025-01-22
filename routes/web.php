<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Auth;

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

URL::forceScheme('https');

Route::get('/', function () {
    return view('Front.home');
});

Route::get('profile', function () {
    return view('userProfile'); 
});

// http://127.0.0.1:8000/dashboard
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

// http://127.0.0.1:8000/about-us
Route::get('/about-us', function () {
    return view('Front.about-us');
});

// http://127.0.0.1:8000/contact-us
Route::get('/contact-us', function () {
    return view('Front.contact-us');
});

// http://127.0.0.1:8000/home
Route::get('/home', function () {
    return view('Front.home');
});

// Login & Sign-up
Route::get('/Sign_up', [App\Http\Controllers\usersController::class, 'create']);
Route::post('/Sign_up', [App\Http\Controllers\usersController::class, 'store']);
Route::get('/admin/user', [App\Http\Controllers\AdminController::class, 'show']);
Route::get('/login', [UsersController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsersController::class, 'login'])->name('login.post');
Route::get('/logout', [usersController::class, 'logout'])->name('logout'); // Use GET for logout
Route::post('/logout', [usersController::class, 'logout'])->name('logout');

// Profile
Route::get('/profile', [UsersController::class, 'showProfile'])->name('profile.show');
Route::post('/profile/update', [UsersController::class, 'updateProfile'])->name('profile.update');

// Contact us
Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [UsersController::class, 'showContactForm'])->name('contact.form');
    Route::post('/contact', [UsersController::class, 'sendContactForm'])->name('contact.send');
});

Route::get('/video', function () {
    return view('Front.uploadPage');
});

// Course
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::middleware('auth')->group(function () {
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
});
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');

// Purchase
Route::get('/video-content/{course_id}', [CourseController::class, 'videoContent'])
    ->name('video_content');
Route::get('/video_content', function () {
    return view('Front.video_content');
});
Route::get('/card', function () {
    return view('Front.card');
});
Route::post('/courses/{id}/buy', [CourseController::class, 'buy'])->name('courses.buy');
Route::get('/user/profile', [CourseController::class, 'userCourses'])->name('user.profile')->middleware('auth');
Route::get('/purchased-courses', [CourseController::class, 'purchasedCourses'])->name('courses.purchased');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
