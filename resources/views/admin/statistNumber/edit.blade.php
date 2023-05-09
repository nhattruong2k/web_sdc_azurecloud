@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
    <li><a href="{{route(\App\Models\StatistNumber::LIST)}}"> {{trans('statistnumber.list')}}</a></li>
    <li>{{__('common.update')}}</li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="box-title text-white">{{$title}}</h3>
    </div>
    <div class="card-body">
        {!! Form::open(array('url' => url("/admin/statistNumbers/update/" . $numbers->id), 'id' => 'form-statistNumber', 'data-icon' => $numbers->icon, 'files' => true)) !!}
            {!! Form::hidden('id', $numbers->id) !!}   
            @include('admin.statistNumber._form')
        {!! Form::close() !!}
    </div>
</div>
@stop
