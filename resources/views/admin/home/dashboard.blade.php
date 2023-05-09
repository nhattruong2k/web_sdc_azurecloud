@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="javascript:;"><i class="fa fa-home"></i> {{$title}}</a></li>
    </ol>
    <script type="text/javascript">
        mn_selected = 'mn_dashboard';
    </script>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="group_view">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-users fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">{{ trans('common.users') }}</p>
                            <h6 class="mb-0">{{ $count_users }}</h6>
                        </div>
                    </div>
                    <a href="{{ route(\App\Models\User::LIST) }}">{{ trans('common.see_more') }} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="group_view">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-newspaper fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">{{ trans('common.news') }}</p>
                            <h6 class="mb-0">{{ $count_news }}</h6>
                        </div>
                    </div>
                    <a href="{{ route(\App\Models\News::LIST) }}">{{ trans('common.see_more') }} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="group_view">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-stumbleupon fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">{{ trans('common.courses') }}</p>
                            <h6 class="mb-0">{{ $count_courses }}</h6>
                        </div>
                    </div>
                    <a href="{{ route(\App\Models\Course::LIST) }}">{{ trans('common.see_more') }} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="group_view">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-handshake fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">{{ trans('common.partners') }}</p>
                            <h6 class="mb-0">{{ $count_partners }}</h6>
                        </div>
                    </div>
                    <a href="{{ route(\App\Models\Partners::LIST) }}">{{ trans('common.see_more') }} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="group_view">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-comments fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">{{ trans('common.consultations') }}</p>
                            <h6 class="mb-0">{{ $consultations }}</h6>
                        </div>
                    </div>
                    <a href="{{ route(\App\Models\Consultation::LIST) }}">{{ trans('common.see_more') }} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@stop
