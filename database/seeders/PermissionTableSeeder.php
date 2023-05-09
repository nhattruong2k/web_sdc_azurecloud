<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Banners;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Config;
use App\Models\Consultation;
use App\Models\Course;
use App\Models\CourseCategories;
use App\Models\FeelStudent;
use App\Models\GeneralSetting;
use App\Models\Menus;
use App\Models\News;
use App\Models\OpeningSchedule;
use App\Models\Partners;
use App\Models\ProjectStudent;
use App\Models\Question;
use App\Models\Roles;
use App\Models\Service;
use App\Models\StatistNumber;
use App\Models\TeamStudents;
use App\Models\TeamTeachers;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'Người dùng',
                'type' => 'group',
                'key_code' => 'users',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'users',
                'key_code' => User::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'users',
                'key_code' => User::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'users',
                'key_code' => User::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'users',
                'key_code' => User::DELETE,
            ],
            [
                'name' => 'Vai trò',
                'type' => 'group',
                'key_code' => 'roles',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'roles',
                'key_code' => Roles::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'roles',
                'key_code' => Roles::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'roles',
                'key_code' => Roles::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'roles',
                'key_code' => Roles::DELETE,
            ],
            [
                'name' => 'Menu',
                'type' => 'group',
                'key_code' => 'menus',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'menus',
                'key_code' => Menus::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'menus',
                'key_code' => Menus::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'menus',
                'key_code' => Menus::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'menus',
                'key_code' => Menus::DELETE,
            ],
            [
                'name' => 'Banner',
                'type' => 'group',
                'key_code' => 'banners',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'banners',
                'key_code' => Banners::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'banners',
                'key_code' => Banners::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'banners',
                'key_code' => Banners::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'banners',
                'key_code' => Banners::DELETE,
            ],
            [
                'name' => 'Danh Mục',
                'type' => 'group',
                'key_code' => 'categories',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'categories',
                'key_code' => Category::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'categories',
                'key_code' => Category::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'categories',
                'key_code' => Category::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'categories',
                'key_code' => Category::DELETE,
            ],
            [
                'name' => 'Bài viết',
                'type' => 'group',
                'key_code' => 'news',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'news',
                'key_code' => News::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'news',
                'key_code' => News::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'news',
                'key_code' => News::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'news',
                'key_code' => News::DELETE,
            ],
            [
                'name' => 'Danh Mục khóa học',
                'type' => 'group',
                'key_code' => 'course_categories',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'course_categories',
                'key_code' => CourseCategories::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'course_categories',
                'key_code' => CourseCategories::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'course_categories',
                'key_code' => CourseCategories::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'course_categories',
                'key_code' => CourseCategories::DELETE,
            ],
            [
                'name' => 'Khóa học',
                'type' => 'group',
                'key_code' => 'courses',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'courses',
                'key_code' => Course::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'courses',
                'key_code' => Course::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'courses',
                'key_code' => Course::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'courses',
                'key_code' => Course::DELETE,
            ],
            [
                'name' => 'Lịch khai giảng',
                'type' => 'group',
                'key_code' => 'opening_schedules',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'opening_schedules',
                'key_code' => OpeningSchedule::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'opening_schedules',
                'key_code' => OpeningSchedule::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'opening_schedules',
                'key_code' => OpeningSchedule::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'opening_schedules',
                'key_code' => OpeningSchedule::DELETE,
            ],
            [
                'name' => 'Đội ngũ giảng viên',
                'type' => 'group',
                'key_code' => 'teachers',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'teachers',
                'key_code' => TeamTeachers::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'teachers',
                'key_code' => TeamTeachers::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'teachers',
                'key_code' => TeamTeachers::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'teachers',
                'key_code' => TeamTeachers::DELETE,
            ],
            [
                'name' => 'Danh sách sinh viên',
                'type' => 'group',
                'key_code' => 'students',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'students',
                'key_code' => TeamStudents::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'students',
                'key_code' => TeamStudents::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'students',
                'key_code' => TeamStudents::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'students',
                'key_code' => TeamStudents::DELETE,
            ],
            [
                'name' => 'Danh sách thống kê',
                'type' => 'group',
                'key_code' => 'statistNumbers',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'statistNumbers',
                'key_code' => StatistNumber::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'statistNumbers',
                'key_code' => StatistNumber::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'statistNumbers',
                'key_code' => StatistNumber::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'statistNumbers',
                'key_code' => StatistNumber::DELETE,
            ],
            [
                'name' => 'Sản phẩm học viên',
                'type' => 'group',
                'key_code' => 'projects',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'projects',
                'key_code' => ProjectStudent::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'projects',
                'key_code' => ProjectStudent::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'projects',
                'key_code' => ProjectStudent::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'projects',
                'key_code' => ProjectStudent::DELETE,
            ],
            [
                'name' => 'Lợi ích khóa học',
                'type' => 'group',
                'key_code' => 'benefits',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'benefits',
                'key_code' => Benefit::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'benefits',
                'key_code' => Benefit::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'benefits',
                'key_code' => Benefit::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'benefits',
                'key_code' => Benefit::DELETE,
            ],
            [
                'name' => 'Đối tác',
                'type' => 'group',
                'key_code' => 'partners',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'partners',
                'key_code' => Partners::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'partners',
                'key_code' => Partners::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'partners',
                'key_code' => Partners::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'partners',
                'key_code' => Partners::DELETE,
            ],
            [
                'name' => 'Đăng ký tư vấn',
                'type' => 'group',
                'key_code' => 'consultations',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'consultations',
                'key_code' => Consultation::LIST,
            ],
            [
                'name' => 'Xóa',
                'type' => 'consultations',
                'key_code' => Consultation::DELETE,
            ],
            [
                'name' => 'Cảm nhận học viên',
                'type' => 'group',
                'key_code' => 'feels',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'feels',
                'key_code' => FeelStudent::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'feels',
                'key_code' => FeelStudent::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'feels',
                'key_code' => FeelStudent::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'feels',
                'key_code' => FeelStudent::DELETE,
            ],
            [
                'name' => 'Cấu hình',
                'type' => 'group',
                'key_code' => 'config',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'config',
                'key_code' => Config::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'config',
                'key_code' => Config::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'config',
                'key_code' => Config::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'config',
                'key_code' => Config::DELETE,
            ],
            [
                'name' => 'Cài đặt chung',
                'type' => 'group',
                'key_code' => 'general_settings',
            ],
            [
                'name' => 'Cài đặt',
                'type' => 'general_settings',
                'key_code' => GeneralSetting::VIEW,
            ],
            [
                'name' => 'Dịch vụ',
                'type' => 'group',
                'key_code' => 'services',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'services',
                'key_code' => Service::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'services',
                'key_code' => Service::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'services',
                'key_code' => Service::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'services',
                'key_code' => Service::DELETE,
            ],
            [
                'name' => 'Việc làm',
                'type' => 'group',
                'key_code' => 'work',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'work',
                'key_code' => Work::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'work',
                'key_code' => Work::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'work',
                'key_code' => Work::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'work',
                'key_code' => Work::DELETE,
            ],
            [
                'name' => 'Nhật ký hoạt động',
                'type' => 'group',
                'key_code' => 'activity_logs',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'activity_logs',
                'key_code' => ActivityLog::VIEW,
            ],
            [
                'name' => 'Xóa',
                'type' => 'activity_logs',
                'key_code' => ActivityLog::DELETE,
            ],
            [
                'name' => 'Q&A',
                'type' => 'group',
                'key_code' => 'questions',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'questions',
                'key_code' => Question::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'questions',
                'key_code' => Question::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'questions',
                'key_code' => Question::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'questions',
                'key_code' => Question::DELETE,
            ],
        ];
        \DB::table('permissions')->insert($permissions);
    }
}
