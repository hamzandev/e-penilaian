<?php


use App\Http\Controllers\PrecenseController;
use App\Http\Controllers\BehaviorValueController;
use App\Http\Controllers\FinalValueController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\SchoolyearController;
use App\Http\Controllers\KelasLevelController;

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
use App\Http\Controllers\WalikelasController;
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
        // Academics
        Route::group(['prefix' => '/academics'], function () {
            Route::name('academics.')->group(function () {
                Route::resource('grades', GradeController::class);
            });
        });
    });


    Route::group(['middleware' => 'role:operator'], function () {
        Route::prefix('/wali-kelas')->name('wali-kelas.')->group(function () {
            Route::get('/my-classes', [WalikelasController::class, 'index'])->name('my-classes');
            Route::get('/{kelasId}/students/{teacherId}', [WalikelasController::class, 'classDetail'])->name('students');
            Route::get(
                '/{kelasId}/students/{teacherId}/siswa-detail/{studentId}',
                [WalikelasController::class, 'studentDetail']
            )->name('students.detail');
            Route::patch(
                '/{kelasId}/students/{teacherId}/siswa-detail/{studentId}',
                [WalikelasController::class, 'studentDetailAction']
            )->name('students.detail-action');
            Route::get('/studies', [WalikelasController::class, 'studies'])->name('studies');
        });
        Route::resource('studies', StudyController::class);

        Route::resource('achievements', AchievementController::class);
        Route::resource('final-values', FinalValueController::class);
        Route::resource('behavior_values', BehaviorValueController::class);
        Route::resource('precenses', PrecenseController::class);
        // Route::resource('studies', StudyController::class)->except(['create', 'store']);
    });


    Route::group(['middleware' => 'role:admin'], function () {
        // master data
        Route::prefix('/master-data')
            ->name('master-data.')
            ->group(function () {
                Route::resource('subject', SubjectController::class)->except('show');
                Route::resource('class', KelasController::class)->except('show');
                Route::resource('student', StudentController::class)->except('show');

                Route::get('class/{id}/students', [KelasController::class, 'students'])->name('class.students');
                Route::get('class/{id}/students/add', [KelasController::class, 'addStudents'])->name('class.students.add');
                Route::patch('class/{id}/students/add', [KelasController::class, 'addStudentsAction'])
                    ->name('class.students.add-action');
                Route::delete('class/{kelasId}/students/{studentId}/remove', [KelasController::class, 'removeStudent'])
                    ->name('class.students.remove');

                // Imports
                Route::post('students/import', [StudentController::class, 'import'])
                    ->name('student.import');
                Route::post('teachers/import', [TeacherController::class, 'import'])
                    ->name('teacher.import');
                Route::post('subjects/import', [SubjectController::class, 'import'])
                    ->name('subject.import');
            });

        // controller resources => master data
        Route::name('master-data.')->prefix('/master-data')->group(function () {
            Route::resource('teacher', TeacherController::class);
            Route::resource('kelas-levels', KelasLevelController::class);
            Route::resource('schoolyears', SchoolyearController::class);
        });

        // controllers Users for Manage Users
        Route::resource('manage-users', UsersController::class)->except(['create', 'show', 'destroy']);
        Route::prefix('/manage-users')
            ->controller(UsersController::class)
            ->name('manage-users.')
            ->group(function () {
                Route::get('/{id}/connect-account', 'connectAccount')
                    ->name('connect-account');
                Route::patch('/{id}/connect-account', 'connect')
                    ->name('connect-account-action');
                Route::patch('/{id}/update-password', 'updatePassword')
                    ->name('update-password');
            });

        // controllers Accounts
        Route::resource('accounts', AccountsController::class);
        Route::patch('/accounts/{id}/update-password', [AccountsController::class, 'updatePassword'])
            ->name('accounts.update-password');
    });
});
