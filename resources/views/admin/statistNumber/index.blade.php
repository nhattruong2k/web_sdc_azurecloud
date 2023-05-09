@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_statistnumber';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin-home') }}"><i class="fa fa-home"> {{ __('common.home') }}</i></a></li>
        <li> {{ __('statistnumber.list') }}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{route(App\Models\StatistNumber::CREATE)}}" class="btn btn-primary mr-1"><i
                                class="fa fa-plus-square"></i> {{ __('common.create') }}</a></li>
                    <li><a href="{{route(App\Models\StatistNumber::LIST)}}" class="btn btn-default"><i class="fa fa-refresh"></i>
                            {{ __('common.reload') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                        <a href="javascript:;" id="btn-delete-all" data-routes="/admin/statistNumbers/destroy" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{ __('common.delete_all') }}</a>
                    </div>
                    <div>
                        {!! Form::open([
                            'url' => route(\App\Models\StatistNumber::LIST),
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
                <table class="table table-striped mt-2" id="table-main">
                    <thead>
                        <tr>
                            <th class="rowCheckAll w_30 text-center"><input type="checkbox" id="checkAll" /></th>
                            <th class="w_30">{{ __('student.stt') }}</th>
                            <th class="w_100 text-center">{!! sort_title('icon', __('statistnumber.icon')) !!}</th>
                            <th>{!! sort_title('title', __('statistnumber.title')) !!}</th>
                            <th class="w_140">{!! sort_title('figures', __('statistnumber.figures')) !!}</th>
                            <th class="w_100">{!! sort_title('status', __('statistnumber.status')) !!}</th>
                            <th class="w_100">{{ __('statistnumber.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$numbers->isEmpty())
                            @php
                                $no = ($numbers->currentPage() - 1) * $numbers->perPage() + 1;
                            @endphp
                            @foreach ($numbers as $key => $number)
                                <tr>
                                    <td class="text-center align-middle">
                                        <input type="checkbox" class="checkItem" value="{{ $number->id }}" />
                                    </td>
                                    <td class="text-center align-middle">{{$key + 1}}</td>
                                    <td class="align-middle"><img src="{{ $number->icon_urls }}" class="index-image"></td>
                                    <td class="align-middle">{{$number->title}}</td>
                                    <td class="align-middle">{{$number->figures}}</td>
                                    <td class="text-center w_30 align-middle">
                                        @if($number->status)
                                            <div class="form-check form-switch">
                                                <input checked {{$number->status == 1 ? '' : 'disabled'}} class="form-check-input status" type="checkbox" role="switch" id="status_{{$number->id}}" data-id="{{$number->id}}" data-status="0">
                                            </div>
                                        @else
                                            <div class="form-check form-switch">
                                                <input {{$number->status != 1 ? '' : 'disabled'}} class="form-check-input status" type="checkbox" role="switch" id="status_{{$number->id}}" data-id="{{$number->id}}" data-status="1">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="action align-middle text-center">
                                            <div class="col-9">
                                                <a href="{{route(\App\Models\StatistNumber::UPDATE, $number->id)}}" class="btn btn-primary"
                                                    title="{{ trans('common.edit') }}"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:;" onclick="deleteModal('{{$number->id}}', '/admin/statistNumbers/destroy')" title="{{ trans('common.delete') }}"
                                                    class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">{{ __('common.no_data') }}</td>
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
                        <span class="total-record ml-2">{!! __('common.total_data', ['total' =>$numbers->total()]) !!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{ $numbers->links('vendor/pagination/bootstrap-4') }}
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
                var _url = "{{route('statistNumber.active')}}";
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
