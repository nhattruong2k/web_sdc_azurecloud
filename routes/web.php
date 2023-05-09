<?php

use App\Http\Controllers\Admin\ActivityLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\BenefitController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\TeamTeachersController;
use App\Http\Controllers\Admin\TeamStudentController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\StatistNumberController;
use App\Http\Controllers\Admin\ProjectStudentController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FeelStudentController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\OpeningScheduleController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WorkController;
use App\Models\ActivityLog;
use App\Models\Banners;
use App\Models\Benefit;
use App\Models\Menus;
use App\Models\User;
use App\Models\Category;
use App\Models\Config;
use App\Models\Partners;
use App\Models\Roles;
use App\Models\News;
use App\Models\ProjectStudent;
use App\Models\TeamTeachers;
use App\Models\TeamStudents;
use App\Models\StatistNumber;
use App\Models\CourseCategories;
use App\Models\Course;
use App\Models\FeelStudent;

use App\Models\Consultation;
use App\Models\OpeningSchedule;
use App\Models\GeneralSetting;
use App\Models\Question;
use App\Models\Service;
use App\Models\Work;
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
    return redirect(url('/admin'));
});
Route::group(['prefix' => '/admin/laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
/*----------------------------------------------------------------------------*/
/* Group Admin
/*----------------------------------------------------------------------------*/
Route::group(array('prefix' => '/admin', 'namespace' => 'Admin'), function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('admin.post_login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::group(array('prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'adminRedirect']), function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin-home');
    /*--------------------------------------------------------------------*/
    /* User
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/users', 'namespace' => 'Admin'), function () {
        Route::get('/', [UsersController::class, 'index'])->name(User::LIST)->middleware('can:'. User::LIST);
        Route::get('/create', [UsersController::class, 'create'])->name(User::CREATE)->middleware('can:'. User::CREATE);
        Route::post('/store', [UsersController::class, 'store']);
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name(User::UPDATE)->middleware('can:'. User::UPDATE);
        Route::post('/update/{id}', [UsersController::class, 'update']);
        Route::post('/destroy', [UsersController::class, 'destroy'])->name(User::DELETE)->middleware('can:'. User::DELETE);
        Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
        Route::post('/profile', [UsersController::class, 'updateProfile'])->name('updateProfile');
        Route::post('/active', [UsersController::class, 'active']);
        Route::post('/username-exist', [UsersController::class, 'usernameExist'])->name('username-exist');
        Route::post('/email-exist', [UsersController::class, 'emailExist'])->name('users.email-exist');
        Route::get('/change-password', [UsersController::class, 'changePassword'])->name('changePassword')->middleware('can:'. User::UPDATE);
        Route::post('/change-password', [UsersController::class, 'saveChangePassword'])->name('saveChangePassword');
        Route::get('/permission/{id}', [UsersController::class, 'permission'])->name('userPermission');
        Route::post('/save-permission/{id}', [UsersController::class, 'savePermission']);
        Route::get('/change-password/{id}', [UsersController::class, 'userChangePass'])->name('user.change_pass');
        Route::post('/change-password/{id}', [UsersController::class, 'saveUserChangePass'])->name('user.save_change_pass');
    });

    // Category
    Route::group(array('prefix' => '/category', 'namespace' => 'Admin'), function () {
        Route::get('/', [CategoryController::class, 'index'])->name(Category::LIST)->middleware('can:'. Category::LIST);
        Route::post('/active', [CategoryController::class, 'active'])->name('category.active');
        Route::post('/status', [CategoryController::class, 'status'])->name('category.status');
        Route::get('/create', [CategoryController::class, 'create'])->name(Category::CREATE)->middleware('can:'. Category::CREATE);
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name(CATEGORY::UPDATE)->middleware('can:'. Category::UPDATE);
        Route::post('/update/{id}', [CategoryController::class, 'update']);
        Route::post('/destroy', [CategoryController::class, 'destroy'])->name(CATEGORY::DELETE)->middleware('can:'. Category::DELETE);
        Route::post('/title-exist', [CategoryController::class, 'titleExist'])->name('title-exist');
        Route::get('/delete-image/{id}/{imageName}', [CategoryController::class, 'deleteImg'])->name('category.delete_img');
    });
    // News
    Route::group(array('prefix' => '/news', 'namespace' => 'Admin'), function () {
        Route::get('/', [NewsController::class, 'index'])->name(News::LIST)->middleware('can:'. News::LIST);
        Route::get('/create', [NewsController::class, 'create'])->name(News::CREATE)->middleware('can:'. News::CREATE);
        Route::post('/store', [NewsController::class, 'store'])->name('news.store');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name(News::UPDATE)->middleware('can:'. News::UPDATE);
        Route::post('/update/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::post('/destroy', [NewsController::class, 'destroy'])->name(News::DELETE)->middleware('can:'. News::DELETE);
        Route::post('/titleNew-exist', [NewsController::class, 'titleExist'])->name('titleNew-exist');
        Route::post('/detail-content', [NewsController::class,'detailContent'])->name('detail-content');
        Route::post('/active', [NewsController::class,'active'])->name('active');
        Route::get('/delete-image/{id}/{imageName}', [NewsController::class, 'deleteImg'])->name('news.delete_img');
    });
    // teamTeacher
    Route::group(array('prefix' => '/teachers', 'namespace' => 'Admin'), function () {
        Route::get('/', [TeamTeachersController::class, 'index'])->name(TeamTeachers::LIST)->middleware('can:'. TeamTeachers::LIST);
        Route::get('/create', [TeamTeachersController::class, 'create'])->name(TeamTeachers::CREATE)->middleware('can:'. TeamTeachers::CREATE);
        Route::post('/store', [TeamTeachersController::class, 'store'])->name('teachers.store');
        Route::get('/edit/{id}', [TeamTeachersController::class, 'edit'])->name(TeamTeachers::UPDATE)->middleware('can:'. TeamTeachers::UPDATE);
        Route::post('/update/{id}', [TeamTeachersController::class, 'update'])->name('teachers.update');
        Route::post('/destroy', [TeamTeachersController::class, 'destroy'])->name(TeamTeachers::DELETE)->middleware('can:'. TeamTeachers::DELETE);
        Route::post('/active', [TeamTeachersController::class,'active'])->name('teachers.active');
        Route::get('/delete-image/{id}/{imageName}', [TeamTeachersController::class, 'deleteImg'])->name('teachers.delete_img');
    });
    // StatistNumber
    Route::group(array('prefix' => '/statistNumbers', 'namespace' => 'Admin'), function () {
        Route::get('/', [StatistNumberController::class, 'index'])->name(StatistNumber::LIST)->middleware('can:'. StatistNumber::LIST);
        Route::get('/create', [StatistNumberController::class, 'create'])->name(StatistNumber::CREATE)->middleware('can:'. StatistNumber::CREATE);
        Route::post('/store', [StatistNumberController::class, 'store'])->name('statistNumber.store');
        Route::get('/edit/{id}', [StatistNumberController::class, 'edit'])->name(StatistNumber::UPDATE)->middleware('can:'. StatistNumber::UPDATE);
        Route::post('/update/{id}', [StatistNumberController::class, 'update'])->name('statistNumber.update');
        Route::post('/destroy', [StatistNumberController::class, 'destroy'])->name(StatistNumber::DELETE)->middleware('can:'. StatistNumber::DELETE);
        Route::post('/active', [StatistNumberController::class,'active'])->name('statistNumber.active');
        Route::post('/titleStatist-exist', [StatistNumberController::class, 'titleExist'])->name('titleStatist-exist');
        Route::get('/delete-image/{id}/{imageName}', [StatistNumberController::class, 'deleteImg'])->name('statistNumber.delete_img');

    });

    Route::group(array('prefix' => '/students', 'namespace' => 'Admin'), function () {
        Route::get('/', [TeamStudentController::class, 'index'])->name(TeamStudents::LIST)->middleware('can:'. TeamStudents::LIST);
        Route::get('/create', [TeamStudentController::class, 'create'])->name(TeamStudents::CREATE)->middleware('can:'. TeamStudents::CREATE);
        Route::post('/store', [TeamStudentController::class, 'store'])->name('students.store');
        Route::get('/edit/{id}', [TeamStudentController::class, 'edit'])->name(TeamStudents::UPDATE)->middleware('can:'. TeamStudents::UPDATE);
        Route::post('/update/{id}', [TeamStudentController::class, 'update'])->name('students.update');
        Route::post('/destroy', [TeamStudentController::class, 'destroy'])->name(TeamStudents::DELETE)->middleware('can:'. TeamStudents::DELETE);
        Route::post('/active', [TeamStudentController::class,'active'])->name('students.active');
        Route::get('/delete-image/{id}/{imageName}', [TeamStudentController::class, 'deleteImg'])->name('students.delete_img');
    });


    /*--------------------------------------------------------------------*/
    /* Role
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/roles', 'namespace' => 'Admin'), function () {
        Route::get('/', [RolesController::class, 'index'])->name(Roles::LIST)->middleware('can:'. Roles::LIST);
        Route::get('/create', [RolesController::class, 'create'])->name(Roles::CREATE)->middleware('can:'. Roles::CREATE);
        Route::post('/store', [RolesController::class, 'store']);
        Route::get('/edit/{id}', [RolesController::class, 'edit'])->name(Roles::UPDATE)->middleware('can:'. Roles::UPDATE);
        Route::post('/update/{id}', [RolesController::class, 'update']);
        Route::post('/destroy', [RolesController::class, 'destroy'])->name(Roles::DELETE)->middleware('can:'. Roles::DELETE);
        Route::post('/active', [RolesController::class, 'active']);
        Route::post('/name-exist', [RolesController::class, 'nameExist'])->name('role-name-exist');
    });
    /*--------------------------------------------------------------------*/
    /* Banner
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/banners', 'namespace' => 'Admin'), function () {
        Route::get('/', [BannersController::class, 'index'])->name(Banners::LIST)->middleware('can:'. Banners::LIST);
        Route::get('/create', [BannersController::class, 'create'])->name(Banners::CREATE)->middleware('can:'. Banners::CREATE);
        Route::post('/store', [BannersController::class, 'store']);
        Route::get('/edit/{id}', [BannersController::class, 'edit'])->name(Banners::UPDATE)->middleware('can:'. Banners::UPDATE);
        Route::post('/update/{id}', [BannersController::class, 'update']);
        Route::post('/destroy', [BannersController::class, 'destroy'])->name(Banners::DELETE)->middleware('can:'. Banners::DELETE);
        Route::post('/active', [BannersController::class, 'active']);
        Route::post('/title-exist', [BannersController::class, 'titleExist'])->name('banner-title-exist');
        Route::get('/delete-image/{id}/{imageName}', [BannersController::class, 'deleteImg'])->name('banners.delete_img');

    });
    /*--------------------------------------------------------------------*/
    /* Menu
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/menus', 'namespace' => 'Admin'), function () {
        Route::get('/', [MenusController::class, 'index'])->name(Menus::LIST)->middleware('can:'. Menus::LIST);
        Route::get('/create', [MenusController::class, 'create'])->name(Menus::CREATE)->middleware('can:'. Menus::CREATE);
        Route::post('/store', [MenusController::class, 'store']);
        Route::get('/edit/{id}', [MenusController::class, 'edit'])->name(Menus::UPDATE)->middleware('can:'. Menus::UPDATE);
        Route::post('/update/{id}', [MenusController::class, 'update']);
        Route::post('/destroy', [MenusController::class, 'destroy'])->name(Menus::DELETE)->middleware('can:'. Menus::DELETE);
        Route::post('/active', [MenusController::class, 'active']);
        Route::post('/title-exist', [MenusController::class, 'titleExist'])->name('menu-title-exist');
    });
    /*--------------------------------------------------------------------*/
    /* Config
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/config', 'namespace' => 'Admin'), function () {
        Route::get('/', [ConfigController::class, 'index'])->name(Config::LIST)->middleware('can:'. Config::LIST);
        Route::get('/create', [ConfigController::class, 'create'])->name(Config::CREATE)->middleware('can:'. Config::CREATE);
        Route::post('/store', [ConfigController::class, 'store']);
        Route::get('/edit/{id}', [ConfigController::class, 'edit'])->name(Config::UPDATE)->middleware('can:'. Config::UPDATE);
        Route::post('/update/{id}', [ConfigController::class, 'update']);
        Route::post('/destroy', [ConfigController::class, 'destroy'])->name(Config::DELETE)->middleware('can:'. Config::DELETE);
        Route::post('/active', [ConfigController::class, 'active']);
        Route::post('/key-exist', [ConfigController::class, 'keyExist'])->name('config.key-exist');
    });
    /*--------------------------------------------------------------------*/
    /* Partners
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/partners', 'namespace' => 'Admin'), function () {
        Route::get('/', [PartnersController::class, 'index'])->name(Partners::LIST)->middleware('can:'. Partners::LIST);
        Route::get('/create', [PartnersController::class, 'create'])->name(Partners::CREATE)->middleware('can:'. Partners::CREATE);
        Route::post('/store', [PartnersController::class, 'store']);
        Route::get('/edit/{id}', [PartnersController::class, 'edit'])->name(Partners::UPDATE)->middleware('can:'. Partners::UPDATE);
        Route::post('/update/{id}', [PartnersController::class, 'update']);
        Route::post('/destroy', [PartnersController::class, 'destroy'])->name(Partners::DELETE)->middleware('can:'. Partners::DELETE);
        Route::post('/active', [PartnersController::class, 'active']);
        Route::post('/title-exist', [PartnersController::class, 'titleExist'])->name('partners.title-exist');
        Route::get('/delete-image/{id}/{imageName}', [PartnersController::class, 'deleteImg'])->name('partners.delete_img');
    });
    /*--------------------------------------------------------------------*/
    /* Project-student
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/project-students', 'namespace' => 'Admin'), function () {
        Route::get('/', [ProjectStudentController::class, 'index'])->name(ProjectStudent::LIST)->middleware('can:'. ProjectStudent::LIST);
        Route::get('/create', [ProjectStudentController::class, 'create'])->name(ProjectStudent::CREATE)->middleware('can:'. ProjectStudent::CREATE);
        Route::post('/store', [ProjectStudentController::class, 'store']);
        Route::get('/edit/{id}', [ProjectStudentController::class, 'edit'])->name(ProjectStudent::UPDATE)->middleware('can:'. ProjectStudent::UPDATE);
        Route::post('/update/{id}', [ProjectStudentController::class, 'update']);
        Route::post('/destroy', [ProjectStudentController::class, 'destroy'])->name(ProjectStudent::DELETE)->middleware('can:'. ProjectStudent::DELETE);
        Route::post('/active', [ProjectStudentController::class, 'active']);
        Route::post('/title-exist', [ProjectStudentController::class, 'titleExist'])->name('project_students.title-exist');
        Route::get('/delete-image/{id}/{imageName}', [ProjectStudentController::class, 'deleteImg'])->name('project_students.delete_img');
    });
    /*--------------------------------------------------------------------*/
    /* benefit
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/benefits', 'namespace' => 'Admin'), function () {
        Route::get('/', [BenefitController::class, 'index'])->name(Benefit::LIST)->middleware('can:'. Benefit::LIST);
        Route::get('/create', [BenefitController::class, 'create'])->name(Benefit::CREATE)->middleware('can:'. Benefit::CREATE);
        Route::post('/store', [BenefitController::class, 'store']);
        Route::get('/edit/{id}', [BenefitController::class, 'edit'])->name(Benefit::UPDATE)->middleware('can:'. Benefit::UPDATE);
        Route::post('/update/{id}', [BenefitController::class, 'update']);
        Route::post('/destroy', [BenefitController::class, 'destroy'])->name(Benefit::DELETE)->middleware('can:'. Benefit::DELETE);
        Route::post('/active', [BenefitController::class, 'active']);
        Route::post('/title-exist', [BenefitController::class, 'titleExist'])->name('benefit_students.title-exist');
        Route::get('/delete-image/{id}/{imageName}/{type}', [BenefitController::class, 'deleteImg'])->name('benefit_students.delete_img');
    });

    // Danh mục khóa học
    Route::group(array('prefix' => '/course-categories', 'namespace' => 'Admin'), function () {
        Route::get('/', [CourseCategoryController::class, 'index'])->name(CourseCategories::LIST)->middleware('can:'. CourseCategories::LIST);
        Route::get('/create', [CourseCategoryController::class, 'create'])->name(CourseCategories::CREATE)->middleware('can:'. CourseCategories::CREATE);
        Route::post('/store', [CourseCategoryController::class, 'store'])->name('course_categories.store');
        Route::get('/edit/{id}', [CourseCategoryController::class, 'edit'])->name(CourseCategories::UPDATE)->middleware('can:'. CourseCategories::UPDATE);
        Route::post('/update/{id}', [CourseCategoryController::class, 'update'])->name('course_categories.update');
        Route::post('/active', [CourseCategoryController::class, 'active'])->name('course_categories.active');
        Route::post('/destroy', [CourseCategoryController::class, 'destroy'])->name(CourseCategories::DELETE)->middleware('can:'. CourseCategories::DELETE);
        Route::post('/title-exist', [CourseCategoryController::class, 'titleExist'])->name('course_categories.title_exist');
        Route::get('/delete-image/{id}/{imageName}', [CourseCategoryController::class, 'deleteImg'])->name('course_categories.delete_img');
    });

    // Khóa học
    Route::group(array('prefix' => '/courses', 'namespace' => 'Admin'), function () {
        Route::get('/', [CourseController::class, 'index'])->name(Course::LIST)->middleware('can:'. Course::LIST);
        Route::get('/create', [CourseController::class, 'create'])->name(Course::CREATE)->middleware('can:'. Course::CREATE);
        Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name(Course::UPDATE)->middleware('can:'. Course::UPDATE);
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::post('/active', [CourseController::class, 'active'])->name('courses.active');
        Route::post('/destroy', [CourseController::class, 'destroy'])->name(Course::DELETE)->middleware('can:'. Course::DELETE);
        Route::post('/title-exist', [CourseController::class, 'titleExist'])->name('courses.title_exist');
        Route::get('/delete-image/{id}/{imageName}', [CourseController::class, 'deleteImg'])->name('courses.delete_img');
    });

    /*--------------------------------------------------------------------*/
    /* feel students
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/feel-students', 'namespace' => 'Admin'), function () {
        Route::get('/', [FeelStudentController::class, 'index'])->name(FeelStudent::LIST)->middleware('can:'. FeelStudent::LIST);
        Route::get('/create', [FeelStudentController::class, 'create'])->name(FeelStudent::CREATE)->middleware('can:'. FeelStudent::CREATE);
        Route::post('/store', [FeelStudentController::class, 'store']);
        Route::get('/edit/{id}', [FeelStudentController::class, 'edit'])->name(FeelStudent::UPDATE)->middleware('can:'. FeelStudent::UPDATE);
        Route::post('/update/{id}', [FeelStudentController::class, 'update']);
        Route::post('/destroy', [FeelStudentController::class, 'destroy'])->name(FeelStudent::DELETE)->middleware('can:'. FeelStudent::DELETE);
        Route::post('/active', [FeelStudentController::class, 'active']);
        Route::get('/delete-image/{id}/{imageName}', [FeelStudentController::class, 'deleteImg'])->name('feelStudent.delete_img');
    });
    /*--------------------------------------------------------------------*/
    /* Đăng ký tư vấn
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/consultations', 'namespace' => 'Admin'), function () {
        Route::get('/', [ConsultationController::class, 'index'])->name(Consultation::LIST)->middleware('can:'. Consultation::LIST);
        Route::post('/destroy', [ConsultationController::class, 'destroy'])->name(Consultation::DELETE)->middleware('can:'. Consultation::DELETE);
        Route::post('/export', [ConsultationController::class, 'export'])->name('consultations.export');
        Route::post('/change-status', [ConsultationController::class, 'status'])->name('consultations.status');
    });

    /*--------------------------------------------------------------------*/
    /* Lịch khai giảng
    /*--------------------------------------------------------------------*/
    Route::group(array('prefix' => '/opening-schedules', 'namespace' => 'Admin'), function () {
        Route::get('/', [OpeningScheduleController::class, 'index'])->name(OpeningSchedule::LIST)->middleware('can:'. OpeningSchedule::LIST);
        Route::get('/create', [OpeningScheduleController::class, 'create'])->name(OpeningSchedule::CREATE)->middleware('can:'. OpeningSchedule::CREATE);
        Route::post('/store', [OpeningScheduleController::class, 'store'])->name('opening_schedules.store');
        Route::get('/edit/{id}', [OpeningScheduleController::class, 'edit'])->name(OpeningSchedule::UPDATE)->middleware('can:'. OpeningSchedule::UPDATE);
        Route::post('/update/{id}', [OpeningScheduleController::class, 'update'])->name('opening_schedules.update');
        Route::post('/active', [OpeningScheduleController::class, 'active'])->name('opening_schedules.active');
        Route::post('/destroy', [OpeningScheduleController::class, 'destroy'])->name(OpeningSchedule::DELETE)->middleware('can:'. OpeningSchedule::DELETE);
        Route::post('/exist', [OpeningScheduleController::class, 'exist'])->name('opening_schedules.exist');
    });

    // Cài đặt chung
    Route::group(['prefix' => '/general-settings', 'namespace' => 'Admin'], function (){
        Route::get('/', [GeneralSettingController::class, 'index'])->name(GeneralSetting::VIEW)->middleware('can:'.GeneralSetting::VIEW);
        Route::post('/save', [GeneralSettingController::class, 'save'])->name(GeneralSetting::SAVE);
    });

    /*--------------------------------------------------------------------*/
    /* Dịch vụ
    /*--------------------------------------------------------------------*/
    Route::group(['prefix' => '/services', 'namespace' => 'Admin'], function (){
        Route::get('/', [ServiceController::class, 'index'])->name(Service::LIST)->middleware('can:'. Service::LIST);
        Route::get('/create', [ServiceController::class, 'create'])->name(Service::CREATE)->middleware('can:'. Service::CREATE);
        Route::post('/store', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name(Service::UPDATE)->middleware('can:'. Service::UPDATE);
        Route::post('/update/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::post('/active', [ServiceController::class, 'active'])->name('services.active');
        Route::post('/destroy', [ServiceController::class, 'destroy'])->name(Service::DELETE)->middleware('can:'. Service::DELETE);
        Route::post('/titleExist', [ServiceController::class, 'titleExist'])->name('services.exist');
    });

    /*--------------------------------------------------------------------*/
    /* Work
    /*--------------------------------------------------------------------*/
    Route::group(['prefix' => '/works', 'namespace' => 'Admin'], function (){
        Route::get('/', [WorkController::class, 'index'])->name(Work::LIST)->middleware('can:'. Work::LIST);
        Route::get('/create', [WorkController::class, 'create'])->name(Work::CREATE)->middleware('can:'. Work::CREATE);
        Route::post('/store', [WorkController::class, 'store'])->name('works.store');
        Route::get('/edit/{id}', [WorkController::class, 'edit'])->name(Work::UPDATE)->middleware('can:'. Work::UPDATE);
        Route::post('/update/{id}', [WorkController::class, 'update'])->name('works.update');
        Route::post('/active', [WorkController::class, 'active'])->name('works.active');
        Route::post('/destroy', [WorkController::class, 'destroy'])->name(Work::DELETE)->middleware('can:'. Work::DELETE);
        Route::post('/titleExist', [WorkController::class, 'titleExist'])->name('works.exist');
    });

    /*--------------------------------------------------------------------*/
    /* Activity logs
    /*--------------------------------------------------------------------*/
    Route::group(['prefix' => '/activity-logs', 'namespace' => 'Admin'], function (){
        Route::get('/', [ActivityLogController::class, 'index'])->name(ActivityLog::VIEW)->middleware('can:'. ActivityLog::VIEW);
        Route::post('/destroy', [ActivityLogController::class, 'destroy'])->name(ActivityLog::DELETE)->middleware('can:'. ActivityLog::DELETE);
    });

    /*--------------------------------------------------------------------*/
    /* Q&A
    /*--------------------------------------------------------------------*/
    Route::group(['prefix' => '/questions', 'namespace' => 'Admin'], function (){
        Route::get('/', [QuestionController::class, 'index'])->name(Question::LIST)->middleware('can:'. Question::LIST);
        Route::get('/create', [QuestionController::class, 'create'])->name(Question::CREATE)->middleware('can:'. Question::CREATE);
        Route::post('/store', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('/edit/{id}', [QuestionController::class, 'edit'])->name(Question::UPDATE)->middleware('can:'. Question::UPDATE);
        Route::post('/update/{id}', [QuestionController::class, 'update'])->name('questions.update');
        Route::post('/active', [QuestionController::class, 'active'])->name('questions.active');
        Route::post('/destroy', [QuestionController::class, 'destroy'])->name(Question::DELETE)->middleware('can:'. Question::DELETE);
        Route::post('/question-exist', [QuestionController::class, 'questionExist'])->name('questions.question_exist');
    });
});


Route::get('admin/migrate', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate');
    return "successfully";
});

Route::get('admin/seed', function (\Illuminate\Http\Request $request) {
    $class = $request->get('class');
    if (isset($class)){
        \Illuminate\Support\Facades\Artisan::call('db:seed --class='.$class);
    }else{
        \Illuminate\Support\Facades\Artisan::call('db:seed');
    }
    return "successfully";
});

Route::get('admin/artisan', function(\Illuminate\Http\Request $request) {
    $name = $request->get('name');
    \Illuminate\Support\Facades\Artisan::call($name);
    return "successfully";
});

Route::get('admin/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return "Cache is cleared";
});
