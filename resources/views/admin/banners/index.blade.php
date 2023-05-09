@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_banner';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{__('common.home')}}</a></li>
        <li>{{__('banners.list')}}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{$title}}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{ route(\App\Models\Banners::CREATE) }}" class="btn btn-primary mr-1"><i class="fa fa-plus-square"></i> {{__('common.create')}}</a></li>
                    <li><a href="{{route(\App\Models\Banners::LIST)}}" class="btn btn-default" ><i class="fa fa-refresh"></i> {{__('common.reload')}}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                    </div>
                    <div>
                        {!! Form::open(array('url' => route(\App\Models\Banners::LIST), 'id' => 'form-search', 'method' => 'GET', 'class' => 'd-flex')) !!}
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
                        <th class="text-center w_100">{!!sort_title('link',__('banners.link'))!!}</th>
                        <th>{!!sort_title('title',__('banners.title'))!!}</th>
                        <th>{!!sort_title('status',__('banners.status'))!!}</th>
                        <th class="w_130">{{__('common.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$banners->isEmpty())
                        @php
                            $no = (($banners->currentPage() - 1) * $banners->perPage() + 1)
                        @endphp
                        @foreach($banners as $key => $banner)

                            <tr>
                                <td class="text-center align-middle">{{$no++}}</td>
                                <td class="columnImage align-middle">
                                    <img src="{{ $banner->link_url }}" alt="">
                                </td>
                                <td class="align-middle">{!! Str::limit($banner->title, 85, '...') !!}</td>
                                <td class="text-center w_100 align-middle">
                                    @if($banner->status)
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status" type="checkbox" role="switch" id="status_{{$banner->id}}" data-id="{{$banner->id}}" data-status="{{$banner->status}}" checked>
                                        </div>
                                    @else
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status" type="checkbox" role="switch" id="status_{{$banner->id}}" data-id="{{$banner->id}}" data-status="{{$banner->status}}">
                                        </div>
                                    @endif
                                </td>
                                <td class="action text-center align-middle">
                                    <a href="{{ route(\App\Models\Banners::UPDATE, $banner->id) }}" class="btn btn-primary" title="{{trans('common.edit')}}"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:;" onclick="deleteModal('{{ $banner->id }}', '/admin/banners/destroy')" title="{{trans('common.delete')}}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>

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
                        <span class="total-record ml-2">{!!__("common.total_data", ['total' => $banners->total()])!!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{$banners->links('vendor/pagination/bootstrap-4')}}
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
                let status = $(this).data('status');
                let id = $(this).data('id');
                let _url = root + '/admin/banners/active';
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function (data, success) {
                        showNotificationActive(data.message);
                    }
                });
            })
        });
    </script>
@endsection


