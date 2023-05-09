<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @if(Route::currentRouteName() == \App\Models\ProjectStudent::CREATE)
                     <label for="title" class="control-label required">{{__('project_students.image')}}</label>
                @elseif (Route::currentRouteName() == \App\Models\ProjectStudent::UPDATE)
                    <label for="title" class="control-label ">{{__('project_students.image')}}</label>
                @endif
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $projectStudent->image_url }}" class="image-upload" alt=""/>
                            @if(getFilenameFromUrl($projectStudent->image_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="image" accept="image/x-png,image/jpeg" id="file_image" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                    <label id="file_image-error" class="error" for="file_image"></label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label required">{{__('project_students.title')}}</label>
                {!! Form::text('title', $projectStudent->title, array('class' => 'form-control', 'maxlength' => 100, 'required' => true, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'title')) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="link" class="control-label required">{{__('project_students.link')}}</label>
                {!! Form::text('link', $projectStudent->link, array('class' => 'form-control', 'required' => true, 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description" class="control-label">{{__('project_students.description')}}</label>
                {!! Form::textarea('description', $projectStudent->description, ['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $projectStudent->status, array('id' => 'status', Request::segment(3) == 'create' ? 'checked' : '')) !!}
                <label for="status">{{__('project_students.active')}}</label>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                @if(Request::segment(3) != 'profile')
                    <a href="{{route(\App\Models\ProjectStudent::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    mn_selected = 'mn_project-students'
</script>
@section('script')
@include('partials._formValidation')
@include('partials._select')
@include('partials._datetimepicker')
@include('partials._bootstrap_fileupload')
<script type="text/javascript">
    var image = '{{ $projectStudent->image }}';
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            regexp = /<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i;
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        }
    );
    var Project = {
        CONSTS: {
            URL_KEY_EXIST: '{{ route("project_students.title-exist") }}',
        },
        SELECTORS: {
            frm: '#form-project-student',
        },
        init: function () {
            this.setUpEvent();
        },
        setUpEvent: function () {
            $(Project.SELECTORS.frm).validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 6,
                        remote: {
                            url: Project.CONSTS.URL_KEY_EXIST,
                            type: 'post',
                            data:{
                                'title': function (){
                                    return $('#title').val();
                                },
                                'id': function (){
                                    return '{{ $projectStudent->id }}';
                                }
                            }
                        }
                    },
                    image: {
                        required: checkImageRequired(image),   
                    },
                    link: {
                        required: true,
                        regex: true,
                    },
                },
                messages: {
                    image: {
                        required: "{!! __("project_students.validation.image_empty") !!}",
                    },
                    title: {
                        required: "{!! __("project_students.validation.title_empty") !!}",
                        minlength: "{!! __("project_students.validation.title_min", ['amount' => 6]) !!}",
                        remote: "{!!__("project_students.validation.title_exist", ['title' => '{0}'])!!}",
                    },
                    link: {
                        required: "{!! __("project_students.validation.link_empty") !!}",
                        regex: "{!! __("project_students.validation.link_regex") !!}",
                    }
                },
            });
            $(Project.SELECTORS.frm).submit(function (){
                $('.error').removeAttr('hidden');
            })
        },
    }
    $(function () {
        Project.init();
        $('.btn_save').click(function (){
            let removeImg = $('#remove_img').val();
            $('#file_image-error').html('{!! __("project_students.validation.image_empty") !!}')
            $('#file_image-error').css('display', '')
            return !removeImg;
        });
    });
</script>
@endsection
