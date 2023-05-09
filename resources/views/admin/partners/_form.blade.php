<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @if(Route::currentRouteName() == \App\Models\Partners::CREATE)
                     <label for="image" class="control-label required">{{__('partners.image')}}</label>
                @elseif (Route::currentRouteName() == \App\Models\Partners::UPDATE)
                    <label for="image" class="control-label ">{{__('partners.image')}}</label>
                @endif
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $partner->image_url }}" class="image-upload" alt=""/>
                            @if(getFilenameFromUrl($partner->image_url) != \App\Libs\Constants::$image_default)
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
                <label for="title" class="control-label required">{{__('partners.title')}}</label>
                {!! Form::text('title', $partner->title, array('class' => 'form-control', 'maxlength' => 50, 'required' => false, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'title', 'value' => '123')) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description" class="control-label">{{__('partners.description')}}</label>
                {!! Form::textarea('description', $partner->description, ['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $partner->status, array('id' => 'status', Request::segment(3) == 'create' ? 'checked' : '')) !!}
                <label for="status">{{__('partners.active')}}</label>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                @if(Request::segment(3) != 'profile')
                    <a href="{{route(\App\Models\Partners::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    mn_selected = 'mn_partners'
</script>
@section('script')
@include('partials._formValidation')
@include('partials._select')
@include('partials._datetimepicker')
@include('partials._bootstrap_fileupload')
<script type="text/javascript">
    var image = '{{ $partner->image }}';
    var Partner = {
        CONSTS: {
            URL_KEY_EXIST: '{{ route("partners.title-exist") }}',
        },
        SELECTORS: {
            frm: '#form-partners'
        },
        init: function () {
            this.setUpEvent();
        },
        setUpEvent: function () {
            $(Partner.SELECTORS.frm).validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        remote: {
                            url: Partner.CONSTS.URL_KEY_EXIST,
                            type: 'post',
                            data:{
                                'title': function (){
                                    return $('#title').val();
                                },
                                'id': function (){
                                    return '{{ $partner->id }}';
                                }
                            }
                        }
                    },
                    image: {
                        required: checkImageRequired(image),
                    },
                },
                messages: {
                    image: {
                        required: "{!! __("partners.validation.image_empty") !!}",
                    },
                    title: {
                        required: "{!! __("partners.validation.title_empty") !!}",
                        minlength: "{!! __("partners.validation.title_min", ['amount' => 3]) !!}",
                        remote: "{!!__("partners.validation.title_exist", ['title' => '{0}'])!!}"
                    }
                },
            });
            $(Partner.SELECTORS.frm).submit(function(){
                $('.error').removeAttr('hidden');
            })
        }
    }
    $(function () {
        Partner.init();
        $('.btn_save').click(function (){
            let removeImg = $('#remove_img').val();
            $('#file_image-error').html('{!! __("partners.validation.image_empty") !!}')
            $('#file_image-error').css('display', '')
            return !removeImg;
        });
    });
</script>
@endsection
