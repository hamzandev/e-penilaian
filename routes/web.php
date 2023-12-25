<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UsersController;
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

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::redirect('/', '/dashboard');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['guest'])
    ->name('login');

Route::middleware('guest')->controller(AuthController::class)
    ->name('login.')
    ->group(function () {
        Route::get('/admin/login', 'index')->name('form');
        Route::post('/admin/login', 'process')->name('process');
    });

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/my-profile', 'index')->name('profile');
        Route::put('/my-profile/update', 'update')->name('profile.update');
        Route::patch('/my-profile/update-password', 'updatePassword')->name('profile.update-password');
    });

    Route::group(['middleware' => 'role:admin,operator'], function () {
        Route::group(['prefix' => '/master-data'], function () {
            Route::name('master-data.')->group(function () {
                Route::resource('subject', SubjectController::class)->except('show');
                Route::resource('student', StudentController::class)->except('show');
                Route::resource('class', KelasController::class)->except('show');
                // Route::resource('teacher', TeacherController::class);

                Route::get('class/{id}/students', [KelasController::class, 'students'])->name('class.students');
                Route::get('class/{id}/students/add', [KelasController::class, 'addStudents'])->name('class.students.add');
                Route::delete('class/{kelasId}/students/{studentId}/remove', [KelasController::class, 'removeStudent'])
                    ->name('class.students.remove');
                Route::patch('class/{id}/students/add', [KelasController::class, 'addStudentsAction'])
                    ->name('class.students.add-action');

                // Imports
                Route::post('students/import', [StudentController::class, 'import'])
                    ->name('student.import');
                Route::post('teachers/import', [TeacherController::class, 'import'])
                    ->name('teacher.import');
                Route::post('subjects/import', [SubjectController::class, 'import'])
                    ->name('subject.import');
            });
        });
        Route::group(['prefix' => '/academics'], function () {
            Route::name('academics.')->group(function () {
                Route::resource('grade', GradeController::class);
            });
        });
    });

    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/manage-users/{id}/connect-account', [UsersController::class, 'connectAccount'])
            ->name('manage-users.connect-account');
        Route::patch('/manage-users/{id}/connect-account', [UsersController::class, 'connect'])
            ->name('manage-users.connect-account-action');

        Route::patch('/accounts/{id}/update-password', [AccountsController::class, 'updatePassword'])
            ->name('accounts.update-password');

        Route::patch('/manage-users/{id}/update-password', [UsersController::class, 'updatePassword'])
            ->name('manage-users.update-password');

        Route::resource('manage-users', UsersController::class)->except(['create', 'show', 'destroy']);
        Route::resource('accounts', AccountsController::class);

        Route::name('master-data.')->prefix('/master-data')->group(function() {
            Route::resource('teacher', TeacherController::class);
        });

    });
});
