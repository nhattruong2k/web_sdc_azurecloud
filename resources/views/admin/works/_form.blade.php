<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label">{{ __('works.image') }}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $work->image_url }}" alt="image" class="image-upload" />
                            @if (getFilenameFromUrl($work->image_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i
                                        class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts thumbnail_posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{ __('common.choose') }}</span>
                            <span class="fileupload-exists">{{ __('common.change') }}</span>
                            <input type="file" name="image" class="upload_img" accept="image/x-png,image/jpeg" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists"
                            data-dismiss="fileupload">{{ __('common.delete') }}</a>
                    </div>
                    <span class="upload_img_error error d-none">{{ trans('common.validation.mimes') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title" class="control-label required">{{ __('works.title') }}</label>
                {!! Form::text('title', $work->title, [
                    'class' => 'form-control',
                    'maxlength' => 100,
                    'required' => true,
                    'autofocus' => true,
                    'autocomplete' => 'off',
                    'id' => 'title',
                ]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="control-label required">{{ __('works.category') }}</label>
                <select name="course_category_id" id="course_category_id"
                    class="form-control search-selecte-category bg-white">
                    <option value="">{{ __('common.choose') }}</option>
                    @php
                        echo $courseCategories;
                    @endphp
                </select>
                <label id="course_category_id-error" class="error hidden" for="course_category_id"></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="time" class="control-label required">{{ __('works.time') }}</label>
                {!! Form::text('time', $work->time, [
                    'class' => 'form-control',
                    'maxlength' => 50,
                    'id' => 'time',
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="degree" class="control-label required">{{ __('works.degree') }}</label>
                {!! Form::text('degree', $work->degree, [
                    'class' => 'form-control',
                    'maxlength' => 50,
                    'id' => 'degree',
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="object" class="control-label required">{{ __('works.object') }}</label>
                {!! Form::text('object', $work->object, [
                    'class' => 'form-control',
                    'maxlength' => 50,
                    'id' => 'object',
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description" class="control-label">{{ __('common.description') }}</label>
                {!! Form::textArea('description', $work->description, [
                    'class' => 'form-control',
                    'maxlength' => 255,
                    'id' => 'description',
                    'autofocus' => true,
                    'autocomplete' => 'off',
                    'rows' => '3',
                ]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="content" class="control-label required">{{ __('common.content') }}</label>
                {!! Form::textArea('content', $work->content, [
                    'class' => 'form-control',
                    'id' => 'content',
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
                <label id="content-error" class="error mt-1" for="content"></label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="keyword" class="control-label required">{{ __('common.keyword') }}</label>
                {!! Form::text('keyword', $work->keyword, ['class' => 'form-control', 'id' => 'keyword', 'maxlength' => 165]) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $work->status ?? 1, ['id' => 'is_visible']) !!}
                <label for="is_visible">{{ __('common.is_visible') }}</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btn_save"><i class="fa fa-save"></i>
                    {{ __('common.save') }}</button>
                <a href="{{ route(\App\Models\Work::LIST) }}" class="btn btn-default"><i class="fa fa-reply"></i>
                    {{ __('common.return') }}</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    mn_selected = 'mn_works';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._bootstrap_fileupload')
    @include('partials.tags')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.search-selecte-category').select2({
                placeholder: "{{ __('consultations.course') }}",
            });
        });
        $(document).ready(function() {
            $('#keyword').tagsinput('items');
        });

        $(function() {
            var content = CKEDITOR.replace('content');
            content.on('change', function(e) {
                $changeditor = CKEDITOR.instances.content.getData();
                $changeditor != '' ? $('#content-error').css('display', 'none') : $('#content-error').css(
                    'display', 'block');
            });

        });
        var Work = {
            GLOBAL: {
                msgDeleteSuc: '@Messages.SUC_DELETE',
            },
            SELECTORS: {
                frm: '#form-work',
            },
            init: function() {
                this.setUpEvent();
            },
            setUpEvent: function() {
                $(Work.SELECTORS.frm).validate({
                    ignore: [],
                    rules: {
                        title: {
                            required: true,
                            minlength: 4,
                            maxlength: 100,
                        },
                        course_category_id: {
                            required: true,
                        },
                        time: {
                            required: true,
                        },
                        degree: {
                            required: true,
                        },
                        object: {
                            required: true,
                        },
                        content: {
                            required: function() {
                                return CKEDITOR.instances.content.updateElement();
                            }
                        },
                        keyword: {
                            required: true,
                            maxlength: 165,
                        },
                    },
                    messages: {
                        title: {
                            required: "{{ __('works.validation.title_empty') }}",
                            minlength: "{{ __('works.validation.title_min', ['amount' => 4]) }}",
                            maxlength: "{{ __('works.validation.title_max', ['amount' => 100]) }}",
                        },
                        course_category_id: {
                            required: "{{ trans('works.validation.course_category_id_empty') }}",
                        },
                        time: {
                            required: "{{ trans('works.validation.time_empty') }}",
                        },
                        degree: {
                            required: "{{ trans('works.validation.degree_empty') }}",
                        },
                        object: {
                            required: "{{ trans('works.validation.object_empty') }}",
                        },
                        description: {
                            minlength: "{{ trans('works.validation.description_min', ['amount' => 5]) }}",
                            maxlength: "{{ trans('works.validation.description_max', ['amount' => 255]) }}",
                        },
                        content: {
                            required: "{{ trans('works.validation.content_empty') }}",
                        },
                        keyword: {
                            required: "{{ __('works.validation.keyword_empty') }}",
                            maxlength: "{{ __('works.validation.keyword_max', ['amount' => 165]) }}",
                        },
                    },
                    submitHandler: function(form) {
                        form.submit();
                        $('#btn_save').attr('disabled', true)
                    }
                })
            }
        }
        $(function() {
            Work.init();
        })
    </script>
@endsection
