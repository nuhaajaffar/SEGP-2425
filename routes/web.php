<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\HospitalRegistrationController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LanguageController;


// Fallback Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

//image
Route::get('upload', [ImageController::class, 'index'])->name('upload.index');
Route::post('/upload', [ImageController::class, 'store'])->name('upload.store');

Route::get('/images', [ImageController::class, 'showImages'])->name('images.show');


//Named Routes
Route::get('/login', function () {
    return view('login');
})->name("login");

Route::get('/about', function () {
    return view('about');
})->name("about");

Route::get('/demo', function () {
    return view('demo');
})->name("demo");

Route::get('/license', function () {
    return view('license');
})->name("license");

Route::get('/contact', function () {
    return view('contact');
})->name("contact");

//logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');



// Patient 
Route::get('/hospital-registration', [HospitalRegistrationController::class, 'create'])
     ->name('hospital.create');

// Handle form submission
Route::post('/hospital-registration', [HospitalRegistrationController::class, 'store'])
     ->name('hospital.store');


//User
Route::get('/user-register', [UserRegistrationController::class, 'create'])
     ->name('register.create');

Route::post('/user-register', [UserRegistrationController::class, 'store'])
     ->name('register.store');

//login
Route::get('/login', [LoginController::class, 'showLoginForm'])
     ->name('login');

Route::post('/login', [LoginController::class, 'login'])
     ->name('login.process');

// Apply the custom middleware to all dashboard routes
Route::middleware(['auth.hospital'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/management/dashboard', function () {
        return view('management.dashboard');
    })->name('management.dashboard');

    Route::get('/radiographer/dashboard', function () {
        return view('radiographer.dashboard');
    })->name('radiographer.dashboard');

    Route::get('/radiologist/dashboard', function () {
        return view('radiologist.dashboard');
    })->name('radiologist.dashboard');

    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');

    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->name('patient.dashboard');

    // Optionally secure your home route too:
    Route::get('/', function () {
        return view('home');
    })->name('home');
});



// Profile page – the profile route expects a user id parameter
Route::get('/profile/{id}', [ProfileController::class, 'show'])
     ->name('profile.show');

// Manage Hospital page (for example)
Route::get('/hospital/manage', [HospitalController::class, 'manage'])
     ->name('hospital.manage');

// Example route for user logs
Route::get('/user/logs', function(){
    return view('user.logs'); // create a view if needed
})->name('user.logs');

// Language switcher route
Route::get('/lang/{lang}', [LanguageController::class, 'switch'])
     ->name('lang.switch');

// Support, Settings, Privacy routes (as examples)
Route::get('/support', function () {
    return view('sidebar.support');
})->name('support');

Route::get('/settings', function () {
    return view('sidebar.settings');
})->name('settings');

Route::get('/privacy', function () {
    return view('sidebar.privacy');
})->name('privacy');