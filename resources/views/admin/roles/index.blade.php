@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_roles';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{__('common.home')}}</a></li>
        <li>{{__('roles.list')}}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{$title}}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{route(\App\Models\Roles::CREATE)}}" class="btn btn-primary mr-1"><i class="fa fa-plus-square"></i> {{__('common.create')}}</a></li>
                    <li><a href="{{route(\App\Models\Roles::LIST)}}" class="btn btn-default" ><i class="fa fa-refresh"></i> {{__('common.reload')}}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                        <a href="javascript:;" id="btn-delete-all" data-routes="/admin/roles/destroy" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{__('common.delete_all')}}</a>
                    </div>
                    <div>
                        {!! Form::open(array('url' => route(\App\Models\Roles::LIST), 'id' => 'form-search', 'method' => 'GET', 'class' => 'd-flex')) !!}
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
                                <th class="rowCheckAll w_30 text-center"><input type="checkbox" id="checkAll" /></th>
                                <th class="w_30">{{__('common.stt')}}</th>
                                <th>{!!sort_title('name',__('common.role'))!!}</th>
                                <th class="text-center">{!!sort_title('is_visible',__('common.status'))!!}</th>
                                <th class="w_130 text-center">{{__('common.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$roles->isEmpty())
                                @php
                                    $no = (($roles->currentPage() - 1) * $roles->perPage() + 1)
                                @endphp
                                @foreach($roles as $key => $role)
                                    <tr>
                                        <td class="text-center ">
                                            @if($role->id != \Auth::user()->id && $role->role != \App\Libs\Constants::$administrator)
                                                <input type="checkbox" class="checkItem" value="{{$role->id}}" />
                                            @endif
                                        </td>
                                        <td class="text-center">{{$no++}}</td>
                                        <td>{{$role->name}}</td>
                                        <td class="text-center w_100">
                                            @if($role->is_visible)
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input is_visible" type="checkbox" role="switch" id="is_visible_{{$role->id}}" data-id="{{$role->id}}" data-visible="{{$role->is_visible}}" checked {{($role->id != \Auth::user()->id && $role->role != \App\Libs\Constants::$administrator) ? '' : 'disabled'}}>
                                                </div>
                                            @else
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input is_visible" type="checkbox" role="switch" id="is_visible_{{$role->id}}" data-id="{{$role->id}}" data-visible="{{$role->is_visible}}" {{($role->id != \Auth::user()->id && $role->role != \App\Libs\Constants::$administrator) ? '' : 'disabled'}}>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="action text-center">
                                            <a href="{{route(\App\Models\Roles::UPDATE, $role->id)}}" class="btn btn-primary" title="{{trans('common.edit')}}"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:;" onclick="deleteModal('{{$role->id}}', '/admin/roles/destroy')" title="{{trans('common.delete')}}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
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
                        <span class="total-record ml-2">{!!__("common.total_data", ['total' => $roles->total()])!!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{$roles->links('vendor/pagination/bootstrap-4')}}
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
                    url: root + '/admin/roles/active',
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


