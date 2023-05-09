<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="course_id" class="control-label required">{{__('opening_schedules.course')}}</label>
                {!! Form::select('course_id', $courses, $opening_schedule->course_id, array('class' => 'form-control bg-white', 'maxlength' => 100, 'required' => true, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'course_id')) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lecturers" class="control-label required">{{__('opening_schedules.lecturers')}}</label>
                {!! Form::text('lecturers', $opening_schedule->lecturers, array('class' => 'form-control', 'maxlength' => 100, 'required' => true, 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'lecturers')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tuition" class="control-label required">{{__('opening_schedules.tuition')}}</label>
                {!! Form::text('tuition', $opening_schedule->tuition, array('class' => 'form-control', 'id' => 'tuition', 'autofocus' => true, 'autocomplete' => 'off')) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="preferential_tuition" class="control-label">{{__('opening_schedules.preferential_tuition')}}</label>
                {!! Form::text('preferential_tuition', $opening_schedule->preferential_tuition, array('class' => 'form-control', 'id' => 'preferential_tuition', 'autofocus' => true, 'autocomplete' => 'off')) !!}
                <label id="preferential_tuition_error" class="error" for="preferential_tuition"></label>
            </div>
        </div>
    </div>

    <h4>{{__('opening_schedules.detail')}}</h4>
    <button type="button" name="add" id="add" class="btn btn-primary mb-2 mt-2">{{__('common.add')}}</button>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table class="table table-bordered table-hover" id="dynamic_field">
                    <tr id="tr_head">
                        <td>
                            <label for="name" class="control-label required">{{__('opening_schedules.name')}}</label>
                        </td>
                        <td>
                            <label for="open_time" class="control-label required">{{__('opening_schedules.open_time')}}</label>
                        </td>
                        <td>
                            <label for="study_time" class="control-label required">{{__('opening_schedules.study_time')}}</label>
                        </td>
                        <td>
                            <label for="counselors" class="control-label required">{{__('opening_schedules.counselors')}}</label>
                        </td>
                        <td class="text-center align-middle">{{ trans('common.action') }}</td>
                    </tr>
                    @if ($opening_schedule->count > 0)
                        @foreach($opening_schedule->data as $key => $value)
                            <tr id="rowupdate{{$opening_schedule->id}}">
                                <td id="td_name{{$key+1}}">
                                    {!! Form::text('names[]', $value->name, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => __('opening_schedules.name'), 'id' => 'name'.($key+1))) !!}
                                </td>
                                <td id="td_open_time{{$key+1}}">
                                    {!! Form::text('open_times[]', $value->open_time, array('class' => 'form-control open_time', 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => 'dd/mm/yyyy', 'id' => 'open_time'.($key+1))) !!}
                                </td>
                                <td id="td_study_time{{$key+1}}">
                                    {!! Form::text('study_times[]', $value->study_time, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => __('opening_schedules.study_time'), 'id' => 'study_time'.($key+1))) !!}
                                </td>
                                <td id="td_counselors{{$key+1}}">
                                    {!! Form::select('counselors[]', $users, $value->counselor_id, array('class' => 'form-control select2-code bg-white', 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'counselors'.($key+1))) !!}
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" name="remove" id="update{{$opening_schedule->id}}" class="btn btn-danger btn_remove">X</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td id="td_name1">
                                {!! Form::text('names[]', null, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => __('opening_schedules.name'), 'id' => 'name1')) !!}
                            </td>
                            <td id="td_open_time1">
                                {!! Form::text('open_times[]', null, array('class' => 'form-control open_time', 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => 'dd/mm/yyyy', 'id' => 'open_time1')) !!}
                            </td>
                            <td id="td_study_time1">
                                {!! Form::text('study_times[]', null, array('class' => 'form-control', 'autofocus' => true, 'autocomplete' => 'off', 'placeholder' => __('opening_schedules.study_time'), 'id' => 'study_time1')) !!}
                            </td>
                            <td id="td_counselors1">
                                {!! Form::select('counselors[]', $users, null, array('class' => 'form-control select2-code bg-white', 'autofocus' => true, 'autocomplete' => 'off', 'id' => 'counselors1')) !!}
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
                {!! Form::checkbox('status', 1, $opening_schedule->status ?? 1, array('id' => 'is_visible')) !!}
                <label for="is_visible">{{__('common.is_visible')}}</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn_save" id="btn_save"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                <a href="{{route(\App\Models\OpeningSchedule::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 d-none" id="get-select-option">
    {!! Form::select('counselors[]', $users, null, array('class' => 'form-control select2-code bg-white', 'autofocus' => true, 'autocomplete' => 'off')) !!}
</div>
<script type="text/javascript">
    mn_selected = 'mn_opening_schedules';
</script>
@section('script')
@include('partials._formValidation')
@include('partials._setInputFilter')
@include('partials._datepicker')
@include('partials._bootstrap_fileupload')
<script type="text/javascript">
    $(function() {
        function formatMoney(amount, thousands = ",") {
            try {
                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) ;
            } catch (e) {
                console.log(e)
            }
        };
        var tuition = $('#tuition');
        var preferential_tuition = $('#preferential_tuition');
        function setFormatTuition(selector){
            var money = selector.val();
            money = formatMoney(money);
            selector.val(money);
        }
        setFormatTuition(tuition);
        setFormatTuition(preferential_tuition);

        $('#tuition').on('blur', function() {
            setFormatTuition(tuition);
        });
        $('#preferential_tuition').on('blur', function(){
            setFormatTuition(preferential_tuition);
        })
        
        
        $("#form_opening_schedule").validate({
            rules: {
                course_id: {
                    required: true,
                    remote: {
                        type: 'post',
                        url: '{{ route('opening_schedules.exist') }}',
                        data: {
                            'course_id': function () {
                                return $('#course_id').val();
                            },
                            'id': function () {
                                return '{{ $opening_schedule->id }}';
                            }
                        }
                    },
                },
                lecturers: {
                    required:  true,
                    minlength: 3,
                },
                tuition: {
                    required:  true,
                    checkMinTuition: true,
                    maxLengthTuition: true,
                },
                preferential_tuition: {
                    checkWithTuition: true,
                },
            },
            messages: {
                course_id: {
                    required: "{{__("opening_schedules.validation.course_empty")}}",
                    remote: "{{ trans('opening_schedules.validation.course_exist') }}"
                },
                lecturers: {
                    required: "{{__("opening_schedules.validation.lecturers_empty")}}",
                    minlength: "{{__("opening_schedules.validation.lecturers_min", ['amount' => 3])}}"
                },
                tuition: {
                    required: "{{__("opening_schedules.validation.tuition_empty")}}",
                    checkMinTuition: "{{__("opening_schedules.validation.tuition_min_val", ['amount' => 1000])}}",
                    maxLengthTuition: "{{ __("opening_schedules.validation.tuition_maxlength", ['amount' => 9]) }}",
                },
                preferential_tuition: {
                    checkWithTuition: "{{__("opening_schedules.validation.preferential_tuition_max")}}",
                },
            },
            submitHandler: function (form) {
                form.submit();
                $('#btn_save').attr('disabled', true)
            }
        });


        $(document).ready(function() {
            let htmlSelectMaterialType = $('#get-select-option').html();
            var max_rows   = 50;
            var wrapper    = $("#dynamic_field");
            var add_button = $("#add");
            var x = 1;
            var name = "{{__('opening_schedules.name')}}";
            var open_time = "{{__('opening_schedules.open_time')}}";
            var study_time = "{{__('opening_schedules.study_time')}}";
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
                        '<td id="td_name'+x+'"><input type="text" id=\"name'+x+'\" name="names[]" class="form-control" placeholder=\"'+name+'\" autocomplete="off"/></td>' +
                        '<td id="td_open_time'+x+'"><input type="text" id=\"open_time'+x+'\" name="open_times[]" class="form-control open_time" placeholder="dd/mm/yyyy" autocomplete="off"/></td>' +
                        '<td id="td_study_time'+x+'"><input type="text" id=\"study_time'+x+'\" name="study_times[]" class="form-control" placeholder=\"'+study_time+'\" autocomplete="off"/></td>' +
                        '<td id="td_counselors'+x+'">'+htmlSelectMaterialType+'</td>' +
                        '<td class="text-center align-middle"><button type="button" class="btn btn-danger btn_remove">X</button></td>' +
                        '</tr>');
                }

                $('.open_time').datepicker({
                    format: 'dd/mm/yyyy',
                    startDate: '+5d',
                });
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
                        '<td id="td_name'+y+'"><input type="text" id=\"name'+y+'\" name="names[]" class="form-control" placeholder=\"'+name+'\" autocomplete="off"/></td>' +
                        '<td id="td_open_time'+y+'"><input type="text" id=\"open_time'+y+'\" name="open_times[]" class="form-control open_time" placeholder="dd/mm/yyyy" autocomplete="off"/></td>' +
                        '<td id="td_open_study'+y+'"><input type="text" id=\"study_time'+y+'\" name="study_times[]" class="form-control" placeholder=\"'+study_time+'\" autocomplete="off"/></td>' +
                        '<td id="td_counselors'+y+'">'+htmlSelectMaterialType+'</td>' +
                        '<td class="text-center align-middle"><button type="button" class="btn btn-danger btn_remove">X</button></td>' +
                        '</tr>');
                }

                $('.open_time').datepicker({
                    format: 'dd/mm/yyyy',
                    startDate: now,
                });
            });
        });

        $(".btn_save").click(function(e){
            $("#dynamic_field tbody tr td").removeClass("has-error");
            $(".errors").remove();
            var error_list = "";
            count = ( $('#dynamic_field tbody tr').length) - 1;
            for (i = 1; i <= 50; i++) {
                if ($('#name' + i).length > 0) {
                    if ($.trim($("#name" + i).val()) === "") {
                        $('#td_name' + i).addClass('has-error');
                        $('#td_name' + i).append('<span class="error errors">{{__('common.required')}}</span>');
                        error_list = 1;
                    }else if(($.trim($("#name" + i).val())).length < 5) {
                        $('#td_name' + i).addClass('has-error');
                        $('#td_name' + i).append('<span class="error errors">{{__('common.validation.min', ['amount' => 5])}}</span>');
                        error_list = 1;
                    }
                    if ($.trim($("#open_time" + i).val()) === "") {
                        $('#td_open_time' + i).addClass('has-error');
                        $('#td_open_time' + i).append('<span class="error errors">{{__('common.required')}}</span>');
                        error_list = 1;
                    }
                    if ($.trim($("#study_time" + i).val()) === "") {
                        $('#td_study_time' + i).addClass('has-error');
                        $('#td_study_time' + i).append('<span class="error errors">{{__('common.required')}}</span>');
                        error_list = 1;
                    }else if(($.trim($("#study_time" + i).val())).length < 5) {
                        $('#td_study_time' + i).addClass('has-error');
                        $('#td_study_time' + i).append('<span class="error errors">{{__('common.validation.min', ['amount' => 5])}}</span>');
                        error_list = 1;
                    }

                    if ($.trim($("#open_time" + i).val()) !== ""){
                        var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
                        var val_date=$('#open_time' + i).val();
                        if(val_date.match(dateformat)){
                            var seperator = val_date.split('/');
                            if (seperator.length>1)
                            {
                                var splitdate = val_date.split('/');
                            }
                            var dd = parseInt(splitdate[0]);
                            var mm  = parseInt(splitdate[1]);
                            var yy = parseInt(splitdate[2]);
                            var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
                            if (mm==1 || mm>2)
                            {
                                if (dd>ListofDays[mm-1])
                                {
                                    $('#td_open_time' + i).addClass('has-error');
                                    $('#td_open_time' + i).append('<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                                    error_list = 1;
                                }
                            }
                            if (mm==2)
                            {
                                var lyear = false;
                                if ( (!(yy % 4) && yy % 100) || !(yy % 400))
                                {
                                    $('#td_open_time' + i).addClass('has-error');
                                    $('#td_open_time' + i).append('<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                                    lyear = true;
                                }
                                if ((lyear==false) && (dd>=29))
                                {
                                    $('#td_open_time' + i).addClass('has-error');
                                    $('#td_open_time' + i).append('<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                                    error_list = 1;
                                }
                                if ((lyear==true) && (dd>29))
                                {
                                    $('#td_open_time' + i).addClass('has-error');
                                    $('#td_open_time' + i).append('<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                                    error_list = 1;
                                }
                            }

                            var d = new Date();
                            var month = d.getMonth()+1;
                            var day = d.getDate() + 5;
                            var year = d.getFullYear();
                            let now = year + "-" + month + "-" + day;
                            let dayCheck = parseInt(splitdate[2]) + '-' + parseInt(splitdate[1]) + '-' + parseInt(splitdate[0])

                            let date1 = new Date(now);
                            let date2 = new Date(dayCheck);
                            if (date1 > date2){
                                $("#open_time" + i).val('');
                                $('#td_open_time' + i).addClass('has-error');
                                $('#td_open_time' + i).append('<span class="error">{{ trans('common.required') }}</span>');
                                error_list = 1;
                            }
                        }
                        else
                        {
                            $('#td_open_time' + i).addClass('has-error');
                            $('#td_open_time' + i).append('<span class="error">{{ trans('common.validation.format_fail') }}</span>');
                            error_list = 1;
                        }
                    }
                }
            }
            if (error_list != ''){
                return false;
            }
        });

        $('.open_time').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '+5d',
        });

    });

    setInputFilter(document.getElementById("tuition"), function(value) {
        return /^\d*$/.test(value);
    });

    setInputFilter(document.getElementById("preferential_tuition"), function(value) {
        return /^\d*$/.test(value);
    });

    jQuery.validator.addMethod("checkWithTuition", function(value, element) {
        let tuition = $('#tuition').val();
        tuition = Number(tuition.replace(/[^0-9\.]+/g, ""));
        if (Number(value) >= Number(tuition)){
            return false;
        }
        return true;
    });
    jQuery.validator.addMethod("checkMinTuition", function(value, element) {
        let tuition = $('#tuition').val()
        tuition = Number(tuition.replace(/[^0-9\.]+/g, ""));
        if(tuition < 1000){
            return false;
        }
        return true
    });
    jQuery.validator.addMethod("maxLengthTuition", function(value, element) {
        let tuition = $('#tuition').val();
        tuition = Number(tuition.replace(/[^0-9\.]+/g, ""));
        if(tuition.toString().length > 9){
            return false;
        }
        return true
    });
    
</script>
@endsection
