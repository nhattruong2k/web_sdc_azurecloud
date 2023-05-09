<div class="container-fluid" >
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label">{{__('category.avatar')}}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $category->image_url }}" alt="image" class="image-upload"/>
                            @if(getFilenameFromUrl($category->image_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts thumbnail_posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="image" accept="image/x-png,image/jpeg" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title" class="control-label required">{{__('category.title')}}</label>
                {!! Form::text('title', $category->title, array('id'=>'title_category', 'class' => 'form-control', 'required' => true, 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="control-label">{{__('category.parent_id')}}</label>
                <select name="parent_id" id="category" class="form-control search-selecte-category">
                    <option value="0">{{__('category.parent_id')}}</option>
                        @php
                            echo $category->parent
                        @endphp
                </select>
            </div>
        </div>
    </div>
    <div class="form-group mt-2">
        <label for="summary" class="control-label">{{__('category.summary')}}</label>
        {!! Form::textArea('summary', $category->summary, array('id'=>'summary_category', 'class' => 'form-control','cols'=>10,'rows'=>5, 'autofocus' => true, 'autocomplete' => 'off')) !!}
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="order_by" class="control-label required">{{__('category.order_by')}}</label>
                {!! Form::text('order_by', $category->order_by ?? 0, array('id'=>'order_by', 'maxlength'=> 4,'class' => 'form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('is_show_menu', 1, $category->is_show_menu ?? 1, array('id' => 'is_show_menu')) !!}
                <label for="is_show_menu">{{__('category.is_show_menu')}}</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $category->status ?? 1, array('id' => 'status')) !!}
                <label for="status">{{__('category.active')}}</label>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                <a href="{{route(\App\Models\Category::LIST)}}"  class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
            </div>
        </div>
    </div>
</div>
<script>
    mn_selected = 'mn_category';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._bootstrap_fileupload')
    @include('partials.validation_number')
    <script  type="text/javascript">
    mn_selected = 'mn_category';
        var routeTitle = "{{ route('title-exist') }}";
         $("#form-category").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 5,
                    maxlength: 100,
                    remote:{
                        url : routeTitle,
                        type: "post",
                        data: {
                            title: function() {
                                return $( "#title_category" ).val();
                            },
                            id: function() {
                                return $('#form-category').data('id');
                            },
                        },
                        dataType: 'json',
                    }
                },
                summary: {
                    minlength: 3,
                    maxlength: 255,
                },
                order_by: {
                    required: true,
                    maxlength: 3,
                }
            },
            messages: {
                title: {
                    required: "{{__("category.title_empty")}}",
                    minlength: "{{__("category.title_minlength")}}",
                    maxlength: "{{__("category.title_maxlength")}}",
                    remote: "{!!__("category.title_exist", ['title' => '{0}'])!!}",
                },
                summary:{
                    minlength: "{{__("category.summary_minlength")}}",
                    maxlength: "{{__("category.summary_maxlength")}}",
                },
                order_by: {
                    required: "{{__("category.order_by_required")}}",
                    maxlength: "{{__("category.order_by_maxlength")}}",
                }
            },
            submitHandler: function(form) {
                form.submit();
                $('#btn_save').attr('disabled', true)
            }
        });
        setInputFilter(document.getElementById("order_by"), function(value) {
        return /^\d*$/.test(value);
    });
    </script>

    <script>
        $('#status').change(function(){
            var status = $(this).val();
            var _url = "{{route('category.status')}}";
            $.ajax({
                    type: "post",
                    url: _url,
                    data: {status: status},
                    success: function (data, success) {
                    }
                });
        })
        $(document).ready(function(){
            $('.search-selecte-category').select2({
                placeholder: "{{ __('news.category') }}",
            });
        });
    </script>
@endsection
