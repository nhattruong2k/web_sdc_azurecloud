<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\BenefitCourseController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\ProjectStudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\StatistNumberController;
use App\Http\Controllers\Api\CourseCategoryController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\FeelStudentController;
use App\Http\Controllers\Api\OpeningScheduleController;
use App\Http\Controllers\Api\LookupController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\WorkController;

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

Route::get('/banners', [BannerController::class, 'index']);
Route::get('/menus', [MenuController::class, 'index']);
Route::get('/partners', [PartnerController::class, 'index']);
Route::get('/feel-students', [FeelStudentController::class, 'index']);
Route::get('/benefit-courses', [BenefitCourseController::class, 'index']);
Route::group(['prefix' => '/project-students'], function (){
    Route::get('/', [ProjectStudentController::class, 'index']);
});

Route::group(['prefix' => '/news'], function (){
    Route::get('/', [NewsController::class, 'index']);
    Route::get('/detail/{slug}', [NewsController::class, 'detail']);
});

Route::group(['prefix' => '/students'], function (){
    Route::get('/', [StudentController::class, 'index']);
    Route::get('/detail/{slug}', [StudentController::class, 'detail']);
});

Route::group(['prefix' => '/teachers'], function(){
    Route::get('/', [TeacherController::class, 'index']);
    Route::get('/detail/{slug}', [TeacherController::class, 'detail']);
});
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/configs', [ConfigController::class, 'index']);
Route::get('/statist-number', [StatistNumberController::class, 'index']);

Route::get('/course-categories', [CourseCategoryController::class, 'index']);
Route::group(['prefix' => '/courses'], function (){
    Route::get('/', [CourseController::class, 'index']);
    Route::get('/overview-courses', [CourseController::class, 'overviewByCourseCategory']);
    Route::get('/detail/{id}', [CourseController::class, 'detail']);
    Route::get('/relate/{id}', [CourseController::class, 'relate']);
});
Route::post('/consultations/store', [ConsultationController::class, 'store']);

Route::group(['prefix' => '/opening-schedules'], function (){
    Route::get('/', [OpeningScheduleController::class, 'index']);
    Route::get('/detail/{id}', [OpeningScheduleController::class, 'detail']);
});

Route::group(['prefix' => '/lookup'], function (){
    Route::get('/point', [LookupController::class, 'point']);
    Route::get('/diplomas', [LookupController::class, 'diplomas']);
});

Route::get('/menu-categories', [MenuController::class, 'menuCategory']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/settings', [SettingController::class, 'index']);

// work
Route::group(['prefix' => '/works'], function (){
    Route::get('/', [WorkController::class, 'index']);
    Route::get('/detail/{id}', [WorkController::class, 'detail']);
    Route::get('/relate/{id}', [WorkController::class, 'relate']);
});