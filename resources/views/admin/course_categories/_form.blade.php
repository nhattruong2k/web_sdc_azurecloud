<div class="container-fluid" >
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label">{{__('course_categories.image')}}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $courseCategory->image_url }}" alt="image" class="image-upload"/>
                            @if(getFilenameFromUrl($courseCategory->image_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts thumbnail_posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="image" class="upload_img" accept="image/x-png,image/jpeg" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                    <span class="upload_img_error error d-none">{{ trans('common.validation.mimes') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label required">{{__('course_categories.title')}}</label>
                {!! Form::text('title', $courseCategory->title, array('id'=>'title_course_category', 'class' => 'form-control', 'maxlength' => 50, 'required' => true, 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
    </div>
    <div class="form-group mt-2">
        <label for="summary" class="control-label">{{__('course_categories.summary')}}</label>
        {!! Form::textArea('summary', $courseCategory->summary, array('id'=>'summary_category', 'class' => 'form-control','cols'=>10,'rows'=>5, 'autofocus' => true, 'autocomplete' => 'off')) !!}
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="order" class="control-label required">{{__('course_categories.order')}}</label>
                {!! Form::text('order', $courseCategory->order ?? 0, array('id'=>'order', 'class' => 'form-control', 'maxlength' => 3, 'required' => false, 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $courseCategory->status ?? 1, array('id' => 'status')) !!}
                <label for="status">{{__('common.is_visible')}}</label>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                <a href="{{route(\App\Models\CourseCategories::LIST)}}"  class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
            </div>
        </div>
    </div>
</div>
<script>
    mn_selected = 'mn_course_categories';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._bootstrap_fileupload')
    @include('partials.validation_number')
    <script  type="text/javascript">
    mn_selected = 'mn_category';
        var routeTitle = "{{ route('course_categories.title_exist') }}";
         $("#form_course_category").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 5,
                    remote:{
                        url : routeTitle,
                        type: "post",
                        data: {
                            title: function() {
                                return $( "#title_course_category" ).val();
                            },
                            id: function() {
                                return "{{ $courseCategory->id }}";
                            },
                        },
                        dataType: 'json',
                    }
                },
                summary: {
                    minlength: 15,
                },
                order: {
                    required: true,
                }
            },
            messages: {
                title: {
                    required: "{{__("course_categories.validation.title_empty")}}",
                    minlength: "{{__("course_categories.validation.title_minlength")}}",
                    remote: "{!!__("course_categories.validation.title_exist", ['title' => '{0}'])!!}",
                },
                summary:{
                    minlength: "{{__("course_categories.validation.summary_minlength")}}",
                },
                order: {
                    required: "{{__("course_categories.validation.order_required")}}",
                }
            },
            submitHandler: function(form) {
                form.submit();
                $('#btn_save').attr('disabled', true)
            }
        });
        setInputFilter(document.getElementById("order"), function(value) {
        return /^\d*$/.test(value);
    });
    </script>
@endsection
