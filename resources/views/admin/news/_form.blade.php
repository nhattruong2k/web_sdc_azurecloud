<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label required">{{ __('news.avatar') }}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{$news->image_urls}}" alt="image" class="image-upload" id="fontawesome_picture"/>
                            @if(getFilenameFromUrl($news->image_urls) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts thumbnail_posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{ __('common.choose') }}</span>
                            <span class="fileupload-exists">{{ __('common.change') }}</span>
                            <input type="file" name="image" accept="image/x-png,image/jpeg" id="file_image" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists"
                            data-dismiss="fileupload">{{ __('common.delete') }}</a>
                    </div>
                    <label id="file_image-error" class="error" for="file_image"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="title" class="control-label required">{{ __('news.title') }}</label>
            {!! Form::text('title', $news->title, [
                'id' => 'title_news',
                'class' => 'form-control',
                'required' => true,
                'autofocus' => true,
                'autocomplete' => 'off',
            ]) !!}
        </div>
        <div class="form-group">
            <label for="summary" class="control-label required">{{ __('news.summary') }}</label>
            {!! Form::textArea('summary', $news->summary, [
                'id' => 'summary_news',
                'class' => 'form-control',
                'cols' => 10,
                'rows' => 5,
                'autofocus' => true,
                'autocomplete' => 'off',
            ]) !!}
        </div>
        <div class="form-group">
            <label for="content" class="control-label required">{{ __('news.content') }}</label>
            {!! Form::textArea('content', $news->content, [
                'id' => 'content_news',
                'name' => 'content',
                'class' => 'form-control contentEditor',
                'cols' => 10,
                'rows' => 8,
                'required' => true,
                'autofocus' => true,
                'autocomplete' => 'off',
            ]) !!}
            <label id="content_news-error" class="error mt-1" for="content_news" hidden="hidden"></label>
            <div id="content_error" class="error d-none"></div>
        </div>
        <div class="form-group">
            <label for="category_id" class="control-label required">{{ __('news.category') }}</label>
            <select name="category_id" id="category" class="form-control search-selecte-category" required>
                <option value="">{{ __('news.category') }}</option>
                @php
                    echo $news->parent;
                @endphp
            </select>
            <label id="category-error" class="error hidden" for="category"></label>
        </div>
        <div class="form-group">
            <label for="" class="control-label required">{{ __('news.created_date') }}</label>
            <input name="created_at" type="text" value="{{!is_null($news->created_at) ? $news->created_at->format('d-m-Y') : date('d-m-Y', time()) }}" id="created_at" class="form-control" maxlength="100" placeholder="{{ (Route::currentRouteName() == \App\Models\News::UPDATE) ? $news->created_at->format('d-m-Y') : date('d-m-Y', time()) }}" autofocus="true" autocomplete="off">
            <div id="created_error"></div>
        </div>
        <div class="form-group">
            <label for="keyword" class="control-label required">{{__('common.keyword')}}</label>
            {!! Form::text('keyword', $news->keyword, array('class' => 'form-control', 'id' => 'keyword', 'maxlength' => 165)) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('feature', 1, $news->feature, ['id' => 'feature']) !!}
                <label for="feature">{{ __('news.field') }}</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', App\Libs\Constants::$status['active'], $news->status ?? App\Libs\Constants::$status['active'], ['id' => 'status']) !!}
                <label for="status">{{ __('news.active') }}</label>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn_save"  id="btn_save"><i class="fa fa-save"></i>
                    {{ __('common.save') }}</button>
                <a href="{{ route(\App\Models\News::LIST) }}" class="btn btn-default"><i class="fa fa-reply"></i>
                    {{ __('common.return') }}</a>
            </div>
        </div>
    </div>
