<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);

    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->group( function () {
    Route::get('/dashboard',function () {
        $patient_count = \App\Models\Patient::all()->count();
        return Inertia::render('Dashboard',compact('patient_count'));
    })->name('dashboard');


    Route::namespace('Admin')->group(function(){
        Route::resource('patients',PatientController::class);
        Route::resource('patients.medical-history',PatientMedicalHistoryController::class);
        Route::resource('patients.dental-history',PatientDentalHistoryController::class);
        Route::resource('patients.medias',PatientMediaController::class);
        Route::resource('patients.treatments',PatientTreatmentController::class);
    });
});

