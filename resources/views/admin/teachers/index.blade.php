@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_teacher';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin-home') }}"><i class="fa fa-home"> {{ __('common.home') }}</i></a></li>
        <li> {{ __('teacher.list') }}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{route(App\Models\TeamTeachers::CREATE)}}" class="btn btn-primary mr-1"><i class="fa fa-plus-square"></i> {{ __('common.create') }}</a></li>
                    <li><a href="{{route(App\Models\TeamTeachers::LIST)}}" class="btn btn-default"><i class="fa fa-refresh"></i> {{ __('common.reload') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                        <a href="javascript:;" id="btn-delete-all" data-routes="/admin/teachers/destroy" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{ __('common.delete_all') }}</a>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <select name="role" id="role" class="form-control bg-white" >
                                    <option value="">{{ __('teacher.allRole') }}</option>
                                    <option {{ isset($_GET['role']) && $_GET['role'] == App\Libs\Constants::$person['teacher'] ? 'selected' : '' }} value="{{App\Libs\Constants::$person['teacher']}}">{{ __('teacher.roleTeacher') }}</option>
                                    <option {{ isset($_GET['role']) && $_GET['role'] == App\Libs\Constants::$person['mentor'] ? 'selected' : '' }} value="{{App\Libs\Constants::$person['mentor']}}">{{ __('teacher.roleMentor') }}</option>
                               </select>
                            </div>
                        </div>
                        <div class="col-6">
                            {!! Form::open([
                                'url' => route(\App\Models\TeamTeachers::LIST),
                                'id' => 'form-search',
                                'method' => 'GET',
                                'class' => 'd-flex',
                            ]) !!}
                            {!! Form::text('search', Request::get('search'), [
                                'class' => 'form-control form-inline',
                                'maxlength' => 50,
                                'id' => 'input_source',
                                'placeholder' => __('common.keyword'),
                                'autocomplete' => 'off',
                            ]) !!}
                            <button class="btn btn-primary ml-2" type="submit"><i class="fa fa-search"></i></button>
                            {!! Form::hidden('numpaging', Request::get('numpaging')) !!}
                            {!! Form::hidden('paging', Request::get('paging')) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <table class="table table-striped mt-2" id="table-main">
                    <thead>
                        <tr>
                            <th class="rowCheckAll w_30 text-center"><input type="checkbox" id="checkAll" /></th>
                            <th class="w_30">{{ __('teacher.stt') }}</th>
                            <th class="w_130 text-center">{!! sort_title('avatar', __('teacher.avatar')) !!}</th>
                            <th>{!! sort_title('fullname', __('teacher.fullname')) !!}</th>
                            <th class="w_180">{!! sort_title('role', __('teacher.role')) !!}</th>
                            <th class="w_350">{!! sort_title('profession', __('teacher.profession')) !!}</th>
                            <th class="w_100">{!!sort_title('status',__('teacher.status'))!!}</th>
                            <th class="w_100">{{ __('teacher.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$teachers->isEmpty())
                            @php
                                $no = ($teachers->currentPage() - 1) * $teachers->perPage() + 1;
                            @endphp
                            @foreach ($teachers as $key => $teacher)
                                <tr>
                                    <td class="text-center align-middle">
                                        <input type="checkbox" class="checkItem" value="{{ $teacher->id }}" />
                                    </td>
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    <td class="align-middle"><img src="{{ $teacher->avatar_urls }}" class="index-image"></td>
                                    <td class="align-middle">{{$teacher->fullname}}</td>
                                    <td class="align-middle {{$teacher->role == App\Libs\Constants::$person['mentor'] ? 'text-info' : ''  }}" >{{$teacher->role == App\Libs\Constants::$person['teacher'] ? __('teacher.roleTeacher') : __('teacher.roleMentor')}}</td>
                                    <td class="align-middle">{{$teacher->profession}}</td>
                                    <td class="text-center w_100 align-middle">
                                        @if ($teacher->status)
                                            <div class="form-check form-switch">
                                                <input checked {{ $teacher->status == 1 ? '' : 'disabled' }}
                                                    class="form-check-input status" type="checkbox" role="switch"
                                                    id="status_{{ $teacher->id }}" data-id="{{ $teacher->id }}"
                                                    data-status="0">
                                            </div>
                                        @else
                                            <div class="form-check form-switch">
                                                <input {{ $teacher->status != 1 ? '' : 'disabled' }}
                                                    class="form-check-input status" type="checkbox" role="switch"
                                                    id="status_{{ $teacher->id }}" data-id="{{ $teacher->id }}"
                                                    data-status="1">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="action align-middle text-center">
                                        <a href="{{route(\App\Models\TeamTeachers::UPDATE, $teacher->id)}}" class="btn btn-primary"
                                            title="{{ trans('common.edit') }}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:;" onclick="deleteModal('{{$teacher->id}}', '/admin/teachers/destroy')" title="{{ trans('common.delete') }}"
                                            class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">{{ __('common.no_data') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="footer-table row">
                    <div class="col-sm-6 d-flex">
                        <div class="box-numpaging">
                            {!! Form::select('numpaging', App\Libs\Constants::$list_numpaging, Request::get('numpaging'), [
                                'class' => 'form-control select',
                                'id' => 'selectNumpaging',
                            ]) !!}
                        </div>
                        <span class="total-record ml-2">{!! __('common.total_data', ['total' =>$teachers->total()]) !!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{ $teachers->links('vendor/pagination/bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('partials.numpaging')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".status").click(function (e) {
                var status = $(this).data('status');
                var id = $(this).data('id');
                var _url = "{{route('teachers.active')}}";
                $.ajax({
                    type: "post",
                    url: _url,
                    data: {id: id, status: status},
                    success: function (data, success) {
                        showNotificationActive(data.message);
                    }
                });
            })
        });
        $(document).ready(function () {
            $("#role").change(function (e) {
                var url_domain = '{{ Request::url()}}';
                var roleUrl = replaceUrlParam(url_domain, 'role', $(this).val());
                window.location.href = roleUrl;
            });
        });
    </script>
@endsection
