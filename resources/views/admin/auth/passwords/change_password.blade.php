@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    <div class="card panel-default">
        <div class="card-header">{{$title}}</div>
        <div class="card-body">
            <form class="form" method="POST" action="{{ route('saveChangePassword') }}" id="frmChangePassword">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="form-group">
                            <label for="old_password" class="control-label">{{__('users.old_pass')}}</label>
                            {!! Form::password('old_password', array('class' => 'form-control', 'maxlength' => 50, 'required' => true, 'autofocus' => true)) !!}
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="control-label">{{__('users.new_pass')}}</label>
                            {!! Form::password('new_password', array('class' => 'form-control', 'maxlength' => 50, 'required' => true, 'autofocus' => true, 'id' => 'new_password')) !!}
                        </div>
                        <div class="form-group">
                            <label for="confirm_new_password" class="control-label">{{__('users.retry_pass')}}</label>
                            {!! Form::password('confirm_new_password', array('class' => 'form-control', 'maxlength' => 50, 'required' => true, 'autofocus' => true)) !!}
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                        </div>
                    </div>
                </div>
            </form>
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
                frmChangePassword: '#frmChangePassword',
            },
            init: function () {
                this.setUpEvent();
            },
            setUpEvent: function () {
                $(ChangePassword.SELECTORS.frmChangePassword).validate({
                    rules: {
                        old_password: {
                            required: true,
                        },
                        new_password: {
                            required: true,
                            minlength: 6,
                        },
                        confirm_new_password: {
                            required: true,
                            equalTo: "#new_password",
                        }
                    },
                    messages: {
                        old_password: {
                            required: "{{__("users.old_pass_empty")}}",
                        },
                        new_password: {
                            required: "{{__("users.new_pass_empty")}}",
                            minlength: "{{__("users.validation.min_new_password", ['amount' => 6])}}",
                        },
                        confirm_new_password: {
                            required: "{{__("users.confirm_new_pass")}}",
                            equalTo: "{{__('users.password_incorrect')}}",
                        },
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
