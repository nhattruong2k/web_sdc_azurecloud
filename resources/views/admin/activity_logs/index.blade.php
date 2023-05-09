@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <script type="text/javascript">
        mn_selected = 'mn_activity_logs';
    </script>
    <ol class="breadcrumb">
        <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{__('common.home')}}</a></li>
        <li>{{__('activity_logs.list')}}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header container-fluid d-flex justify-content-between">
            <h3 class="box-title">{{$title}}</h3>
            <div class="box-action pull-right">
                <ul class="d-flex mb-0">
                    <li><a href="{{route(\App\Models\ActivityLog::VIEW)}}" class="btn btn-default" ><i class="fa fa-refresh"></i> {{__('common.reload')}}</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="box-search-table pull-right d-flex justify-content-between mt-2">
                    <div class="box-delete_multi pull-left">
                        <a href="javascript:;" id="btn-delete-all" data-routes="/admin/activity-logs/destroy" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{__('common.delete_all')}}</a>
                    </div>
                    {!! Form::open(array('url' => route(\App\Models\ActivityLog::VIEW), 'id' => 'form-search', 'method' => 'GET', 'class' => 'd-flex')) !!}
                    <div class="col-xs-3 d-flex">
                        <label for="" class="control-label label_consulDate">{{ __('activity_logs.from_created') }}</label>
                        {!! Form::text('from_date', Request::get('from_date'), array('id' => 'fromDate', 'class' => 'form-control','maxlength' => 100, 'required' => false, 'placeholder' => 'dd-mm-yy', 'autofocus' => true, 'autocomplete' => 'off',))  !!}
                    </div>
                    <div class="col-xs-3 d-flex">
                        <label for="" class="control-label label_consulDate">{{ __('activity_logs.to_created') }}</label>
                        {!! Form::text('to_date', Request::get('to_date'), array('id' => 'toDate', 'class' => 'form-control text-dark form-inline','maxlength' => 100, 'required' => false, 'placeholder' => 'dd-mm-yy', 'autofocus' => true, 'autocomplete' => 'off'))  !!}
                    </div>
                    <div class="col-xs-3 d-flex">
                        {!! Form::text('search', Request::get('search'), array('class' => 'form-control form-inline', 'maxlength' => 50, 'id' => 'input_source', 'placeholder' => __('common.keyword'), 'autocomplete' => 'off')) !!}
                        
                    </div>
                    <button class="btn btn-primary ml-2" type="submit"><i class="fa fa-search"></i></button>    
                    {!!Form::hidden("numpaging", Request::get('numpaging'))!!}
                    {!!Form::hidden("paging", Request::get('paging'))!!}
                    {!! Form::close() !!}
                </div>  
                <table class="table table-striped mt-2" id="table-main">
                    <thead>
                    <tr>
                        <th class="rowCheckAll w_30 text-center"><input type="checkbox" id="checkAll" /></th>
                        <th class="w_30">{{__('common.stt')}}</th>
                        <th>{!!sort_title('created_at',__('activity_logs.created_at'))!!}</th>
                        <th>{!!sort_title('user_id',__('activity_logs.author'))!!}</th>
                        <th>{!!sort_title('ip',__('activity_logs.ip'))!!}</th>
                        <th>{!!sort_title('method',__('activity_logs.method'))!!}</th>
                        <th>{!!sort_title('log_name',__('common.action'))!!}</th>
                        <th>{!!sort_title('description',__('common.description'))!!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$activityLogs->isEmpty())
                        @php
                            $no = (($activityLogs->currentPage() - 1) * $activityLogs->perPage() + 1) 
                        @endphp
                        @foreach($activityLogs as $log)
                            <tr>
                                <td class="align-middle text-center">
                                    <input type="checkbox" class="checkItem" value="{{$log->id}}" />
                                </td>
                                <td class="align-middle text-center">{{$no++}}</td>
                                <td class="align-middle">
                                    <p class="fw-bold">{{ \Carbon\Carbon::parse( $log->created_at )->ago() }}</p>
                                    <p>{{ $log->created_at->format('d/m/Y') }}</p>
                                    <p>{{ $log->created_at->format('H:i:s') }}</p>
                                </td>
                                <td class="align-middle">
                                    <div class="avatar_log">
                                        <img src="{{ $log->user->avatar_url }}" alt="">
                                    </div>
                                    <div class="profile_log">
                                        <p class='name'>{{ $log->user->name }}</p>
                                        <p>{{ $log->user->role }}</p>
                                    </div>
                                </td>
                                <td class="align-middle text-center">{{ $log->ip }}</td>
                                <td class="align-middle text-center">{{ $log->method }}</td>
                                <td class="align-middle">{{ $log->log_name }}</td>
                                <td class="align-middle">{{ $log->description }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">{{__('common.no_data')}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="footer-table row">
                    <div class="col-sm-6 d-flex">
                        <div class="box-numpaging">
                            {!! Form::select('numpaging', App\Libs\Constants::$list_numpaging, Request::get("numpaging"),array('class' => 'form-control select', 'id' => 'selectNumpaging')) !!}
                        </div>
                        <span class="total-record ml-2">{!!__("common.total_data", ['total' => $activityLogs->total()])!!}</span>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{$activityLogs->links('vendor/pagination/bootstrap-4')}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include("partials.numpaging")
    @include('partials._datepicker')
    <script type="text/javascript">
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

        $(document).ready(function () {
            $(".status").click(function (e) {
                let status = $(this).data('status');
                let id = $(this).data('id');
                let _url = root + '/admin/activity-logs/active';
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


