@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_course_categories';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{route('admin-home')}}"><i class="fa fa-home"> {{__('common.home')}}</i></a></li>
        <li> {{__('course_categories.list')}}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{$title}}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{route(App\Models\CourseCategories::CREATE)}}" class="btn btn-primary mr-1"><i class="fa fa-plus-square"></i> {{__('common.create')}}</a></li>
                    <li><a href="{{route(App\Models\CourseCategories::LIST)}}" class="btn btn-default" ><i class="fa fa-refresh"></i> {{__('common.reload')}}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                    </div>
                    <div>
                        {!! Form::open(array('url' => route(\App\Models\CourseCategories::LIST), 'id' => 'form-search', 'method' => 'GET', 'class' => 'd-flex')) !!}
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
                        <th class="w_30 text-center">{{__('common.stt')}}</th>
                        <th class="w_100 text-center">{!!sort_title('image',__('course_categories.image'))!!}</th>
                        <th>{!!sort_title('title',__('course_categories.title'))!!}</th>
                        <th class="w_100 text-center">{!!sort_title('order',__('common.order'))!!}</th>
                        <th class="w_100 text-center">{!!sort_title('status',__('course_categories.status'))!!}</th>
                        <th class="w_130 text-center">{{__('course_categories.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$courseCategories->isEmpty())
                            @php
                                $no = (($courseCategories->currentPage() - 1) * $courseCategories->perPage() + 1)
                            @endphp
                        @foreach($courseCategories as $key => $value)
                        <tr>
                            <td class="text-center align-middle">{{$key+1}}</td>
                            <td class="text-center align-middle"><img src="{{ $value->image_url }}" class="index-image"></td>
                            <td class="align-middle">{{$value->title}}</td>
                            <td class="align-middle text-center">{{$value->order}}</td>
                            <td class="text-center w_100 align-middle">
                                @if($value->status)
                                    <div class="form-check form-switch">
                                        <input checked {{$value->status == 1 ? '' : 'disabled'}} class="form-check-input status" type="checkbox" role="switch" id="status_{{$value->id}}" data-id="{{$value->id}}" data-status="0">
                                    </div>
                                @else
                                    <div class="form-check form-switch">
                                        <input {{$value->status != 1 ? '' : 'disabled'}} class="form-check-input status" type="checkbox" role="switch" id="status_{{$value->id}}" data-id="{{$value->id}}" data-status="1">
                                    </div>
                                @endif
                            </td>
                            <td class="action text-center w_100 align-middle">
                                <a href="{{route(\App\Models\CourseCategories::UPDATE, $value->id)}}" class="btn btn-primary" title="{{trans('common.edit')}}"><i class="fa fa-edit"></i></a>
                                <a href="javascript:;" onclick="deleteModal('{{$value->id}}', '/admin/course-categories/destroy')" title="{{trans('common.delete')}}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">{{__('common.no_data')}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="footer-table row">
                    <div class="col-sm-6 d-flex">
                        <div class="box-numpaging">
                            {!! Form::select('numpaging', App\Libs\Constants::$list_numpaging, Request::get("numpaging"),array('class' => 'form-control select', 'id' => 'selectNumpaging')) !!}
                        </div>
                        <span class="total-record ml-2">{!!__("common.total_data", ['total' => $courseCategories->total()])!!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{$courseCategories->links('vendor/pagination/bootstrap-4')}}
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
            $(".status").click(function (e) {
                var status = $(this).data('status');
                var id = $(this).data('id');
                var _url = "{{route('course_categories.active')}}";
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
    </script>
@endsection

