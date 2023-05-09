@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
    <li><a href="{{route(\App\Models\Roles::LIST)}}"> {{trans('roles.list')}}</a></li>
    <li>{{__('common.update')}}</li>
</ol>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="box-title text-white">{{$title}}</h3>
    </div>
    <div class="card-body">
        <!-- form start -->
        {!! Form::open(array('url' => url("/admin/roles/update/" . $role->id), 'id' => 'form-roles')) !!}
            @include('admin.roles._form')
        {!! Form::close() !!}
    </div><!-- /.box-body -->
</div>
@stop
