@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_consultations';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin-home') }}"><i class="fa fa-home"></i> {{ __('common.home') }}</a></li>
        <li>{{ __('consultations.list') }}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li class="mr-2"><a href="{{ route(\App\Models\Consultation::LIST) }}" class="btn btn-default"><i
                                class="fa fa-refresh"></i> {{ __('common.reload') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                        <div class="d-inline-flex">
                            <a href="javascript:;" id="btn-delete-all" data-routes="/admin/consultations/destroy"
                                class="btn btn-danger"><i class="fa fa-trash-o"></i> {{ __('common.delete_all') }}</a>
                            <a id="export" class="btn btn-primary mr-3 ml-3"><i class="fa fa-file-excel-o"
                                    aria-hidden="true"></i> {{ __('common.excel') }}</a>
                            <form action="{{ route('consultations.export') }}" method="POST" id="form-export">
                                @csrf
                                <input type="text" name="fromDate"
                                    value="{{ isset($_GET['fromDate']) ? $_GET['fromDate'] : ' ' }}"
                                    class="form-control form-inline d-none" maxlength="100" id="exportFrom"
                                    autocomplete="off" placeholder="dd-mm-yy">
                                <input type="text" name="toDate"
                                    value="{{ isset($_GET['toDate']) ? $_GET['toDate'] : ' ' }}"
                                    class="form-control form-inline d-none" maxlength="100" id="exportTo"
                                    autocomplete="off" placeholder="dd-mm-yy">
                                <input type="text" name="course"
                                    value="{{ isset($_GET['course_id']) ? $_GET['course_id'] : ' ' }}"
                                    class="form-control form-inline d-none" maxlength="100" id="exportCourse"
                                    autocomplete="off">
                                {!! Form::text('search', Request::get('search'), [
                                    'class' => 'form-control form-inline d-none',
                                    'maxlength' => 50,
                                    'id' => 'input_source',
                                    'placeholder' => __('common.keyword'),
                                    'autocomplete' => 'off',
                                ]) !!}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-search-consulTable pull-right d-flex justify-content-between mt-3 searchConsultation">
                {!! Form::open([
                    'url' => route(\App\Models\Consultation::LIST),
                    'id' => 'form-search',
                    'method' => 'GET',
                    'class' => 'd-flex',
                ]) !!}
                <div class="select_course">
                    <select name="course_id" id="course"
                        class="form-control bg-white search-selecte-category select_course">
                        <option value="">{{ __('consultations.course') }}</option>
                        @foreach ($courses as $course)
                            <option {{ isset($_GET['course_id']) && $_GET['course_id'] == $course->id ? 'selected' : ' ' }}
                                value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
                <label for="" class="control-label label_consulDate">{{ __('consultations.FromCreated') }}</label>
                <input type="text" name="fromDate" value="{{ isset($_GET['fromDate']) ? $_GET['fromDate'] : '' }}"
                    class="form-control bg-white text-dark form-inline" readonly maxlength="100" id="fromDate"
                    autocomplete="off" placeholder="dd-mm-yyyy">
                <label for="" class="control-label label_consulDate">{{ __('consultations.ToCreated') }}</label>
                <input type="text" name="toDate" value="{{ isset($_GET['toDate']) ? $_GET['toDate'] : '' }}"
                    class="form-control bg-white text-dark form-inline" readonly maxlength="100" id="toDate"
                    autocomplete="off" placeholder="dd-mm-yyyy">
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
            <table class="table table-striped mt-2" id="table-main">
                <thead>
                    <tr>
                        <th class="rowCheckAll w_30 text-center"><input type="checkbox" id="checkAll" /></th>
                        <th class="w_30">{{ __('common.stt') }}</th>
                        <th>{!! sort_title('course_id', __('consultations.course')) !!}</th>
                        <th class="col_name">{!! sort_title('name', __('consultations.name')) !!}</th>
                        <th>{!! sort_title('email', __('consultations.email')) !!}</th>
                        <th class="col_phone">{!! sort_title('phone', __('consultations.phone')) !!}</th>
                        <th class="col_created">{!! sort_title('phone', __('consultations.created')) !!}</th>
                        <th class="col_contact">{!! sort_title('contact', __('consultations.status')) !!}</th>
                        <th class="w_100">{{ __('common.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$consultations->isEmpty())
                        @php
                            $no = ($consultations->currentPage() - 1) * $consultations->perPage() + 1;
                        @endphp
                        @foreach ($consultations as $key => $value)
                            <tr>
                                <td class="text-center ">
                                    <input type="checkbox" class="checkItem" value="{{ $value->id }}" />
                                </td>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ isset($value->course->title) ? $value->course->title : '' }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                <td class="text-center" id="status">
                                    <a href="" data-status={{ $value->status }} data-toggle="modal"
                                        title="{{ $value->status == 0 ? __('consultations.notContact') : ($value->status == 1 ? __('consultations.contacted') : __('consultations.contactAgain')) }}"
                                        class="col_status btn btn-{{ $value->status == 0 ? 'primary' : ($value->status == 1 ? 'success' : 'warning text-light') }} register_id"
                                        data-id="{{ $value->id }}"
                                        data-target="#Status_{{ $value->id }}">{{ $value->status == 0 ? __('consultations.notContact') : ($value->status == 1 ? __('consultations.contacted') : __('consultations.contactAgain')) }}</a>
                                </td>
                                <td class="action text-center">
                                    <a href="javascript:;" title="{{ trans('common.view') }}" class="btn btn-primary mr-2"
                                        data-toggle="modal" data-target="#View_{{ $value->id }}"><i class="fa fa-eye"
                                            aria-hidden="true"></i>
                                    </a>
                                    <a href="javascript:;"
                                        onclick="deleteModal('{{ $value->id }}', '/admin/consultations/destroy')"
                                        title="{{ trans('common.delete') }}" class="btn btn-danger"><i
                                            class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @include('admin.consultations.consultationViewModal', ['value' => $value])
                            @include('admin.consultations.consultationModal', ['value' => $value])
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">{{ __('common.no_data') }}</td>
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
                    <span class="total-record ml-2">{!! __('common.total_data', ['total' => $consultations->total()]) !!}</span>
                </div>
                <div class="col-sm-6">
                    <div class="pull-right">
                        {{ $consultations->links('vendor/pagination/bootstrap-4') }}
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
    @include('partials.numpaging')
    @include('partials._datepicker')
    <script>
        $('#export').click(function() {
            $('#form-export').submit();
        });
        $('#course').change(function(e) {
            var url_domain = '{{ Request::url() }}';
            var keyword = '{{ Request::get('search') }}' ?? "";
            var fromDate = '{{ Request::get('fromDate') }}' ?? "";
            var toDate = '{{ Request::get('toDate') }}' ?? "";
            location.href = '?course_id='+$(this).val()+'&fromDate=' + fromDate + '&toDate=' + toDate + '&search=' + keyword;
        });
        $(function() {
            $("#fromDate").datepicker({
                format: "dd-mm-yyyy",
                todayBtn: 1,
                autoclose: true,
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#toDate').datepicker('setStartDate', minDate);
                $('#toDate').datepicker('setDate', minDate);
            });

            $("#toDate").datepicker({
                    format: "dd-mm-yyyy",
                })
                .on('changeDate', function(selected) {
                    var maxDate = new Date(selected.date.valueOf());
                    $('#fromDate').datepicker('setEndDate', maxDate);
                });
        })
        $(document).ready(function() {
            $('.search-selecte-category').select2({
                placeholder: "{{ __('consultations.course') }}",
            });
        });
    </script>
    @yield('script_modal');
@endsection
