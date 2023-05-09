<nav class="navbar navbar-expand bg-header navbar-light sticky-top px-4 py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2 avatar" src="{{auth()->user()->avatar_url}}" alt="">
                <span class="d-none d-lg-inline-flex">{{auth()->user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="{{route('updateProfile')}}" class="dropdown-item">{{__('users.profile')}}</a>
                <a href="{{route('changePassword')}}" class="dropdown-item">{{__('users.change_password')}}</a>
                <a href="{{route('admin.logout')}}" class="dropdown-item">{{__('users.logout')}}</a>
            </div>
        </div>
    </div>
</nav>
