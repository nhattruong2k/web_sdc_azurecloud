<?php

use App\Models\ActivityLog;
use App\Models\Banners;
use App\Models\Benefit;
use App\Models\User;
use App\Models\Roles;
use App\Models\Category;
use App\Models\News;
use App\Models\Config;
use App\Models\Menus;
use App\Models\Teamteachers;
use App\Models\TeamStudents;
use App\Models\Partners;
use App\Models\StatistNumber;
use App\Models\ProjectStudent;
use App\Models\CourseCategories;
use App\Models\Course;
use App\Models\FeelStudent;
use App\Models\Consultation;
use App\Models\OpeningSchedule;
use App\Models\GeneralSetting;
use App\Models\Question;
use App\Models\Service;
use App\Models\Work;

return [
    'access' => [
        'users' => [
            'list'   => User::LIST,
            'create' => User::CREATE,
            'update' => User::UPDATE,
            'delete' => User::DELETE,
        ],
        'roles' => [
            'list'   => Roles::LIST,
            'create' => Roles::CREATE,
            'update' => Roles::UPDATE,
            'delete' => Roles::DELETE,
        ],
        'categories' => [
            'list'   => Category::LIST,
            'create' => Category::CREATE,
            'update' => Category::UPDATE,
            'delete' => Category::DELETE,
        ],
        'news' => [
            'list'   => News::LIST,
            'create' => News::CREATE,
            'update' => News::UPDATE,
            'delete' => News::DELETE,
        ],
        'banners' => [
            'list'   => Banners::LIST,
            'create' => Banners::CREATE,
            'update' => Banners::UPDATE,
            'delete' => Banners::DELETE,
        ],
        'menus' => [
            'list'   => Menus::LIST,
            'create' => Menus::CREATE,
            'update' => Menus::UPDATE,
            'delete' => Menus::DELETE,
        ],
        'teachers' => [
            'list'   => Teamteachers::LIST,
            'create' => Teamteachers::CREATE,
            'update' => Teamteachers::UPDATE,
            'delete' => Teamteachers::DELETE,
        ],
        'students' => [
            'list'   => TeamStudents::LIST,
            'create' => TeamStudents::CREATE,
            'update' => TeamStudents::UPDATE,
            'delete' => TeamStudents::DELETE,
        ],
        'config' => [
            'list'   => Config::LIST,
            'create' => Config::CREATE,
            'update' => Config::UPDATE,
            'delete' => Config::DELETE,
        ],
        'partners' => [
            'list'   => Partners::LIST,
            'create' => Partners::CREATE,
            'update' => Partners::UPDATE,
            'delete' => Partners::DELETE,
        ],
        'statistNumbers' => [
            'list'   => StatistNumber::LIST,
            'create' => StatistNumber::CREATE,
            'update' => StatistNumber::UPDATE,
            'delete' => StatistNumber::DELETE,
        ],
        'projects' => [
            'list'   => ProjectStudent::LIST,
            'create' => ProjectStudent::CREATE,
            'update' => ProjectStudent::UPDATE,
            'delete' => ProjectStudent::DELETE,
        ],
        'benefits' => [
            'list'   => Benefit::LIST,
            'create' => Benefit::CREATE,
            'update' => Benefit::UPDATE,
            'delete' => Benefit::DELETE,
        ],
        'course_categories' => [
            'list'   => CourseCategories::LIST,
            'create' => CourseCategories::CREATE,
            'update' => CourseCategories::UPDATE,
            'delete' => CourseCategories::DELETE,
        ],
        'courses' => [
            'list'   => Course::LIST,
            'create' => Course::CREATE,
            'update' => Course::UPDATE,
            'delete' => Course::DELETE,
        ],
        'feel_students' => [
            'list'   => FeelStudent::LIST,
            'create' => FeelStudent::CREATE,
            'update' => FeelStudent::UPDATE,
            'delete' => FeelStudent::DELETE,
        ],
        'consultations' => [
            'list'   => Consultation::LIST,
            'delete' => Consultation::DELETE,
        ],
        'opening_schedules' => [
            'list'   => OpeningSchedule::LIST,
            'create'   => OpeningSchedule::CREATE,
            'update'   => OpeningSchedule::UPDATE,
            'delete' => OpeningSchedule::DELETE,
        ],
        'general_settings' => [
            'list'   => GeneralSetting::VIEW,
        ],
        'services' => [
            'list'   => Service::LIST,
            'create'   => Service::CREATE,
            'update'   => Service::UPDATE,
            'delete' => Service::DELETE,
        ],
        'works' => [
            'list'   => Work::LIST,
            'create'   => Work::CREATE,
            'update'   => Work::UPDATE,
            'delete' => Work::DELETE,
        ],
        'activity_logs' => [
            'list' => ActivityLog::VIEW,
            'delete' => ActivityLog::DELETE,
        ],
        'questions' => [
            'list'   => Question::LIST,
            'create'   => Question::CREATE,
            'update'   => Question::UPDATE,
            'delete' => Question::DELETE,
        ]
    ]
];
