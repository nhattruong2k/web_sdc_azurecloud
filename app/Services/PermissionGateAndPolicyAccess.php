<?php
namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Banners;
use App\Models\Benefit;
use App\Models\Config;
use App\Models\Consultation;
use App\Models\Course;
use App\Models\CourseCategories;
use App\Models\GeneralSetting;
use App\Models\FeelStudent;
use App\Models\Inventory;
use App\Models\IqcGrnDetail;
use App\Models\OpeningSchedule;
use App\Models\Roles;
use App\Models\Service;
use App\Models\User;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\MaterialType;
use App\Models\GoodReceivedNote;
use App\Models\Menus;
use App\Models\Partners;
use App\Models\WareHouse;
use App\Models\SemiFinished;
use App\Policies\BannerPolicy;
use App\Policies\BenefitPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ConfigPolicy;
use App\Policies\ConsultationPolicy;
use App\Policies\CourseCategoryPolicy;
use App\Policies\CoursePolicy;
use App\Policies\FeelStudentPolicy;
use App\Policies\GeneralSettingPolicy;
use App\Policies\MenuPolicy;
use App\Policies\NewsPolicy;
use App\Policies\OpeningSchedulePolicy;
use App\Policies\PartnerPolicy;
use App\Policies\ProjectStudentPolicy;
use App\Policies\RolePolicy;
use App\Policies\ServicePolicy;
use App\Policies\StatistNumberPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\News;
use App\Models\ProjectStudent;
use App\Models\Question;
use App\Models\Teamteachers;
use App\Models\TeamStudents;
use App\Models\StatistNumber;
use App\Models\Work;
use App\Policies\ActivityLogPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\TeamstudentPolicy;
use App\Policies\WorkPolicy;

class PermissionGateAndPolicyAccess{

    public function setGateAndPolicyAccess(){
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGateCategory();
        $this->defineGateNews();
        $this->defineGateBanner();
        $this->defineGateMenu();
        $this->defineGateTeamTeacher();
        $this->defineGateTeamStudent();
        $this->defineGateConfig();
        $this->defineGatePartner();
        $this->defineGateStatistNumber();
        $this->defineGateProject();
        $this->defineGateBenefit();
        $this->defineCourseCategtory();
        $this->defineCourses();
        $this->defineFeelStudents();
        $this->defineConsultation();
        $this->defineOpeningSchedule();
        $this->defineGeneralSetting();
        $this->defineService();
        $this->defineGateWork();
        $this->defineGateActivityLog();
        $this->defineGateQuestion();
    }

    public function defineGateUser(){
        Gate::define(User::LIST, [UserPolicy::class, 'view']);
        Gate::define(User::CREATE, [UserPolicy::class, 'create']);
        Gate::define(User::UPDATE, [UserPolicy::class, 'update']);
        Gate::define(User::DELETE, [UserPolicy::class, 'delete']);
    }

    public function defineGateRole(){
        Gate::define(Roles::LIST, [RolePolicy::class, 'view']);
        Gate::define(Roles::CREATE, [RolePolicy::class, 'create']);
        Gate::define(Roles::UPDATE, [RolePolicy::class, 'update']);
        Gate::define(Roles::DELETE, [RolePolicy::class, 'delete']);
    }

    public function defineGateCategory(){
        Gate::define(Category::LIST, [CategoryPolicy::class, 'view']);
        Gate::define(Category::CREATE, [CategoryPolicy::class, 'create']);
        Gate::define(Category::UPDATE, [CategoryPolicy::class, 'update']);
        Gate::define(Category::DELETE, [CategoryPolicy::class, 'delete']);
    }

    public function defineGateNews(){
        Gate::define(News::LIST, [NewsPolicy::class, 'view']);
        Gate::define(News::CREATE, [NewsPolicy::class, 'create']);
        Gate::define(News::UPDATE, [NewsPolicy::class, 'update']);
        Gate::define(News::DELETE, [NewsPolicy::class, 'delete']);
    }

    public function defineGateBanner(){
        Gate::define(Banners::LIST, [BannerPolicy::class, 'view']);
        Gate::define(Banners::CREATE, [BannerPolicy::class, 'create']);
        Gate::define(Banners::UPDATE, [BannerPolicy::class, 'update']);
        Gate::define(Banners::DELETE, [BannerPolicy::class, 'delete']);
    }

    public function defineGateMenu(){
        Gate::define(Menus::LIST, [MenuPolicy::class, 'view']);
        Gate::define(Menus::CREATE, [MenuPolicy::class, 'create']);
        Gate::define(Menus::UPDATE, [MenuPolicy::class, 'update']);
        Gate::define(Menus::DELETE, [MenuPolicy::class, 'delete']);
    }

    public function defineGateTeamTeacher(){
        Gate::define(TeamTeachers::LIST, [TeamstudentPolicy::class, 'view']);
        Gate::define(TeamTeachers::CREATE, [TeamstudentPolicy::class, 'create']);
        Gate::define(TeamTeachers::UPDATE, [TeamstudentPolicy::class, 'update']);
        Gate::define(TeamTeachers::DELETE, [TeamstudentPolicy::class, 'delete']);
    }

    public function defineGateTeamStudent(){
        Gate::define(TeamStudents::LIST, [TeamstudentPolicy::class, 'view']);
        Gate::define(TeamStudents::CREATE, [TeamstudentPolicy::class, 'create']);
        Gate::define(TeamStudents::UPDATE, [TeamstudentPolicy::class, 'update']);
        Gate::define(TeamStudents::DELETE, [TeamstudentPolicy::class, 'delete']);
    }

