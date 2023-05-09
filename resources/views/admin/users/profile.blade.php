@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    <div class="card panel-default">
        <div class="card-header">{{$title}}</div>
        <div class="card-body">
            {!! Form::open(array('url' => url("/admin/users/profile"), 'id' => 'form-user', 'files' => true)) !!}
                @include('admin.users._form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
