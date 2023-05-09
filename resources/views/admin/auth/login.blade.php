<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> SDC | {{$title}}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
    @notifyCss
</head>
<body class="hold-transition login-page">
<x:notify-messages />
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h2"><b>{{ trans('users.login_system') }}</b></a>
        </div>
        <div class="card-body">
            <form action="{{route('admin.post_login')}}" method="post" id="login_form">
                @csrf
                <div>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="{{trans('users.email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <label id="email-error" class="error" for="email" style="display: none"></label>
                </div>
                <div>
                    <div class="input-group mt-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="{{trans('users.password')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <label id="password-error" class="error" for="password" style="display: none"></label>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">{{ trans('users.remember_me') }}</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">{{ trans('users.login') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@notifyJs
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(function () {
        $('#login_form').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "{{trans('users.validation.email_empty')}}",
                    email: "{{trans('users.validation.email_format')}}"
                },
                password: {
                    required: "{{trans('users.validation.password_empty')}}",
                },
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
</body>
</html>
