<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label">{{ __('student.avatar') }}
                    {{ __('student.font_size') }}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $students->avatar_urls }}" alt="image" class="image-upload" id="fontawesome_picture" />
                            @if(getFilenameFromUrl($students->avatar_urls) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts thumbnail_posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{ __('common.choose') }}</span>
                            <span class="fileupload-exists">{{ __('common.change') }}</span>
                            <input type="file" name="avatar" accept="image/x-png,image/jpeg" id="file_image" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists"
                            data-dismiss="fileupload">{{ __('common.delete') }}</a>
                    </div>
                    <label id="file_image-error" class="error" for="file_image" hidden="hidden"></label>
                    <span id="validation-message" class="error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="fullname" class="control-label required">{{ __('student.fullname') }}</label>
                {!! Form::text('fullname', $students->fullname, [
                    'id' => 'fullname',
                    'class' => 'form-control',
                    'maxlength' => 50,
                    'required' => true,
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="position" class="control-label required">{{ __('student.position') }}</label>
                {!! Form::text('position', $students->position, [
                    'id' => 'position',
                    'class' => 'form-control',
                    'maxlength' => 50,
                    'required' => true,
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="workplace" class="control-label required">{{ __('student.workplace') }}</label>
        {!! Form::text('workplace', $students->workplace, [
            'id' => 'workplace',
            'class' => 'form-control',
            'maxlength' => 50,
            'required' => true,
            'autofocus' => true,
            'autocomplete' => 'off',
        ]) !!}
    </div>
    <div class="form-group">
        <label for="description" class="control-label required">{{ __('teacher.description') }}</label>
        {!! Form::textarea('description', $students->description, ['id' => 'description','name'=>'description', 'class' => 'form-control descriptionEditor','cols'=>10,'rows'=>5,'autofocus' => true,'autocomplete' => 'off']) !!}
        <label id="description-error" class="error descript mt-1" for="description" hidden="hidden"></label>
        <div id="description_error" class="error d-none"></div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $students->status ?? 1, ['id' => 'status']) !!}
                <label for="status">{{ __('student.active') }}</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btn_save"><i class="fa fa-save"></i>
                    {{ __('common.save') }}</button>
                <a href="{{ route(\App\Models\TeamStudents::LIST) }}" class="btn btn-default"><i
                        class="fa fa-reply"></i> {{ __('common.return') }}</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    mn_selected = 'mn_student';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._bootstrap_fileupload')
    <script src="{{asset('adminlte\ckeditor\ckeditor.js')}}"></script>
    <script>
        var options = {
         filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
         filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
         filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
         filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
        var description = CKEDITOR.replace('description', options);
        var label = document.getElementById('description_error');
        description.on('change', function(e){
            $changeditor = CKEDITOR.instances.description.getData();
            $changeditor != '' ? $('#description-error').css('display', 'none') : $('#description-error').css('display', 'block');

            var changeLength =  $changeditor.replace(/<[^>]*>/gi, '').length;
            if(changeLength > 8 || changeLength == 0){
                $("#description_error").attr('class', 'error d-none');
                return $('#btn_save').attr('disabled', false);
            }
            label.innerText = "{{__('teacher.description_min')}}";
            $("#description_error").removeClass("d-none");
            return $('#btn_save').attr('disabled', true);
        });

        let input = document.getElementById('file_image');
        let span = document.getElementById('validation-message');
        var _URL = window.URL || window.webkitURL;
            input.addEventListener('change', () => {
            let files = input.files;
            if (files.length > 0) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(files[0]);
                img.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (height != 400 && width != 400) {
                        span.innerText = "{{__('student.avatar_dimensions')}}";
                        return $('#btn_save').attr('disabled', true);
                    }
                        span.innerText = '';
                        return $('#btn_save').attr('disabled',false);
                        _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        });
        $("#form-students").validate({
            ignore: [],
            rules: {
                fullname: {
                    required: true,
                    minlength: 5,
                },
                position: {
                    required: true,
                    minlength: 3,
                },
                workplace: {
                    required: true,
                    minlength: 3,
                },
                description: {
                    required: function(textarea) {
                      return CKEDITOR.instances.description.updateElement();
                    },
                    minlength: 8,
                },
            },
            messages: {
                fullname: {
                    required: "{{ __('student.fullname_required') }}",
                    minlength: "{{ __('student.fullname_min') }}",
                },
                position: {
                    required: "{{ __('student.position_required') }}",
                    minlength: "{{ __('student.position_min') }}",
                },
                workplace: {
                    required: "{{ __('student.workplace_required') }}",
                    minlength: "{{ __('student.workplace_min') }}",
                },
                description: {
                    required: "{{__("teacher.description_required")}}",
                    minlength: "{{__("teacher.description_min")}}",
                },
            },
            submitHandler: function(form) {
                form.submit();
                $('#btn_save').attr('disabled', true)
            }
        });
        $('#btn_save').click(function(){
                $('.error').removeAttr('hidden');
        });
        $("#fontawesome_picture").click(function() {
            $("input[id='file_image']").click();
        });
    </script>
@endsection
