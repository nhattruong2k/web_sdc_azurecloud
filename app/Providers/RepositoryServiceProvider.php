<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\StatistNumbersRepository::class, \App\Repositories\Eloquents\StatistNumbersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\StudentsRepository::class, \App\Repositories\Eloquents\StudentsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\TeachersRepository::class, \App\Repositories\Eloquents\TeachersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CategoryRepository::class, \App\Repositories\Eloquents\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\NewsRepository::class, \App\Repositories\Eloquents\NewsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\UsersRepository::class, \App\Repositories\Eloquents\UsersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\RolesRepository::class, \App\Repositories\Eloquents\RolesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\UserRoleRepository::class, \App\Repositories\Eloquents\UserRoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PermissionsRepository::class, \App\Repositories\Eloquents\PermissionsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\BannersRepository::class, \App\Repositories\Eloquents\BannersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\MenusRepository::class, \App\Repositories\Eloquents\MenusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ConfigRepository::class, \App\Repositories\Eloquents\ConfigRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PartnersRepository::class, \App\Repositories\Eloquents\PartnersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ProjectStudentsRepository::class, \App\Repositories\Eloquents\ProjectStudentsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\BenefitsRepository::class, \App\Repositories\Eloquents\BenefitsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CourseCategoriesRepository::class, \App\Repositories\Eloquents\CourseCategoriesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CourseRepository::class, \App\Repositories\Eloquents\CourseRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\FeelStudentsRepository::class, \App\Repositories\Eloquents\FeelStudentsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ConsultationRepository::class, \App\Repositories\Eloquents\ConsultationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\OpeningScheduleRepository::class, \App\Repositories\Eloquents\OpeningScheduleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\GeneralSettingRepository::class, \App\Repositories\Eloquents\GeneralSettingRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ListExamsRepository::class, \App\Repositories\Eloquents\ListExamsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ServiceRepository::class, \App\Repositories\Eloquents\ServiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\WorksRepository::class, \App\Repositories\Eloquents\WorksRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ActivityLogRepository::class, \App\Repositories\Eloquents\ActivityLogRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\QuestionRepository::class, \App\Repositories\Eloquents\QuestionRepositoryEloquent::class);
        //:end-bindings:
    }
}
