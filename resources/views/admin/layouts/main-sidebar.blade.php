<div class="sidebar pb-3">
    <div class="navbar-nav w-100">
    <a href="{{route('admin-home')}}" class="sign">
        SDC
    </a>
    </div>
    <nav class="navbar bg-light navbar-light">

        <div class="navbar-nav w-100 main_sidebar">
            <a href="{{route('admin-home')}}" class="nav-item nav-link" id="mn_dashboard"><i class="fa fa-tachometer me-2"></i>{{__('common.home')}}</a>
            @if(auth()->user()->can(\App\Models\User::LIST) || auth()->user()->can(\App\Models\Roles::LIST))
                <div class="nav-item dropdown treeview">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users" aria-hidden="true"></i>{{__('users.managements')}}</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        @can(\App\Models\User::LIST)
                        <a href="{{route(\App\Models\User::LIST)}}" class="dropdown-item" id="mn_users">{{__('users.list')}}</a>
                        @endcan
                        @can(\App\Models\Roles::LIST)
                        <a href="{{route(\App\Models\Roles::LIST)}}" class="dropdown-item" id="mn_roles">{{__('roles.list')}}</a>
                        @endcan
                    </div>
                </div>
            @endif
            {{-- Menus --}}
            <div class="nav-item">
                @can(\App\Models\Menus::LIST)
                    <a href="{{route(\App\Models\Menus::LIST)}}" class="nav-link" id="mn_menu"><i class="fa fa-bars" aria-hidden="true"></i>{{__('menus.management')}}</a>
                @endcan
            </div>
            {{-- Banner --}}
            <div class="nav-item">
                @can(\App\Models\Banners::LIST)
                    <a href="{{ route(\App\Models\Banners::LIST) }}" class="nav-link" id="mn_banner"><i class="fa fa-file-image-o" aria-hidden="true"></i>{{__('banners.management')}}</a>
                @endcan
            </div>
            {{-- Manager Category --}}
            @if(auth()->user()->can(\App\Models\Category::LIST) || auth()->user()->can(\App\Models\News::LIST))
            <div class="nav-item dropdown treeview">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-book" aria-hidden="true"></i> {{__('common.management_category_news')}}</a>
                    <div class="dropdown-menu bg-transparent border-0">
                    @can(\App\Models\Category::LIST)
                        <a href="{{route(\App\Models\Category::LIST)}}" class="dropdown-item" id="mn_category">{{__('category.management')}}</a>
                    @endcan
                    @can(\App\Models\News::LIST)
                        <a href="{{route(\App\Models\News::LIST)}}" class="dropdown-item" id="mn_news">{{__('news.management')}}</a>
                    @endcan
                    </div>
            </div>
            @endif
            {{--      Lịch khai giảng      --}}
            <div class="nav-item">
                @can(\App\Models\OpeningSchedule::LIST)
                    <a href="{{ route(\App\Models\OpeningSchedule::LIST) }}" class="nav-link" id="mn_opening_schedules"><i class="fa fa-calendar" aria-hidden="true"></i>{{__('opening_schedules.management')}}</a>
                @endcan
            </div>
            {{--      Danh mục khóa học      --}}
            @if(auth()->user()->can(\App\Models\CourseCategories::LIST) || auth()->user()->can(\App\Models\Course::LIST))
                <div class="nav-item dropdown treeview">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-bars" aria-hidden="true"></i>{{__('course_categories.managements')}}</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        @can(\App\Models\CourseCategories::LIST)
                            <a href="{{route(\App\Models\CourseCategories::LIST)}}" class="dropdown-item" id="mn_course_categories">{{__('course_categories.list')}}</a>
                        @endcan
                        @can(\App\Models\Course::LIST)
                            <a href="{{route(\App\Models\Course::LIST)}}" class="dropdown-item" id="mn_courses">{{__('courses.list')}}</a>
                        @endcan
                    </div>
                </div>
            @endif
            @if(auth()->user()->can(\App\Models\TeamTeachers::LIST) || auth()->user()->can(\App\Models\TeamStudents::LIST))
            <div class="nav-item dropdown treeview">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users" aria-hidden="true"></i>{{__('common.management_person')}}</a>
                    <div class="dropdown-menu bg-transparent border-0">
                    @can(\App\Models\TeamTeachers::LIST)
                        <a href="{{route(\App\Models\TeamTeachers::LIST)}}" class="dropdown-item" id="mn_teacher">{{__('teacher.management')}}</a>
                    @endcan
                    @can(\App\Models\TeamStudents::LIST)
                        <a href="{{route(\App\Models\TeamStudents::LIST)}}" class="dropdown-item" id="mn_student">{{__('student.management')}}</a>
                    @endcan
                    </div>
            </div>
            @endif
            <div class="nav-item">
                @can(\App\Models\StatistNumber::LIST)
                    <a href="{{route(\App\Models\StatistNumber::LIST)}}" class="nav-link" id="mn_statistnumber"><i class="fa fa-pie-chart" aria-hidden="true"></i>{{__('statistnumber.management')}}</a>
                @endcan
            </div>
            <div class="nav-item">
                @can(\App\Models\ProjectStudent::LIST)
                    <a href="{{route(\App\Models\ProjectStudent::LIST)}}" class="nav-link" id="mn_project-students"><i class="fa fa-cube" aria-hidden="true"></i>{{__('project_students.management')}}</a>
                @endcan
            </div>
            <div class="nav-item">
                @can(\App\Models\Benefit::LIST)
                    <a href="{{route(\App\Models\Benefit::LIST)}}" class="nav-link" id="mn_benefits"><i class="fa fa-gift" aria-hidden="true"></i>{{__('benefits.management')}}</a>
                @endcan
            </div>
            {{-- Partner --}}
            <div class="nav-item">
                @can(\App\Models\Partners::LIST)
                    <a href="{{route(\App\Models\Partners::LIST)}}" class="nav-link" id="mn_partners"><i class="fa fa-handshake-o" aria-hidden="true"></i>{{__('partners.management')}}</a>
                @endcan
            </div>
            {{-- Đăng ký tư vấn --}}
            <div class="nav-item">
                @can(\App\Models\Consultation::LIST)
                    <a href="{{route(\App\Models\Consultation::LIST)}}" class="nav-link" id="mn_consultations"><i class="fas fa-list"></i>{{__('consultations.management')}}</a>
                @endcan
            </div>
            {{-- Feel students --}}
            <div class="nav-item">
                @can(\App\Models\FeelStudent::LIST)
                    <a href="{{route(\App\Models\FeelStudent::LIST)}}" class="nav-link" id="mn_feel-students"><i class="fa fa-comments" aria-hidden="true"></i>{{__('feel_students.management')}}</a>
                @endcan
            </div>
            {{--Services--}}
            <div class="nav-item">
                @can(\App\Models\Service::LIST)
                    <a href="{{route(\App\Models\Service::LIST)}}" class="nav-link" id="mn_services"><i class="fas fa-graduation-cap"></i>{{__('services.management')}}</a>
                @endcan
            </div>
            {{-- Works --}}
            <div class="nav-item">
                @can(\App\Models\Work::LIST)
                    <a href="{{route(\App\Models\Work::LIST)}}" class="nav-link" id="mn_works"><i class="fa fa-briefcase" aria-hidden="true"></i> {{__('works.management')}}</a>
                @endcan
            </div>
            {{-- Q&A --}}
            <div class="nav-item">
                @can(\App\Models\Question::LIST)
                    <a href="{{route(\App\Models\Question::LIST)}}" class="nav-link" id="mn_questions"><i class="fa fa-question" aria-hidden="true"></i> {{__('questions.management')}}</a>
                @endcan
            </div>
            {{-- Activity Logs --}}
            <div class="nav-item">
                @can(\App\Models\ActivityLog::VIEW)
                    <a href="{{route(\App\Models\ActivityLog::VIEW)}}" class="nav-link" id="mn_activity_logs"><i class="fa fa-sticky-note" aria-hidden="true"></i> {{__('activity_logs.management')}}</a>
                @endcan
            </div>
            {{-- Config --}}
            <div class="nav-item">
                @can(\App\Models\Config::LIST)
                    <a href="{{route(\App\Models\Config::LIST)}}" class="nav-link" id="mn_config"><i class="fa fa-cog" aria-hidden="true"></i>{{__('config.management')}}</a>
                @endcan
            </div>
            {{-- General Settings --}}
            <div class="nav-item">
                @can(\App\Models\GeneralSetting::VIEW)
                    <a href="{{route(\App\Models\GeneralSetting::VIEW)}}" class="nav-link" id="mn_general_settings"><i class="fas fa-gears"></i></i>{{__('general_settings.management')}}</a>
                @endcan
            </div>
        </div>
    </nav>
</div>
