@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
        <li><a href="{{route(\App\Models\User::LIST)}}"> {{trans('users.list')}}</a></li>
        <li>{{__('users.change_password')}}</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="box-title text-white">{{$title}}</h3>
        </div>
        <div class="card-body">
            {!! Form::open(array('url' => route('user.save_change_pass', $id), 'id' => 'change-password-user', 'files' => true)) !!}
            <div class="container-fluid">
                @include('partials._showError')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="new_password" class="control-label">{{__('users.new_pass')}}</label>
                            {!! Form::password('new_password', array('class' => 'form-control', 'maxlength' => 50, 'required' => true, 'autofocus' => true, 'id' => 'new_password')) !!}
                        </div>
                        <div class="form-group">
                            <label for="confirm_new_password" class="control-label">{{__('users.retry_pass')}}</label>
                            {!! Form::password('confirm_password', array('class' => 'form-control', 'maxlength' => 50, 'required' => true, 'autofocus' => true)) !!}
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                            <a href="{{route(\App\Models\User::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('script')
    @include('partials._formValidation')
    <script type="text/javascript">
        var ChangePassword = {
            GLOBAL: {
                msgDeleteSuc: '@Messages.SUC_DELETE',
            },
            CONSTS: {},
            SELECTORS: {
                frmChangePassword: '#change-password-user',
            },
            init: function () {
                this.setUpEvent();
            },
            setUpEvent: function () {
                $(ChangePassword.SELECTORS.frmChangePassword).validate({
                    rules: {
                        new_password: {
                            required: true,
                            minlength: 6,
                        },
                        confirm_password: {
                            required: true,
                            equalTo: "#new_password",

                        }
                    },
                    messages: {
                        new_password: {
                            required: "{{__("users.new_pass_empty")}}",
                            minlength: "{{__("users.validation.min_new_password", ['amount' => 6])}}",
                        },
                        confirm_password: {
                            required: "{{__("users.confirm_new_pass")}}",
                            equalTo: "{{__('users.password_incorrect')}}",
                        }
                    }
                });
            }
        };

        /**
         * Page loaded
         */
        $(function () {
            ChangePassword.init();
        });
    </script>
@endsection
