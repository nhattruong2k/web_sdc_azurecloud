@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_users';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{__('common.home')}}</a></li>
        <li>{{__('users.list')}}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{$title}}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{route(\App\Models\User::CREATE)}}" class="btn btn-primary mr-1"><i class="fa fa-plus-square"></i> {{__('common.create')}}</a></li>
                    <li><a href="{{route(\App\Models\User::LIST)}}" class="btn btn-default" ><i class="fa fa-refresh"></i> {{__('common.reload')}}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
{{--                        <a href="javascript:;" id="btn-delete-all" data-routes="/admin/users/destroy" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{__('common.delete_all')}}</a>--}}
                    </div>
                    <div>
                        {!! Form::open(array('url' => route(\App\Models\User::LIST), 'id' => 'form-search', 'method' => 'GET', 'class' => 'd-flex')) !!}
                        {!! Form::text('search', Request::get('search'), array('class' => 'form-control form-inline', 'maxlength' => 50, 'id' => 'input_source', 'placeholder' => __('common.keyword'), 'autocomplete' => 'off')) !!}
                        <button class="btn btn-primary ml-2" type="submit"><i class="fa fa-search"></i></button>
                        {!!Form::hidden("numpaging", Request::get('numpaging'))!!}
                        {!!Form::hidden("paging", Request::get('paging'))!!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <table class="table table-striped mt-2" id="table-main">
                    <thead>
                    <tr>
                        <th class="w_30">{{__('common.stt')}}</th>
                        <th class="w_130 text-center">{!!__('users.avatar')!!}</th>
                        <th>{!!sort_title('name',__('users.name'))!!}</th>
                        <th>{!!sort_title('email',__('users.email'))!!}</th>
                        <th>{!!sort_title('phone',__('users.phone'))!!}</th>
                        <th class="text-center">{!!sort_title('is_visible',__('common.status'))!!}</th>
                        <th class="w_130 text-center">{{__('common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$users->isEmpty())
                        @php
                            $no = (($users->currentPage() - 1) * $users->perPage() + 1)
                        @endphp
                        @foreach($users as $key => $user)
                            <tr>
                                <td class="text-center align-middle">{{$no++}}</td>
                                <td><img src="{{$user->avatar_url}}" width="100%" height="80" alt=""></td>
                                <td class="align-middle">{{$user->name}}</td>
                                <td class="align-middle">{{$user->email}}</td>
                                <td class="align-middle">{{$user->phone}}</td>
                                <td class="text-center w_100 align-middle">
                                    @if($user->is_visible)
                                        <div class="form-check form-switch">
                                            <input class="form-check-input is_visible" type="checkbox" role="switch" id="is_visible_{{$user->id}}" data-id="{{$user->id}}" data-visible="{{$user->is_visible}}" checked {{($user->id != \Auth::user()->id && $user->role != \App\Libs\Constants::$administrator) ? '' : 'disabled'}}>
                                        </div>
                                    @else
                                        <div class="form-check form-switch">
                                            <input class="form-check-input is_visible" type="checkbox" role="switch" id="is_visible_{{$user->id}}" data-id="{{$user->id}}" data-visible="{{$user->is_visible}}" {{($user->id != \Auth::user()->id && $user->role != \App\Libs\Constants::$administrator) ? '' : 'disabled'}}>
                                        </div>
                                    @endif
                                </td>
                                <td class="action text-center align-middle">
                                    @if($user->id != \Auth::user()->id && $user->role != \App\Libs\Constants::$administrator)
                                        <a href="{{route('userPermission', $user->id)}}" class="btn btn-primary" title="{{trans('common.permission')}}"><i class="fa fa-lock"></i></a>
                                        <a href="{{route(\App\Models\User::UPDATE, $user->id)}}" class="btn btn-primary" title="{{trans('common.edit')}}"><i class="fa fa-edit"></i></a>
                                        @if(auth()->user()->role == \App\Libs\Constants::$administrator)
                                            <a href="{{route('user.change_pass', $user->id)}}" class="btn btn-primary" title="{{trans('users.change_password')}}"><i class="fa fa-key"></i></a>
                                        @endif
                                        <a href="javascript:;" onclick="deleteModal('{{$user->id}}', '/admin/users/destroy')" title="{{trans('common.delete')}}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">{{__('common.no_data')}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="footer-table row">
                    <div class="col-sm-6 d-flex">
                        <div class="box-numpaging">
                            {!! Form::select('numpaging', App\Libs\Constants::$list_numpaging, Request::get("numpaging"),array('class' => 'form-control select', 'id' => 'selectNumpaging')) !!}
                        </div>
                        <span class="total-record ml-2">{!!__("common.total_data", ['total' => $users->total()])!!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{$users->links('vendor/pagination/bootstrap-4')}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include("partials.numpaging")
    <script type="text/javascript">
        $(document).ready(function () {
            $(".is_visible").click(function (e) {
                let is_visible = $(this).data('visible');
                let id = $(this).data('id');
                $.ajax({
                    url: root + '/admin/users/active',
                    type: 'POST',
                    data: {id: id, is_visible: is_visible},
                    success: function (data, success) {
                        showNotificationActive(data.message);
                    }
                });
            })
        });
    </script>
@endsection


