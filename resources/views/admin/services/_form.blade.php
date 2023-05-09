<div class="container-fluid" >
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="logos" class="control-label required">{{__('services.logo')}}</label>
                <div class="fileupload fileupload-new " data-provides="fileupload">
                    <div class="fileupload-new thumbnail user-form-image">
                        <div class="image-box">
                            <input type="hidden" name="remove_img" id="remove_img">
                            <img src="{{ $service->logo_url }}" alt="image" class="image-upload"/>
                            @if(getFilenameFromUrl($service->logo_url) != \App\Libs\Constants::$image_default)
                                <a href="javascript:;" class="btn btn-danger btn-xs btn_del_img"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail posts thumbnail_posts"></div>
                    <div>
                        <span class="btn btn-file  btn-primary">
                            <span class="fileupload-new">{{__('common.choose')}}</span>
                            <span class="fileupload-exists">{{__('common.change')}}</span>
                            <input type="file" name="logo" id="logo" class="upload_img" accept="image/x-png,image/jpeg" />
                        </span>
                        <a href="javascript:;" class="btn fileupload-exists" data-dismiss="fileupload">{{__('common.delete')}}</a>
                    </div>
                    <label id="logo-error" class="error" for="logo"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label required">{{__('course_categories.title')}}</label>
                {!! Form::text('title', $service->title, array('id'=>'title', 'class' => 'form-control', 'maxlength' => 100, 'required' => true, 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
    </div>
    <div class="form-group mt-2">
        <label for="description" class="control-label required">{{__('services.description')}}</label>
        {!! Form::textArea('description', $service->description, array('id'=>'description', 'class' => 'form-control', 'maxlength' => 999,  'rows' => 5, 'autofocus' => true, 'autocomplete' => 'off')) !!}
    </div>

    <h4>{{__('services.link')}}</h4>
    <button type="button" name="add" id="add" class="btn btn-primary mb-2 mt-2">{{__('common.add')}}</button>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table class="table table-bordered table-hover" id="dynamic_field">
                    <tr id="tr_head">
                        <td>
                            <label for="icon" class="control-label required">{{__('services.icon')}}</label>
                        </td>
                        <td>
                            <label for="name" class="control-label required">{{__('services.name')}}</label>
                        </td>
                        <td>
                            <label for="url" class="control-label required">{{__('services.url')}}</label>
                        </td>
                        <td class="text-center align-middle">{{ trans('common.action') }}</td>
                    </tr>
                    @if ($service->count > 0)
                        @foreach($service->link as $key => $value)
                            <tr id="rowupdate{{$service->id}}">
                                <td id="td_icon{{$key+1}}">
                                    <div class="d-flex">
                                        <img src="{{$service->icon_url[$key]}}" width="40px" height="40px" alt="">
                                        <input type="file" name="icons[]" class="form-control m-input" accept="image/x-png,image/jpeg" id="icon{{$key+1}}"/>
                                    </div>
                                </td>
                                <td id="td_name{{$key+1}}">
                                    {!! Form::text('names[]', $value->name, array('class' => 'form-control', 'maxlength' => 25, 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => __('services.name'), 'id' => 'name'.($key+1))) !!}
                                </td>
                                <td id="td_url{{$key+1}}">
                                    {!! Form::text('urls[]', $value->url, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => __('services.url'), 'id' => 'url'.($key+1))) !!}
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" name="remove" id="update{{$service->id}}" class="btn btn-danger btn_remove">X</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td id="td_icon1">
                                <div class="d-flex">
                                    <img src="{{ asset('/images/default.jpg') }}" width="40px" height="40px" alt="">
                                    <input type="file" name="icons[]" id="icon1" class="form-control m-input" accept="image/x-png,image/jpeg" />
                                </div>
                            </td>
                            <td id="td_name1">
                                {!! Form::text('names[]', null, array('class' => 'form-control', 'autofocus' => true, 'maxlength' => 25, 'autocomplete' => 'off', 'placeholder' => __('services.name'), 'id' => 'name1')) !!}
                            </td>
                            <td id="td_url1">
                                {!! Form::text('urls[]', null, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => __('services.url'), 'id' => 'url1')) !!}
                            </td>
                            <td class="text-center align-middle"></td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $service->status ?? 1, array('id' => 'status')) !!}
                <label for="status">{{__('common.is_visible')}}</label>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                <a href="{{route(\App\Models\Service::LIST)}}"  class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
            </div>
        </div>
    </div>
