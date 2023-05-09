@extends('admin.layouts.app')
@section('title', $title)
@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{route('admin-home')}}"><i class="fa fa-home"></i> {{trans('common.home')}}</a></li>
    <li>{{trans('general_settings.management')}}</li>
</ol>
<script>
    mn_selected = "form-general-settings";
</script>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="box-title text-white">{{$title}}</h3>
    </div>
    <div class="card-body">
        {!! Form::open(array('url' => route(\App\Models\GeneralSetting::SAVE), 'id' => 'form-general-settings', 'files' => true)) !!}
        <div class="container-fluid">
            @include('partials._showError')
            <div class="row">
                <div class="col-md-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="control-label">{{__('general_settings.logo')}}</label>
                            <div class="fileupload fileupload-new " data-provides="fileupload">
                                <div class="fileupload-new thumbnail user-form-image">
                                    <div class="image-box">
                                        <input type="hidden" name="remove_logo" id="remove_logo">
                                        <img src="{{ $general_settings->logo_url }}" alt="img"/>
                                        @if(getFilenameFromUrl($general_settings->logo_url) != \App\Libs\Constants::$image_default)
                                            <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                                <div>
                                    <span class="btn btn-file  btn-primary">
                                        <span class="fileupload-new">{{__('common.choose')}}</span>
                                        <span class="fileupload-exists">{{__('common.change')}}</span>
                                        <input type="file" name="logo" class="upload_img" accept="image/x-png,image/jpeg" />
                                    </span>
                                    <a href="javascript:;" class="btn fileupload-exists choose_image" data-dismiss="fileupload">{{__('common.delete')}}</a>
                                </div>
                                <span class="error upload_img_error d-none">{{ trans('common.validation.mimes') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="control-label">{{__('general_settings.favicon')}}</label>
                            <div class="fileupload fileupload-new " data-provides="fileupload">
                                <div class="fileupload-new thumbnail user-form-image">
                                    <div class="image-box1">
                                        <input type="hidden" name="remove_favicon" id="remove_favicon">
                                        <img src="{{ $general_settings->favicon_url }}" alt="img"/>
                                        @if(getFilenameFromUrl($general_settings->favicon_url) != \App\Libs\Constants::$image_default)
                                            <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img1"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                                <div>
                                    <span class="btn btn-file  btn-primary">
                                        <span class="fileupload-new">{{__('common.choose')}}</span>
                                        <span class="fileupload-exists">{{__('common.change')}}</span>
                                        <input type="file" name="favicon" class="upload_imgs" accept="image/x-png,image/jpeg" />
                                    </span>
                                    <a href="javascript:;" class="btn fileupload-exists choose_icon" data-dismiss="fileupload">{{__('common.delete')}}</a>
                                </div>
                                <span class="error upload_img_errors d-none">{{ trans('common.validation.mimes') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="control-label">{{__('general_settings.thumbnail')}}</label>
                            <div class="fileupload fileupload-new " data-provides="fileupload">
                                <div class="fileupload-new thumbnail user-form-image">
                                    <div class="image-box2">
                                        <input type="hidden" name="remove_thumbnail" id="remove_thumbnail">
                                        <img src="{{ $general_settings->thumbnail_url }}" alt="img"/>
                                        @if(getFilenameFromUrl($general_settings->thumbnail_url) != \App\Libs\Constants::$image_default)
                                            <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img2"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                                <div>
                                    <span class="btn btn-file  btn-primary">
                                        <span class="fileupload-new">{{__('common.choose')}}</span>
                                        <span class="fileupload-exists">{{__('common.change')}}</span>
                                        <input type="file" name="thumbnail" class="upload_img" accept="image/x-png,image/jpeg" />
                                    </span>
                                    <a href="javascript:;" class="btn fileupload-exists choose_image" data-dismiss="fileupload">{{__('common.delete')}}</a>
                                </div>
                                <span class="error upload_img_error d-none">{{ trans('common.validation.mimes') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label">{{__('general_settings.name')}}</label>
                        {!! Form::text('name', $general_settings->name, array('class' => 'form-control', 'maxlength' => 50, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'name')) !!}
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">{{__('general_settings.email')}}</label>
                        {!! Form::text('email', $general_settings->email, array('class' => 'form-control', 'maxlength' => 50, 'id' => 'email', 'autofocus' => true, 'autocomplete' => 'off')) !!}
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label">{{__('general_settings.phone')}}</label>
                        {!! Form::text('phone', $general_settings->phone, array('class' => 'form-control', 'maxlength' => 50, 'id' => 'phone', 'autofocus' => true, 'autocomplete' => 'off')) !!}
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">{{__('general_settings.address')}}</label>
                        {!! Form::text('address', $general_settings->address, array('class' => 'form-control', 'maxlength' => 50, 'id' => 'address', 'autofocus' => true, 'autocomplete' => 'off')) !!}
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="control-label">{{__('general_settings.facebook')}}</label>
                        {!! Form::url('facebook', $general_settings->facebook, array('class' => 'form-control', 'maxlength' => 50, 'id' => 'facebook', 'autofocus' => true, 'autocomplete' => 'off')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description" class="control-label">{{__('general_settings.description')}}</label>
                        {!! Form::textArea('description', $general_settings->description, array('class' => 'form-control', 'maxlength' => 999, 'id' => 'description', 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '10')) !!}
                    </div>
                </div>  
            </div>
            <div class="form-group">
                <label for="content_introduce" class="control-label required">{{ __('general_settings.content_introduce') }}</label>
                {!! Form::textArea('content_introduce', $general_settings->content_introduce, [
                    'id' => 'content_introduce',
                    'name' => 'content_introduce',
                    'class' => 'form-control contentEditor',
                    'cols' => 10,
                    'rows' => 8,
                    'required' => true,
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
                <label id="content_introduce-error" class="error mt-1" for="content_introduce" hidden="hidden"></label>
                <div id="content_error" class="error d-none"></div>
            </div>
            <div class="row social_setting">
                <div class="label_setting">
                    <h5>{{ __("general_settings.social_setting") }}</h5>
                </div>
                <div class="text_social">
                    <div class="form-group">
                        <label for="facebook_pixel" class="control-label">{{__('general_settings.facebook_pixel')}}</label>
                        {!! Form::textArea('facebook_pixel', $general_settings->facebook_pixel, array('class' => 'form-control textarea', 'maxlength' => 999, 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}
                    </div>
                    <div class="form-group">
                        <label for="google_analytics" class="control-label">{{__('general_settings.google_analytics')}}</label>
                        {!! Form::textArea('google_analytics', $general_settings->google_analytics, array('class' => 'form-control textarea', 'maxlength' => 999, 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}
                    </div>
                </div>
            </div>
            <div class="smtp_setting">
                <div class="label_setting">
                    <h5>{{ __("general_settings.smtp") }}</h5>
                </div>
                <div class="row form_smtp">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mailer" class="control-label">{{__('general_settings.mailer')}}</label>
                            {!! Form::text('mailer', $general_settings->mailer, array('class' => 'form-control textarea', 'maxlength' => 20, 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}
                        </div>
                        <div class="form-group">
                            <label for="host" class="control-label">{{__('general_settings.host')}}</label>
                            {!! Form::text('host', $general_settings->host, array('class' => 'form-control textarea', 'maxlength' => 20, 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}
                        </div>
                        <div class="form-group">
                            <label for="encrytion" class="control-label">{{__('general_settings.encrytion')}}</label>
                            {!! Form::text('encrytion', $general_settings->encrytion, array('class' => 'form-control', 'maxlength' => 20, 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="port" class="control-label">{{__('general_settings.port')}}</label>
                                {!! Form::text('port', $general_settings->port, array('class' => 'form-control', 'id' => 'port', 'maxlength' => 4, 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="use_name" class="control-label">{{__('general_settings.use_name')}}</label>
                            {!! Form::text('use_name', $general_settings->use_name, array('class' => 'form-control', 'maxlength' => 50, 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">{{__('general_settings.password')}}</label>
                            <div class="input-group">
                                {!! Form::password('password', array('class' => 'form-control', 'id' => 'password', 'maxlength' => 14, 'autocomplete' => 'off', 'rows' => '3')) !!}
                                <span class="input-group-text"><i class="toggle-password fa fa-eye-slash" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="from_address" class="control-label">{{__('general_settings.from_address')}}</label>
                            {!! Form::text('from_address', $general_settings->from_address, array('class' => 'form-control', 'maxlength' => 50, 'autofocus' => true, 'autocomplete' => 'off', 'rows' => '3')) !!}
                        </div>
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
@include('partials._bootstrap_fileupload')
@include('partials._formValidation')
@include('partials._datepicker')
@include('partials.validation_number')
    <script>
        var content_introduce = CKEDITOR.replace('content_introduce');
        var span = document.getElementById('content_error');
        content_introduce.on('change', function(e) {
            $changeditor = CKEDITOR.instances.content_introduce.getData();
            $changeditor != '' ? $('#content_introduce-error').css('display', 'none') : $('#content_introduce-error').css('display', 'block');

            $changeditorLength = CKEDITOR.instances.content_introduce.getData().replace(/<[^>]*>/gi, '').length;
            if($changeditorLength > 8 || $changeditorLength == 0){
                $("#content_error").attr('class', 'error d-none');
                return $('#btn_save').attr('disabled', false);
            }
            span.innerText = "{{__('general_settings.validation.content_minlength')}}";
            $("#content_error").removeClass("d-none");
            return $('#btn_save').attr('disabled', true);
        });
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                regexp = /(.+)@(.+)\.(.+)/i;
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            }
        );
        $(function() {
            $(".input-group-text .toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                input = $(this).closest('.form_smtp').find("#password");
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                    console.log(1);
                } else {
                    console.log(2);
                    input.attr("type", "password");
                }
            });
            $("#form-general-settings").validate({
                ignore: [],
                rules: {
                    email: {
                        email: true,
                    },
                    phone: {
                        check_phone_VN: true,
                    },
                    content_introduce: {
                        required: function(textarea) {
                            return CKEDITOR.instances.content_introduce.updateElement();
                        }
                    },
                    facebook:{
                        check_exist_facebook: true,
                    },
                    use_name: {
                        regex: true,
                    },
                    from_address: {
                        regex: true,
                    },
                    password: {
                        minlength: 6,
                    }
                },
                messages: {
                    email: {
                        email: "{{__("general_settings.validation.email_format")}}",
                    },
                    phone: {
                        check_phone_VN: '{{trans('general_settings.validation.phone_format')}}',
                    },
                    content_introduce: {
                        required: "{{ __('general_settings.validation.content_required') }}",
                    },
                    facebook: {
                        check_exist_facebook: "{{__("general_settings.validation.facebook_regex")}}",
                    },
                    use_name: {
                        regex: "{{ __('general_settings.validation.use_name_regex') }}",
                    },
                    from_address: {
                        regex: "{{ __('general_settings.validation.from_address_regex') }}",
                    },
                    password: {
                        minlength: "{{ __('general_settings.validation.password_min', ['amount' => 6]) }}",
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                    $('#btn_save').attr('disabled', true)
                }
            });

            $('#btn_save').click(function(e) {
                $('.error').removeAttr('hidden');
            });
            jQuery.validator.addMethod("check_phone_VN", function(value, element) {
                return this.optional(element) || /(((\+|)84)|0)(2|3|5|7|8|9)+([0-9]{8,10})\b/.test(value);
            });
            $.validator.addMethod("check_exist_facebook",function is_valid_url(url, element) {
                return this.optional(element) || /^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i.test(url);
            });
            setInputFilter(document.getElementById("port"), function(value) {
                return /^\d*$/.test(value);
            });
            $('#password').val('{{ $password }}');
        });

    </script>
@endsection
