@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
    <li><a href="{{route(\App\Models\Teamteachers::LIST)}}"> {{trans('teacher.list')}}</a></li>
    <li>{{__('common.update')}}</li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="box-title text-white">{{$title}}</h3>
    </div>
    <div class="card-body">
        {!! Form::open(array('url' => url("/admin/teachers/update/" . $teachers->id), 'id' => 'form-teachers','data-id'=>$teachers->id,'files' => true)) !!}
            @include('admin.teachers._form')
        {!! Form::close() !!}
    </div>
</div>
@stop
