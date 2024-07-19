<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserDashboardController;


Route::get('/', function () {
    return view('login');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('admin-registration', [AuthController::class, 'AdminRegistration'])->name('register.admin'); 
Route::post('post-admin-registration', [AuthController::class, 'postAdminRegistration'])->name('register.postadmin');
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('create-exam', [ExamController::class, 'create'])->name('exam.create'); 
//Route::resource('exams', ExamController::class);
Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');

// Show the form for creating a new exam
Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');

// Store a newly created exam in the database
Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');

// Display the specified exam
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');

// Show the form for editing a specified exam
Route::get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');

// Update the specified exam in the database
Route::put('/exams/{exam}', [ExamController::class, 'update'])->name('exams.update');

// Remove the specified exam from the database
Route::delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');

Route::resource('questions', QuestionController::class);


Route::get('userdashboard', [AuthController::class, 'userdashboard'])->name('userdashboard'); 
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


///user side
Route::get('userdashboard/exams/view', [UserDashboardController::class, 'examviews'])->name('userdashboard.examviews');
Route::get('userdashboard/exams/{exam}/view', [UserDashboardController::class, 'exam'])->name('userdashboard.exam');

Route::post('userdashboard/{exam}/result/view', [UserDashboardController::class, 'resultviews'])->name('userdashboard.resultviews'); 
Route::get('userdashboard/result/{user}', [UserDashboardController::class, 'result'])->name('userdashboard.result'); 

Route::get('userdashboard/message/view', [UserDashboardController::class, 'messageviews'])->name('userdashboard.messageviews'); 



