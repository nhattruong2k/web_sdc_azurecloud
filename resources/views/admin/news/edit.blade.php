@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
    <li><a href="{{route(\App\Models\News::LIST)}}"> {{trans('news.list')}}</a></li>
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
        {!! Form::open(array('url' => url("/admin/news/update/" . $news->id), 'id' => 'form-new','data-id'=>$news->id,'data-image'=>$news->image, 'files' => true)) !!}
            {!! Form::hidden('id',  $news->id)!!}
            @include('admin.news._form')
        {!! Form::close() !!}
    </div>
</div>
@stop
