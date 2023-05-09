<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @if(Route::currentRouteName() == \App\Models\Banners::CREATE)
                     <label for="link" class="control-label required">{{__('banners.link')}}</label>
                @elseif (Route::currentRouteName() == \App\Models\Banners::UPDATE)
                    <label for="link" class="control-label required">{{__('banners.link')}}</label>
                @endif
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $banner->link_url }}" class="image-upload" alt=""/>
                            @if(getFilenameFromUrl($banner->link_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="link" accept="image/x-png,image/jpeg" id="file_link" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                    <label id="file_link-error" class="error" for="file_link"></label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label required">{{__('banners.title')}}</label>
                {!! Form::text('title', $banner->title, array('class' => 'form-control', 'maxlength' => 100, 'required' => true, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'title_banner')) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="url" class="control-label">{{__('banners.url')}}</label>
                {!! Form::text('url', $banner->url, array('id' => 'url_banner', 'class' => 'form-control', 'maxlength' => 100, 'required' => false, 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description" class="control-label">{{__('banners.description')}}</label>
                {!! Form::textarea('description', $banner->description, ['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $banner->status, array('id' => 'status', Request::segment(3) == 'create' ? 'checked' : '')) !!}
                <label for="status">{{__('banners.active')}}</label>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                @if(Request::segment(3) != 'profile')
                    <a href="{{route(\App\Models\Banners::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    mn_selected = 'mn_banner';
</script>
@section('script')
@include('partials._formValidation')
@include('partials._select')
@include('partials._datetimepicker')
@include('partials._bootstrap_fileupload')
<script type="text/javascript">
    var link = '{{ $banner->link }}';
    var Banner = {
        CONSTS: {
            URL_KEY_EXIST: '{{ route("banner-title-exist") }}',
        },
        SELECTORS: {
            frm: '#form-banner',
        },
        init: function () {
            this.setUpEvent();
        },
        setUpEvent: function () {
            $(Banner.SELECTORS.frm).validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 6,
                        remote: {
                            url: Banner.CONSTS.URL_KEY_EXIST,
                            type: 'post',
                            data:{
                            title: function(){
                                    return $('input[name = "title"]').val();
                            },
                            id: function() {
                                    return $('#form-banner').data('id');;
                            }
                            },
                        },
                    },
                    link: {
                       required: checkImageRequired(link),
                    },
                    description: {
                        maxlength: 255,
                    },
                    url:{
                        regex: true,
                    },
                },
                messages: {
                    title: {
                        required: "{{__("banners.validation.title_empty")}}",
                        minlength: "{{ __("banners.validation.title_min", ['amount' => 6]) }}",
                        remote: "{!!__("banners.validation.title_exist", ['title' => '{0}'])!!}",
                    },
                    link: {
                        required: "{{__("banners.validation.link_empty")}}",
                    },
                    description: {
                        maxlength: "{!! __("banners.validation.description_max", ['amount' => 255]) !!}",
                    },
                    url:{
                        regex: "{{__("banners.validation.url_regex")}}",
                    },
                }
            })
            $(Banner.SELECTORS.frm).submit(function(){
                $('.error').removeAttr('hidden');
            })
        }
    }

    $('.btn_save').click(function (){
        let removeImg = $('#remove_img').val();
        $('#file_link-error').html('{{__("banners.validation.link_empty")}}')
        $('#file_link-error').css('display', '')
        return !removeImg;
    });

    $(function () {
        Banner.init();
        $.validator.addMethod(
        "regex",
            function is_valid_url(url, element) {
                return this.optional(element) || /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
            }
        );
    });
</script>
@endsection
