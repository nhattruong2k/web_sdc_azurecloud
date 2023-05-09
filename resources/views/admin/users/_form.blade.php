<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label">{{__('users.avatar')}}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{$user->avatar_url}}" alt="img"/>
                            @if(getFilenameFromUrl($user->avatar_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="avatar" class="upload_img" accept="image/x-png,image/jpeg" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                    <span class="upload_img_error error d-none">{{ trans('common.validation.mimes') }}</span>
                </div>
            </div>
        </div>
    </div>
    @if($user->role != \App\Libs\Constants::$administrator)
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label ">{{__('common.role')}}</label>
                <select name="role_id[]" class="form-control select2-single select" {{Request::segment(3) == 'profile' ? 'disabled' : ''}} multiple>
                    @foreach ($roles as $item)
                        <option {{ isset($roleOfUser) ? $roleOfUser->contains('id', $item->id) ? 'selected' : '' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="control-label required">{{__('users.full_name')}}</label>
                {!! Form::text('name', $user->name, array('class' => 'form-control', 'maxlength' => 50, 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender" class="control-label">{{__('users.gender')}}</label>
                {!! Form::select('gender', $user->genderOption(), $user->gender, array('class' => 'form-control bg-white', 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="control-label required">{{__('users.email')}}</label>
                @if(!$user->id)
                    {!! Form::text('email', $user->email, array('class' => 'form-control', 'maxlength' => 50, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'email')) !!}
                @else
                    <span class="form-control  bg-light not-allowed" readonly="true">{{$user->email}}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone" class="control-label">{{__('users.phone')}}</label>
                {!! Form::text('phone', $user->phone, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="facebook" class="control-label">{{__('users.facebook')}}</label>
                {!! Form::text('facebook', $user->facebook, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="address" class="control-label">{{__('users.address')}}</label>
                {!! Form::text('address', $user->address, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
    </div>
    @if(!$user->id)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="input_password">{{__('users.password')}}</label>
                    {!! Form::password('password', array('class' => 'form-control', 'maxlength' => 100, 'id' => 'input_password', 'autocomplete' => 'off')) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="input_password_confirmation">{{__('users.confirm_pass')}}</label>
                    {!! Form::password('password_confirmation', array('class' => 'form-control', 'maxlength' => 100, 'id' => 'input_password_confirmation', 'autocomplete' => 'off')) !!}
                </div>
            </div>
        </div>
    @endif
    @if(Request::segment(3) != 'profile')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('is_visible', 1, $user->is_visible ?? 1, array('id' => 'is_visible')) !!}
                <label for="is_visible">{{__('users.verify')}}</label>
            </div>
        </div>
    </div>
    @else
        {!! Form::hidden('is_visible', 1, array('id' => 'is_visible')) !!}
    @endif
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                @if(Request::segment(3) != 'profile')
                    <a href="{{route(\App\Models\User::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    mn_selected = 'mn_users';
</script>
@section('script')
@include('partials._formValidation')
@include('partials._bootstrap_fileupload')
<script type="text/javascript">
    $(document).ready(function() {
        $( ".select2-single" ).select2({
            multiple: true,
        });
    });

</script>
<script type="text/javascript">
    var User = {
        GLOBAL: {
            msgDeleteSuc: '@Messages.SUC_DELETE',
        },
        CONSTS: {
            URL_EMAIL_EXIST: '{{route("users.email-exist")}}',
        },
        SELECTORS: {
            frmRegister: '#form-user'
        },
        init: function () {
            this.setUpEvent();
        },
        setUpEvent: function () {
            $(User.SELECTORS.frmRegister).validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 6,
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            type: 'post',
                            url: User.CONSTS.URL_EMAIL_EXIST,
                            data: {
                                'email': function () {
                                    return $('#email').val();
                                },
                                'id': function () {
                                    return '{{ $user->id }}';
                                }
                            }
                        },
                    },
                    facebook:{
                        check_exist_facebook: true,
                    },
                    phone: {
                        check_phone_VN: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#input_password",
                        minlength: 6
                    },
                    address: {
                        maxlength : 100,
                    }
                },
                messages: {
                    name: {
                        required: "{{__("users.name_empty")}}",
                        minlength: "{{__("users.validation.name_min", ['amount' => 6])}}",
                        maxlength: "{{__("users.validation.name_max", ['amount' => 50])}}",
                    },
                    email: {
                        required: "{{__("users.email_empty")}}",
                        email: "{{__("users.email_format")}}",
                        remote: "{{trans('users.validation.email_exist')}}",
                    },
                    facebook: {
                        check_exist_facebook: "{{__("users.facebook_regex")}}",
                    },
                    phone: {
                        check_phone_VN: '{{trans('users.validation.phone_format')}}',
                    },
                    address: {
                        maxlength:'{{trans('users.validation.address_max')}}',
                    },
                    password: {
                        required: "{{__("users.password_empty")}}",
                        minlength: "{{__("users.validation.min_new_password", ['amount' => 6])}}",
                    },
                    password_confirmation: {
                        required: "{{__('users.validation.retry_pass_empty')}}",
                        equalTo: "{{__('users.pass_and_repass_not_match')}}",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                    $('#btn_save').attr('disabled', true)
                }
            });
        },
        removeAlert: function () {
        }
    };

    $(function () {
        User.init();
        jQuery.validator.addMethod("check_phone_VN", function(value, element) {
            return this.optional(element) || /(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/.test(value);
        });
        $.validator.addMethod("check_exist_facebook",function is_valid_url(url, element) {
                return this.optional(element) || /^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i.test(url);
            }
        );
    });
</script>
@endsection
