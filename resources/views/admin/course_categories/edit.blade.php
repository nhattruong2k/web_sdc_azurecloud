@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
    <li><a href="{{route(\App\Models\CourseCategories::LIST)}}"> {{trans('course_categories.list')}}</a></li>
    <li>{{__('common.update')}}</li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="box-title text-white">{{$title}}</h3>
    </div>
    <div class="card-body">
        {!! Form::open(array('url' => route("course_categories.update", $courseCategory->id), 'id' => 'form_course_category','files' => true)) !!}
            @include('admin.course_categories._form')
        {!! Form::close() !!}
    </div>
</div>
@stop
