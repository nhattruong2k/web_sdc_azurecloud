<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @if(Route::currentRouteName() == \App\Models\StatistNumber::CREATE)
                    <label for="icon" class="control-label required">{{ __('statistnumber.icon') }} {{ __('statistnumber.font_size')}}</label>
                @elseif (Route::currentRouteName() == \App\Models\StatistNumber::UPDATE)
                    <label for="icon" class="control-label">{{ __('statistnumber.icon') }} {{ __('statistnumber.font_size')}}</label>
                @endif
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $numbers->icon_urls }}" alt="icon" class="image-upload" id="fontawesome_picture" />
                            @if(getFilenameFromUrl($numbers->icon_urls) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts thumbnail_posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{ __('common.choose') }}</span>
                            <span class="fileupload-exists">{{ __('common.change') }}</span>
                            <input type="file" name="icon" accept="image/x-png,image/jpeg" id="file_image" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists"
                            data-dismiss="fileupload">{{ __('common.delete') }}</a>
                    </div>
                    <label id="file_image-error" class="error" for="file_image"></label>
                    <span id="validation-message" class="error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title" class="control-label required">{{ __('statistnumber.title') }}</label>
                {!! Form::text('title', $numbers->title, [
                    'id' => 'title_statist',
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
                <label for="figures" class="control-label required">{{ __('statistnumber.figures') }}</label>
                {!! Form::text('figures', $numbers->figures, [
                    'id' => 'figures',
                    'class' => 'form-control',
                    'maxlength' => 50,
                    'required' => true,
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
            </div>
        </div>
    </div>
    {{-- To do
    <div class="form-group">
        <label for="link" class="control-label required">{{__('statistnumber.link')}}</label>
        {!! Form::text('link', $numbers->link, array('class' => 'form-control', 'id'=>'text_box_url', 'required' => true, 'autofocus' => true, 'autocomplete' => 'off')) !!}
    </div> --}}
    <div class="form-group">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', App\Libs\Constants::$status['active'], $numbers->status ?? App\Libs\Constants::$status['active'], array('id' => 'status')) !!}
                <label for="status">{{__('statistnumber.status')}}</label>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btn_save"><i class="fa fa-save"></i>
                    {{ __('common.save') }}</button>
                <a href="{{ route(\App\Models\StatistNumber::LIST) }}" class="btn btn-default"><i
                        class="fa fa-reply"></i> {{ __('common.return') }}</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    mn_selected = 'mn_statistnumber';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._bootstrap_fileupload')
    <script>
        // To do
        // $.validator.addMethod(
        //     "regex",
        //     function is_valid_url(url) {
        //         return /^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
        //     }
        // );
        var routeStatist = "{{ route('titleStatist-exist') }}";
        var icon = $('#form-statistNumber').data('icon');
        function linkRequired(){
            if(icon){
                return false
            }else{
                return true
            }
        }
        let input = document.getElementById('file_image');
        let span = document.getElementById('validation-message');
            input.addEventListener('change', () => {
            let files = input.files;
            if (files.length > 0) {
                if (files[0].size > 250 * 250 || files[0].size < 150 * 150) {
                    span.innerText = "{{__('statistnumber.icon_dimensions')}}";
                    return $('#btn_save').attr('disabled', true);
                }
                span.innerText = '';
                return $('#btn_save').attr('disabled',false);
            }
        });
         $("#form-statistNumber").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 5,
                    remote: {
                        url : routeStatist,
                        type: "post",
                        data: {
                            title: function() {
                                return $( "#title_statist" ).val();
                            },
                            id: function() {
                                return '{{ $numbers->id }}';
                            },
                        },
                        dataType: 'json',
                    },
                },
                figures: {
                    required: true,
                    minlength: 2,
                },
                icon:{
                    required: linkRequired()
                },
                // To do
                // link:{
                //     required: true,
                //     regex: true,
                // }
            },
            messages: {
                title: {
                    required: "{{__("statistnumber.title_required")}}",
                    minlength: "{{__("statistnumber.title_min")}}",
                    remote: "{!!__("statistnumber.title_exist", ['title' => '{0}'])!!}",
                },
                figures: {
                    required: "{{__("statistnumber.figures_required")}}",
                    minlength: "{{__("statistnumber.figures_min")}}",
                },
                icon:{
                    required: "{{__("statistnumber.icon_required")}}",
                },
                // To do
                // link: {
                //     required: "{{__("statistnumber.required")}}",
                //     regex : "{{__("statistnumber.regex")}}"
                // }
            },
            submitHandler: function(form) {
                form.submit();
                $('#btn_save').attr('disabled', true)
            }
        });

        $('#btn_save').click(function (){
            let removeImg = $('#remove_img').val();
            $('#file_image-error').html('{{__("statistnumber.icon_required")}}')
            $('#file_image-error').css('display', '')
            return !removeImg;
        });

        $("#fontawesome_picture").click(function() {
            $("input[id='file_image']").click();
        });
    </script>

@endsection
