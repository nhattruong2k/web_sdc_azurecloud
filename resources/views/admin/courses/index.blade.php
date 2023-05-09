@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_courses';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin-home') }}"><i class="fa fa-home"></i> {{ __('common.home') }}</a></li>
        <li>{{ __('courses.list') }}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{ route(\App\Models\Course::CREATE) }}" class="btn btn-primary mr-1"><i
                                class="fa fa-plus-square"></i> {{ __('common.create') }}</a></li>
                    <li><a href="{{ route(\App\Models\Course::LIST) }}" class="btn btn-default"><i
                                class="fa fa-refresh"></i> {{ __('common.reload') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                        {{--                        <a href="javascript:;" id="btn-delete-all" data-routes="/admin/roles/destroy" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{__('common.delete_all')}}</a> --}}
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="select_course">
                                <select name="category_course" id="category_course" class="form-control search-selecte-category bg-white">
                                    <option value="">{{__('common.choose')}}</option>
                                    @foreach($category_course as $category)
                                        <option {{ isset($_GET['category_course_id']) && $_GET['category_course_id'] == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                {!! Form::open(array('url' => route(\App\Models\Course::LIST), 'id' => 'form-search', 'method' => 'GET', 'class' => 'd-flex')) !!}
                                {!! Form::text('search', Request::get('search'), array('class' => 'form-control form-inline', 'maxlength' => 50, 'id' => 'input_source', 'placeholder' => __('common.keyword'), 'autocomplete' => 'off')) !!}
                                <button class="btn btn-primary ml-2" type="submit"><i class="fa fa-search"></i></button>
                                {!!Form::hidden("numpaging", Request::get('numpaging'))!!}
                                {!!Form::hidden("paging", Request::get('paging'))!!}
                                {!!Form::hidden("category_course_id", Request::get('category_course_id'))!!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped mt-2" id="table-main">
                    <thead>
                        <tr>
                            <th class="w_30">{{ __('common.stt') }}</th>
                            <th class="w_100 text-center">{!! __('courses.image') !!}</th>
                            <th>{!! sort_title('title', __('courses.title')) !!}</th>
                            <th class="w_200">{!! sort_title('category', __('courses.category')) !!}</th>
                            <th class="w_200">{!! sort_title('time', __('courses.time')) !!}</th>
                            <th class="w_100">{!! sort_title('is_visible', __('common.status')) !!}</th>
                            <th class="w_130">{{ __('common.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$courses->isEmpty())
                            @php
                                $no = ($courses->currentPage() - 1) * $courses->perPage() + 1;
                            @endphp
                            @foreach ($courses as $key => $value)
                                <tr>
                                    <td class="text-center align-middle">{{ $no++ }}</td>
                                    <td class="w_100 text-center"><img src="{{ $value->image_url }}" width="100%"
                                            height="60px"></td>
                                    <td class="align-middle">{{ \Illuminate\Support\Str::limit($value->title) }}</td>
                                    <td class="align-middle">{{ $value->course_categories->title }}</td>
                                    <td class="align-middle">{{ $value->time }}</td>
                                    <td class="text-center w_100 align-middle">
                                        @if ($value->status)
                                            <div class="form-check form-switch">
                                                <input class="form-check-input is_visible" type="checkbox" role="switch"
                                                    id="is_visible_{{ $value->id }}" data-id="{{ $value->id }}"
                                                    data-visible="{{ $value->is_visible }}" checked>
                                            </div>
                                        @else
                                            <div class="form-check form-switch">
                                                <input class="form-check-input is_visible" type="checkbox" role="switch"
                                                    id="is_visible_{{ $value->id }}" data-id="{{ $value->id }}"
                                                    data-visible="{{ $value->is_visible }}">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="action align-middle text-center">
                                        <a href="{{ route(\App\Models\Course::UPDATE, $value->id) }}"
                                            class="btn btn-primary" title="{{ trans('common.edit') }}"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="javascript:;"
                                            onclick="deleteModal('{{ $value->id }}', '/admin/courses/destroy')"
                                            title="{{ trans('common.delete') }}" class="btn btn-danger"><i
                                                class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">{{ __('common.no_data') }}</td>
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
                        <span class="total-record ml-2">{!! __('common.total_data', ['total' => $courses->total()]) !!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{ $courses->links('vendor/pagination/bootstrap-4') }}
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
        $(document).ready(function() {
            $("#category_course").change(function(e) {
                var search_keyWord = '{{Request::get('search')}}' ?? '';
                location.href = '?search=' +search_keyWord+ '&category_course=' + $(this).val();
            });
        });
        $(document).ready(function() {
            $('.search-selecte-category').select2({
                placeholder: "{{ __('common.choose') }}",
            });
            $('#category_course').change(function(){
                var url_domain = '{{ Request::url()}}';
                var keyword = '{{ Request::get("search") }}' ?? "";
                location.href ='?search=' +keyword+ '&category_course_id=' + $(this).val();
            });
        });
        $(document).ready(function() {
            $(".is_visible").click(function(e) {
                let is_visible = $(this).data('visible');
                let id = $(this).data('id');
                var _url = "{{ route('courses.active') }}";
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: {
                        id: id,
                        is_visible: is_visible
                    },
                    success: function(data, success) {
                        showNotificationActive(data.message);
                    }
                });
            })
        });
    </script>
@endsection