</div>
<script>
    mn_selected = 'mn_news';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._datepicker')
    @include('partials._bootstrap_fileupload')
    @include('partials.tags')
    <script src="{{ asset('adminlte\ckeditor\ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#keyword').tagsinput('items');
        });

        $("#fontawesome_picture").click(function() {
            $("input[id='file_image']").click();
        });
        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
        };
        var content = CKEDITOR.replace('content',options);
        var span = document.getElementById('content_error');
        content.on('change', function(e) {
            $changeditor = CKEDITOR.instances.content_news.getData();
            $changeditor != '' ? $('#content_news-error').css('display', 'none') : $('#content_news-error').css('display', 'block');

            $changeditorLength = CKEDITOR.instances.content_news.getData().replace(/<[^>]*>/gi, '').length;
            if($changeditorLength > 8 || $changeditorLength == 0){
                $("#content_error").attr('class', 'error d-none');
                return $('#btn_save').attr('disabled', false);
            }
            span.innerText = "{{__('news.content_minlength')}}";
            $("#content_error").removeClass("d-none");
            return $('#btn_save').attr('disabled', true);
        });

        var image = $('#form-new').data('image');

        function linkRequired() {
            if (image) {
                return false
            } else {
                return true
            }
        }
        var routeNews = "{{ route('titleNew-exist') }}";
        $("#form-new").validate({
            ignore: [],
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 250,
                    remote: {
                        url: routeNews,
                        type: "post",
                        data: {
                            title: function() {
                                return $("#title_news").val();
                            },
                            id: function() {
                                return $('#form-new').data('id');
                            },
                        },
                        dataType: 'json',
                    },
                },
                summary: {
                    required: true,
                    minlength: 15,
                    maxlength: 255,
                },
                content: {
                    required: function(textarea) {
                        return CKEDITOR.instances.content_news.updateElement();
                    }
                },
                category_id: {
                    required: true,
                },
                image: {
                    required: linkRequired(),
                },
                keyword: {
                    required: true,
                    max_length: 165,
                },
            },
            messages: {
                title: {
                    required: "{{ __('news.title_required') }}",
                    minlength: "{{ __('news.title_min') }}",
                    maxlength: "{{ __('news.title_max') }}",
                    remote: "{!! __('news.title_exist', ['title' => '{0}']) !!}",
                },
                summary: {
                    required: "{{ __('news.summary_required') }}",
                    minlength: "{{ __('news.summary_min') }}",
                    maxlength: "{{ __('news.summary_max') }}",
                },
                content: {
                    required: "{{ __('news.content_required') }}",
                },
                category_id: {
                    required: "{{ __('news.category_required') }}",
                },
                image: {
                    required: "{{ __('news.image_required') }}",
                },
                keyword: {
                    required: "{{ __('news.keyword_required') }}",
                    max_length: "{{ __('news.keyword_maxlength', ['amount' => 165]) }}",
                },
            },
            submitHandler: function(form) {
                form.submit();
                return $('#btn_save').attr('disabled', true);
            }
        });

        $('#btn_save').click(function(e) {
            $('.error').removeAttr('hidden');
        });

        $('#created_at').datepicker({
            format: 'dd-mm-yyyy',
        });

        $(document).ready(function(){
            var created_at = $('#created_at').val();
            $("#btn_save").click(function(e) {
                $("div.form-group #created_error").removeClass("has-error");
                $("span.error").remove();
                var error_list = "";
                if($.trim($('#created_at').val()) == ""){
                    $('#created_error').addClass('has-error');
                    $('#created_error').append('<span class="error">{{ trans('common.required') }}</span>');
                    error_list = 1;
                }

                $("div.form-group #created_error").removeClass("has-error");
                var error_list = "";
                if($.trim($("#created_at").val()) !== ""){
                var created_at = $('#created_at').val();
                var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
                if (created_at.match(dateformat)) {
                    var seperator = created_at.split('-');
                    if (seperator.length > 1) {
                        var splitdate = created_at.split('-');
                    }
                    var dd = parseInt(splitdate[0]);
                    var mm = parseInt(splitdate[1]);
                    var yy = parseInt(splitdate[2]);
                    // Create list of days of a month [assume there is no leap year by default]
                    var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                    if (mm == 1 || mm > 2) {
                        if (dd > ListofDays[mm - 1]) {
                            $('#created_error').addClass('has-error');
                            $('#created_error').append(
                                '<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                            error_list = 1;
                        }
                    }
                    if (mm == 2) {
                        var lyear = false;
                        if ((!(yy % 4) && yy % 100) || !(yy % 400)) {
                            $('#created_error').addClass('has-error');
                            $('#created_error').append(
                                '<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                            lyear = true;
                        }
                        if ((lyear == false) && (dd >= 29)) {
                            $('#created_error').addClass('has-error');
                            $('#created_error').append(
                                '<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                            error_list = 1;
                        }
                        if ((lyear == true) && (dd > 29)) {
                            $('#created_error').addClass('has-error');
                            $('#created_error').append(
                                '<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                            error_list = 1;
                        }
                    }
                } else {
                    $('#created_error').addClass('has-error');
                    $('#created_error').append('<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                    error_list = 1;
                }
            }
            if (error_list != ''){
                    return false;
            }
            });
        });

        $('#btn_save').click(function (){
            let removeImg = $('#remove_img').val();
            $('#file_image-error').html('{{__("news.image_required")}}')
            $('#file_image-error').css('display', '')
            return !removeImg;
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.search-selecte-category').select2({
                placeholder: "{{ __('news.category') }}",
            });
        });
    </script>
@endsection
