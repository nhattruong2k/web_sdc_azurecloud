@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_news';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin-home') }}"><i class="fa fa-home"> {{ __('common.home') }}</i></a></li>
        <li> {{ __('news.list') }}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{ route(App\Models\News::CREATE) }}" class="btn btn-primary mr-1"><i class="fa fa-plus-square"></i> {{ __('common.create') }}</a></li>
                    <li><a href="{{ route(App\Models\News::LIST) }}" class="btn btn-default"><i class="fa fa-refresh"></i> {{ __('common.reload') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                        <a href="javascript:;" id="btn-delete-all" data-routes="/admin/news/destroy"
                            class="btn btn-danger"><i class="fa fa-trash-o"></i> {{ __('common.delete_all') }}</a>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <select  name="category_id" id="category" class="form-control search-selecte-category" required>
                                    <option value="">{{__('news.category')}}</option>
                                    @php
                                        echo $parent;
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                {!! Form::open([
                                    'url' => route(\App\Models\News::LIST),
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
                                {!! Form::hidden('category_id', Request::get('category_id')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped mt-2" id="table-main">
                    <thead>
                        <tr>
                            <th class="rowCheckAll w_30 text-center"><input type="checkbox" id="checkAll" /></th>
                            <th class="w_30 text-center">{{ __('news.stt') }}</th>
                            <th class="w_100 text-center">{!! sort_title('image', __('news.image')) !!}</th>
                            <th>{!! sort_title('title', __('news.title')) !!}</th>
                            <th class="w_300">{!! sort_title('summary', __('news.summary')) !!}</th>
                            <th>{!!sort_title('status',__('news.status'))!!}</th>
                            <th class="w_100">{{ __('news.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$news->isEmpty())
                            @php
                                $no = ($news->currentPage() - 1) * $news->perPage() + 1;
                            @endphp
                            @foreach ($news as $key => $new)
                                <tr>
                                    <td class="text-center align-middle">
                                        <input type="checkbox" class="checkItem" value="{{ $new->id }}" />
                                    </td>
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    <td class="align-middle"><img src="{{ $new->image_urls }}" class="index-image"></td>
                                    <td class="align-middle">{{ $new->title }}
                                        @if ($new->feature == 1)
                                            <label for=""><i class="fa fa-star text-warning" aria-hidden="true"
                                                    data-toggle="tooltip" data-placement="top" title="Nổi bật"></i></label>
                                        @endif
                                    </td>
                                    <td class="align-middle">{!! Str::limit($new->summary, 50, '...') !!}</td>
                                    <td class="text-center w_100 align-middle">
                                            @if ($new->status)
                                                <div class="form-check form-switch">
                                                    <input checked {{ $new->status == 1 ? '' : 'disabled' }}
                                                        class="form-check-input status" type="checkbox" role="switch"
                                                        id="status_{{ $new->id }}" data-id="{{ $new->id }}"
                                                        data-status="0">
                                                </div>
                                            @else
                                                <div class="form-check form-switch">
                                                    <input {{ $new->status != 1 ? '' : 'disabled' }}
                                                        class="form-check-input status" type="checkbox" role="switch"
                                                        id="status_{{ $new->id }}" data-id="{{ $new->id }}"
                                                        data-status="1">
                                                </div>
                                            @endif
                                    </td>
                                    <td class="action align-middle text-center">
                                                <a href="{{ route(\App\Models\News::UPDATE, $new->id) }}"
                                                    class="btn btn-primary" title="{{ trans('common.edit') }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="javascript:;"
                                                    onclick="deleteModal('{{ $new->id }}','/admin/news/destroy')"
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
                        <span class="total-record ml-2">{!! __('common.total_data', ['total' => $news->total()]) !!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{ $news->links('vendor/pagination/bootstrap-4') }}
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
            $(".status").click(function(e) {
                var status = $(this).data('status');
                var id = $(this).data('id');
                var _url = "{{ route('active') }}";
                $.ajax({
                    type: "post",
                    url: _url,
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(data, success) {
                        showNotificationActive(data.message);
                    }
                });
            })
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        
        $(document).ready(function () {
            $("#category").change(function (e) {
                var url_domain = '{{ Request::url()}}';
                var keyword = '{{ Request::get("search") }}' ?? "";
                location.href ='?search=' +keyword+ '&category_id=' + $(this).val();
            });
        });
        $(document).ready(function(){
            $('.search-selecte-category').select2({
                placeholder: "{{ __('news.category') }}",
                closeOnSelect: false
            });
        });
    </script>
@endsection
