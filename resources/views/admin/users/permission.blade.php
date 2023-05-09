@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
        <li><a href="{{route(\App\Models\User::LIST)}}"> {{trans('users.list')}}</a></li>
        <li>{{__('users.permission')}}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="box-title text-white">{{$title}}</h3>
        </div>
        <div class="card-body">
            <!-- form start -->
            {!! Form::open(array('url' => url("/admin/users/save-permission/" . $user->id), 'id' => 'form-permission')) !!}
            @include('admin.users._form_permission')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
    </div>
@stop