    public function defineGateConfig(){
        Gate::define(Config::LIST, [ConfigPolicy::class, 'view']);
        Gate::define(Config::CREATE, [ConfigPolicy::class, 'create']);
        Gate::define(Config::UPDATE, [ConfigPolicy::class, 'update']);
        Gate::define(Config::DELETE, [ConfigPolicy::class, 'delete']);
    }
    public function defineGatePartner(){
        Gate::define(Partners::LIST, [PartnerPolicy::class, 'view']);
        Gate::define(Partners::CREATE, [PartnerPolicy::class, 'create']);
        Gate::define(Partners::UPDATE, [PartnerPolicy::class, 'update']);
        Gate::define(Partners::DELETE, [PartnerPolicy::class, 'delete']);
    }
    public function defineGateStatistNumber(){
        Gate::define(StatistNumber::LIST, [StatistNumberPolicy::class, 'view']);
        Gate::define(StatistNumber::CREATE, [StatistNumberPolicy::class, 'create']);
        Gate::define(StatistNumber::UPDATE, [StatistNumberPolicy::class, 'update']);
        Gate::define(StatistNumber::DELETE, [StatistNumberPolicy::class, 'delete']);
    }

    public function defineGateProject(){
        Gate::define(ProjectStudent::LIST, [ProjectStudentPolicy::class, 'view']);
        Gate::define(ProjectStudent::CREATE, [ProjectStudentPolicy::class, 'create']);
        Gate::define(ProjectStudent::UPDATE, [ProjectStudentPolicy::class, 'update']);
        Gate::define(ProjectStudent::DELETE, [ProjectStudentPolicy::class, 'delete']);
    }

    public function defineGateBenefit(){
        Gate::define(Benefit::LIST, [BenefitPolicy::class, 'view']);
        Gate::define(Benefit::CREATE, [BenefitPolicy::class, 'create']);
        Gate::define(Benefit::UPDATE, [BenefitPolicy::class, 'update']);
        Gate::define(Benefit::DELETE, [BenefitPolicy::class, 'delete']);
    }

    public function defineCourseCategtory(){
        Gate::define(CourseCategories::LIST, [CourseCategoryPolicy::class, 'view']);
        Gate::define(CourseCategories::CREATE, [CourseCategoryPolicy::class, 'create']);
        Gate::define(CourseCategories::UPDATE, [CourseCategoryPolicy::class, 'update']);
        Gate::define(CourseCategories::DELETE, [CourseCategoryPolicy::class, 'delete']);
    }

    public function defineCourses(){
        Gate::define(Course::LIST, [CoursePolicy::class, 'view']);
        Gate::define(Course::CREATE, [CoursePolicy::class, 'create']);
        Gate::define(Course::UPDATE, [CoursePolicy::class, 'update']);
        Gate::define(Course::DELETE, [CoursePolicy::class, 'delete']);
    }

    public function defineFeelStudents(){
        Gate::define(FeelStudent::LIST, [FeelStudentPolicy::class, 'view']);
        Gate::define(FeelStudent::CREATE, [FeelStudentPolicy::class, 'create']);
        Gate::define(FeelStudent::UPDATE, [FeelStudentPolicy::class, 'update']);
        Gate::define(FeelStudent::DELETE, [FeelStudentPolicy::class, 'delete']);
    }

    public function defineConsultation(){
        Gate::define(Consultation::LIST, [ConsultationPolicy::class, 'view']);
        Gate::define(Consultation::DELETE, [ConsultationPolicy::class, 'delete']);
    }

    public function defineOpeningSchedule(){
        Gate::define(OpeningSchedule::LIST, [OpeningSchedulePolicy::class, 'view']);
        Gate::define(OpeningSchedule::CREATE, [OpeningSchedulePolicy::class, 'create']);
        Gate::define(OpeningSchedule::UPDATE, [OpeningSchedulePolicy::class, 'update']);
        Gate::define(OpeningSchedule::DELETE, [OpeningSchedulePolicy::class, 'delete']);
    }

    public function defineGeneralSetting(){
        Gate::define(GeneralSetting::VIEW, [GeneralSettingPolicy::class, 'view']);
    }

    public function defineService(){
        Gate::define(Service::LIST, [ServicePolicy::class, 'view']);
        Gate::define(Service::CREATE, [ServicePolicy::class, 'create']);
        Gate::define(Service::UPDATE, [ServicePolicy::class, 'update']);
        Gate::define(Service::DELETE, [ServicePolicy::class, 'delete']);
    }

    public function defineGateWork(){
        Gate::define(Work::LIST, [WorkPolicy::class, 'view']);
        Gate::define(Work::CREATE, [WorkPolicy::class, 'create']);
        Gate::define(Work::UPDATE, [WorkPolicy::class, 'update']);
        Gate::define(Work::DELETE, [WorkPolicy::class, 'delete']);
    }

    public function defineGateActivityLog(){
        Gate::define(ActivityLog::VIEW, [ActivityLogPolicy::class, 'view']);
        Gate::define(ActivityLog::DELETE, [ActivityLogPolicy::class, 'delete']);
    }

    public function defineGateQuestion(){
        Gate::define(Question::LIST, [QuestionPolicy::class, 'view']);
        Gate::define(Question::CREATE, [QuestionPolicy::class, 'create']);
        Gate::define(Question::UPDATE, [QuestionPolicy::class, 'update']);
        Gate::define(Question::DELETE, [QuestionPolicy::class, 'delete']);
    }
}
