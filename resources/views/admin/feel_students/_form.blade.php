<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @if(Route::currentRouteName() == \App\Models\FeelStudent::CREATE)
                     <label for="avatar" class="control-label required">{{__('feel_students.avatar')}}</label>
                @elseif (Route::currentRouteName() == \App\Models\FeelStudent::UPDATE)
                    <label for="avatar" class="control-label ">{{__('feel_students.avatar')}}</label>
                @endif
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $feelStudent->avatar_url }}" class="image-upload" alt=""/>
                            @if(getFilenameFromUrl($feelStudent->avatar_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="avatar" accept="image/x-png,image/jpeg" id="file_avatar" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                    <label id="file_avatar-error" class="error" for="file_avatar"></label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="name" class="control-label required">{{__('feel_students.name')}}</label>
                {!! Form::text('name', $feelStudent->name, array('class' => 'form-control', 'required' => true, 'maxlength' => 50, 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content" class="control-label required">{{__('feel_students.content')}}</label>
                {!! Form::textArea('content', $feelStudent->content, array('class' => 'form-control', 'cols'=>10, 'rows'=>8, 'required' => true, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'content')) !!}
                <label id="content-error" class="error mt-1" for="content" hidden></label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $feelStudent->status, array('id' => 'status', Request::segment(3) == 'create' ? 'checked' : '')) !!}
                <label for="status">{{__('feel_students.active')}}</label>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                @if(Request::segment(3) != 'profile')
                    <a href="{{route(\App\Models\FeelStudent::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    mn_selected = 'mn_feel-students';
</script>
@section('script')
@include('partials._formValidation')
@include('partials._select')
@include('partials._datetimepicker')
@include('partials._bootstrap_fileupload')
<script type="text/javascript">
    var avatar = '{{ $feelStudent->avatar }}';
    var content = CKEDITOR.replace('content');
    content.on('change', function(e){
        var contentData = CKEDITOR.instances.content.getData();
        contentData != '' ? $('#content-error').css('display', 'none') :  $('#content-error').css('display', 'block');
    });
    var Feel = {
        SELECTORS: {
            frm: '#form_feel-student'
        },
        init: function () {
            this.setUpEvent();
        },
        setUpEvent: function () {
            $(Feel.SELECTORS.frm).validate({
                ignore: [],
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                    },
                    avatar: {
                        required: checkImageRequired(avatar),
                    },
                    content: {
                        required: function(textarea) {
                            return CKEDITOR.instances.content.updateElement();
                        }
                    },
                },
                messages: {
                    name: {
                        required: "{!! __("feel_students.validation.name_empty") !!}",
                        minlength: "{!! __("feel_students.validation.name_min", ['amount' => 3]) !!}",
                    },
                    content: {
                        required: "{!! __("feel_students.validation.content_empty") !!}",
                    },
                    avatar: {
                        required: "{!! __("feel_students.validation.avatar_empty") !!}",
                    }

                }
            });
            $(Feel.SELECTORS.frm).submit(function (){
                $('.error').removeAttr('hidden');
            })
        }
    }
    $(function () {
        Feel.init();

        $('.btn_save').click(function (){
            let removeImg = $('#remove_img').val();
            $('#file_avatar-error').html('{!! __("feel_students.validation.avatar_empty") !!}')
            $('#file_avatar-error').css('display', '')
            return !removeImg;
        });
    });
</script>
@endsection
