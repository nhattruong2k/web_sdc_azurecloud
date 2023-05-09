<div class="modal fade bd-example-modal-lg" id="Status_{{ $value->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-lg modal_top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{ __('consultations.status') }}
                </h5>
                <input hidden value="{{ $value->id }}" id="register_id">
                <button type="button" class="close_btn close close-modal-header" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body content-body">
                    <label for="status" class="control-label">{{ __('consultations.status') }}</label>
                    <select  name="status" class="form-control bg-white mt-1" id="selecter_{{ $value->id }}" data-reason={{$value->reason}}>
                        <option value="0">
                            {{ __('consultations.notContact') }}</option>
                        <option value="1">
                            {{ __('consultations.contacted') }}</option>
                        <option value="2">
                            {{ __('consultations.contactAgain') }}</option>
                    </select>
                <div class="reason_{{ $value->id }} d-none mt-3">
                    <div class="form-group">
                        <label for="reason"
                            class="control-label required">{{ __('consultations.reason') }}</label>
                        <textarea type="text" value="{{ $value->reason }}" name="reason" id="consultations_reason_{{ $value->id }}"
                            class="form-control mt-1" data-id="{{ $value->id }}" cols="10" rows="5">{{ $value->reason }}</textarea>
                        <div id="content_error_{{ $value->id }}" class="error d-none mt-2"></div>
                        <div id="max_content_error_{{ $value->id }}" class="error d-none mt-2"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close_btn btn btn-secondary"
                    data-dismiss="modal">{{ __('common.closed') }}</button>
                <button type="submit" class="btn_status btn btn-primary btn_save" data-id={{ $value->id }}
                    data-dismiss="modal">{{ __('common.save') }}</button>
            </div>
        </div>
    </div>
</div>

@section('script_modal')
    <script>
        $('.register_id').on('click', function(){
            let id_ = $(this).data("id");
            let status = $(this).data("status");
            let reason = $("#selecter_" + id_).data("reason");
            $('select[name^="status"] option[value='+status+']').prop('selected', true).val() < 2 ?  $('.reason_' + id_).addClass('d-none') :  $('.reason_' + id_).removeClass('d-none');
            if ($("#selecter_" + id_).find(':selected').val() == 2) {
                $('.reason_' + id_).removeClass('d-none');
            }
            $("#selecter_" + id_).change(function() {
                if ($(this).find(':selected').val() == 2) {
                    let val_reason = $(this).closest(".content-body").find("#consultations_reason_" + id_).val(reason);
                    if(val_reason.val() == ''){
                        $('.reason_' + id_).removeClass('d-none');
                        return $('.btn_status').attr('disabled', true); 
                    }
                    return $('.reason_' + id_).removeClass('d-none');
                }
                if($(this).find(':selected').val() < 2) {
                    $(this).closest(".content-body").find("#consultations_reason_" + id_).val('');
                    $('.reason_' + id_).addClass('d-none');
                    return $('.btn_status').attr('disabled', false);
                }
            })
        })

        $('textarea').on('click', function(){
            let id_content = $(this).data("id");
            var min_content = document.getElementById('content_error_' + id_content);
            var max_content = document.getElementById('max_content_error_' + id_content);
            $('#consultations_reason_' + id_content).on('keyup', function(){
                const length_value = this.value.replace(/<[^>]*>/gi, '').length;
                switch(length_value){
                    case 0: {
                        min_content.innerText = "{{ __('consultations.validation.reason_required') }}";
                        $("#content_error_" + id_content).removeClass("d-none");
                        return $('.btn_status').attr('disabled', true);
                        break;
                    };
                    case 1: {
                        $("#content_error_" + id_content).addClass("d-none");
                        return $('.btn_status').attr('disabled', false);
                        break;
                    };
                }
                if(length_value >= 255){
                    max_content.innerText = "{{ __('consultations.validation.max_reason_required') }}";
                    $("#max_content_error_" + id_content).removeClass("d-none");
                    $('.btn_status').attr('disabled', true);
                }else{
                    $("#max_content_error_" + id_content).addClass("d-none");
                    $('.btn_status').attr('disabled', false);
                }
            });
            if (this.value.replace(/<[^>]*>/gi, '').length == 0) {
                min_content.innerText = "{{ __('consultations.validation.reason_required') }}";
                $("#content_error_" + id_content).removeClass("d-none");
                return $('.btn_status').attr('disabled', true);
            }
        })

        $('.btn_save').on('click',function (){
            let id = $(this).data("id");
            var span = document.getElementById('content_error_' + id);
            var val_status = $("#selecter_" + id).val();
            var _url = "{{ route('consultations.status') }}";
            var val_reason = $("#consultations_reason_" + id).val();
                $.ajax({
                type: "post",
                url: _url,
                data: {
                    id: id,
                    status: val_status,
                    reason: val_reason,
                },
                success: function(data, success, res) {
                    location.reload();
                    $('#Status_' + id).modal('hide');
                    showNotificationActive(data.message);
                }
            });
        })
    </script>
@endsection