</div>
@php
    if (Request::segment(3) == 'edit'){
        $edit = true;
    }
@endphp
<script>
    mn_selected = 'mn_services';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._bootstrap_fileupload')
    @include('partials.validation_number')
    <script  type="text/javascript">
        var routeTitle = "{{ route('services.exist') }}";
         $("#form_services").validate({
            rules: {
                logo: {
                    checkIconRequired: true,
                },
                title: {
                    required: true,
                    minlength: 5,
                    remote:{
                        url : routeTitle,
                        type: "post",
                        data: {
                            title: function() {
                                return $( "#title" ).val();
                            },
                            id: function() {
                                return "{{ $service->id }}";
                            },
                        },
                        dataType: 'json',
                    }
                },
                description: {
                    required: true,
                },
            },
            messages: {
                logo: {
                    checkIconRequired: '{{ trans('services.validation.logo_empty') }}'
                },
                title: {
                    required: "{{__("services.validation.title_empty")}}",
                    minlength: "{{__("services.validation.title_min", ['amount' => 5])}}",
                    remote: "{!!__("services.validation.title_exist", ['title' => '{0}'])!!}",
                },
                description:{
                    required: "{{__("services.validation.description_empty")}}",
                },
            },
            submitHandler: function(form) {
                form.submit();
                $('.btn_save').attr('disabled', true)
            }
        });

        $('.btn_save').click(function (){
            let removeImg = $('#remove_img').val()
            let logo = $('#logo').val();
            let extensions = logo.split('.').pop().toLowerCase();
            if (logo){
                if ($.inArray(extensions, ['png', 'jpeg', 'jpg']) == -1) {
                    $('#logo-error').html('{{__("services.validation.logo_mimes")}}')
                    $('#logo-error').css('display', '')
                }
            }else{
                if (removeImg){
                    $('#logo-error').html('{{__("services.validation.logo_empty")}}')
                    $('#logo-error').css('display', '')
                }
            }
            return !removeImg;
        });

        jQuery.validator.addMethod("checkIconRequired", function() {
            let removeImg = '{{ $service->logo }}';
            let logo = $('#logo').val();
            if (removeImg == '' && logo == ''){
                return false;
            }
            return true;
        });


        $(document).ready(function() {
            var max_rows   = 50;
            var wrapper    = $("#dynamic_field");
            var add_button = $("#add");
            var x = 1;
            var icon = "{{__('services.icon')}}";
            var name = "{{__('services.name')}}";
            var url = "{{__('services.url')}}";
            var img_default = "{{ asset('/images/default.jpg') }}";
            var edit = "{{$edit ?? 0}}";
            if (edit == true){
                let count = $('#dynamic_field tbody tr').length;
                x = count - 1;
            }
            $(add_button).click(function(e){
                e.preventDefault();
                if(x < max_rows){
                    x++;
                    $(wrapper).append('<tr id="tr'+x+'">' +
                        '<td id="td_icon'+x+'"><div class="d-flex"><img src="'+img_default+'" width="40px" height="40px" alt=""><input type="file" id=\"icon'+x+'\" name="icons[]" class="form-control m-input" placeholder=\"'+icon+'\" autocomplete="off"/></div></td>' +
                        '<td id="td_name'+x+'"><input type="text" id=\"name'+x+'\" name="names[]" class="form-control" placeholder=\"'+name+'\" autocomplete="off" maxlength="25"/></td>' +
                        '<td id="td_url'+x+'"><input type="text" id=\"url'+x+'\" name="urls[]" class="form-control" placeholder=\"'+url+'\" autocomplete="off"/></td>' +
                        '<td class="text-center align-middle"><button type="button" class="btn btn-danger btn_remove">X</button></td>' +
                        '</tr>');
                }
            });
            $(wrapper).on("click",".btn_remove", function(e){
                e.preventDefault(); $(this).parent().parent().remove();
                // x--;
                var rowCount = $("#dynamic_field tr").length;
                if(rowCount>2){
                    $('#dynamic_field tr:last td:last-child').html('<button type="button" class="btn btn-danger btn_remove">X</button></td>');
                }
                if (rowCount == 1){
                    var y = 1
                    $(wrapper).append('<tr id="tr'+y+'">' +
                        '<td id="td_icon'+y+'"><div class="d-flex"><img src="'+img_default+'" width="40px" height="40px" alt=""><input type="file" id=\"icon'+y+'\" name="icons[]" class="form-control m-input" placeholder=\"'+icon+'\" autocomplete="off"/></div></td>' +
                        '<td id="td_name'+y+'"><input type="text" id=\"name'+y+'\" name="names[]" class="form-control" placeholder=\"'+name+'\" autocomplete="off" maxlength="25"/></td>' +
                        '<td id="td_url'+y+'"><input type="text" id=\"url'+y+'\" name="urls[]" class="form-control" placeholder=\"'+url+'\" autocomplete="off"/></td>' +
                        '<td class="text-center align-middle"><button type="button" class="btn btn-danger btn_remove">X</button></td>' +
                        '</tr>');
                }
            });
        });

        $(".btn_save").click(function(e){
            $("#dynamic_field tbody tr td").removeClass("has-error");
            $(".errors").remove();
            var error_list = "";
            for (i = 1; i <= 50; i++) {
                if ($('#icon' + i).length > 0) {
                    if ($.trim($("#icon" + i).val()) === "") {
                        let edit = "{{$edit ?? 0}}";
                        let src = $('#td_icon'+i).find('img').attr('src');
                        if (edit == 0 || src.slice(-11, -1) == 'default.jp'){
                            $('#td_icon' + i).addClass('has-error');
                            $('#td_icon' + i).append('<span class="error errors">{{__('common.required')}}</span>');
                            error_list = 1;
                        }
                    }else{
                        let icon = $('#icon'+i).val();
                        let extensions = icon.split('.').pop().toLowerCase();
                        if ($.inArray(extensions, ['png', 'jpeg', 'jpg']) == -1) {
                            $('#td_icon' + i).addClass('has-error');
                            $('#td_icon' + i).append('<span class="error errors">{{__('common.validation.mimes')}}</span>');
                            error_list = 1;
                        }
                    }

                    if ($.trim($("#name" + i).val()) === "") {
                        $('#td_name' + i).addClass('has-error');
                        $('#td_name' + i).append('<span class="error errors">{{__('common.required')}}</span>');
                        error_list = 1;
                    }else if(($.trim($("#name" + i).val())).length < 3) {
                        $('#td_name' + i).addClass('has-error');
                        $('#td_name' + i).append('<span class="error errors">{{__('common.validation.min', ['amount' => 3])}}</span>');
                        error_list = 1;
                    }
                    if ($.trim($("#url" + i).val()) === "") {
                        $('#td_url' + i).addClass('has-error');
                        $('#td_url' + i).append('<span class="error errors">{{__('common.required')}}</span>');
                        error_list = 1;
                    }else{
                        let url = $('#url'+i).val();
                        let checkUrl = /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
                        if (checkUrl == false){
                            $('#td_url' + i).addClass('has-error');
                            $('#td_url' + i).append('<span class="error errors">{{__('common.validation.format_url')}}</span>');
                            error_list = 1;
                        }
                    }
                }
            }
            if (error_list != ''){
                return false;
            }
        });
    </script>
@endsection
