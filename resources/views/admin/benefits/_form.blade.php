<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                 <label for="image" class="control-label required">{{__('benefits.image')}}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $benefit->image_url }}" class="image-upload" alt=""/>
                            @if(getFilenameFromUrl($benefit->image_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="image" class="choose_image" accept="image/x-png,image/jpeg" id="file_image" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists remove_image" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                    <label id="file_image-error" class="error" for="file_image"></label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="icon" class="control-label required">{{__('benefits.icon')}}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box1">
                            <input type="hidden" name="remove_img1" id="remove_img1">
                            <img src="{{ $benefit->icon_url }}" class="image-upload" alt=""/>
                            @if(getFilenameFromUrl($benefit->icon_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img1"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="icon" class="choose_icon" accept="image/x-png,image/jpeg" id="file_icon" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists remove_icon" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                    <label id="file_icon-error" class="error" for="file_icon"></label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label required">{{__('benefits.title')}}</label>
                {!! Form::text('title', $benefit->title, array('class' => 'form-control', 'maxlength' => 50, 'required' => false, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'title')) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content" class="control-label required">{{__('benefits.content')}}</label>
                {!! Form::textArea('content', $benefit->content, array('class' => 'form-control', 'cols'=>10, 'rows'=>8, 'required' => true, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'content')) !!}
                <label id="content-error" class="error mt-1" for="content" hidden="hidden"></label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $benefit->status ?? 1, array('id' => 'status')) !!}
                <label for="status">{{__('benefits.active')}}</label>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                @if(Request::segment(3) != 'profile')
                    <a href="{{route(\App\Models\Benefit::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    mn_selected = 'mn_benefits'
</script>
@section('script')
@include('partials._formValidation')
@include('partials._select')
@include('partials._datetimepicker')
@include('partials._bootstrap_fileupload')
<script type="text/javascript">
    var image = '{{ $benefit->image }}';
    var icon = '{{ $benefit->icon }}';
    var content = CKEDITOR.replace('content');
    content.on('change', function(e){
        var contentData = CKEDITOR.instances.content.getData();
        contentData != '' ? $('#content-error').css('display', 'none') :  $('#content-error').css('display', 'block');
    });
    var Benefit = {
        CONSTS: {
            URL_KEY_EXIST: '{{ route("benefit_students.title-exist") }}',
        },
        SELECTORS: {
            frm: '#form-benefit'
        },
        init: function () {
            this.setUpEvent();
        },
        setUpEvent: function () {
            $(Benefit.SELECTORS.frm).validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        minlength: 6,
                        remote: {
                            url: Benefit.CONSTS.URL_KEY_EXIST,
                            type: 'post',
                            data:{
                                'title': function (){
                                    return $('#title').val();
                                },
                                'id': function (){
                                    return '{{ $benefit->id }}';
                                },
                            },
                        },
                    },
                    image: {
                        required: checkImageRequired(image),
                    },
                    icon: {
                       required: checkImageRequired(icon),
                    },
                    content: {
                        required: function(textarea) {
                            return CKEDITOR.instances.content.updateElement();
                        }
                    },
                },
                messages: {
                    image: {
                        required: "{!! __("benefits.validation.image_empty") !!}",
                    },
                    icon: {
                        required: "{!! __("benefits.validation.icon_empty") !!}",
                    },
                    title: {
                        required: "{!! __("benefits.validation.title_empty") !!}",
                        minlength: "{!! __("benefits.validation.title_min", ['amount' => 6]) !!}",
                        remote: "{!!__("benefits.validation.title_exist", ['title' => '{0}'])!!}"
                    },
                    content: {
                        required: "{!! __("benefits.validation.content_empty") !!}",
                    },
                },
            });
            $(Benefit.SELECTORS.frm).submit(function(){
                $('.error').removeAttr('hidden');
            })
        },
    }
    $(function () {
        Benefit.init();
        $('.btn_save').click(function (){
            let removeImg = $('#remove_img').val();
            if (removeImg){
                $('#file_image-error').html('{!! __("benefits.validation.image_empty") !!}')
                $('#file_image-error').css('display', '')
                return !removeImg;
            }
        });

        $('.btn_save').click(function (){
            let removeImg1 = $('#remove_img1').val();
            if (removeImg1){
                $('#file_icon-error').css('display', '')
                $('#file_icon-error').html('{!! __("benefits.validation.icon_empty") !!}')
                return !removeImg1;
            }
            
        });
    });

</script>
@endsection
