<div class="modal fade bd-example-modal-lg" id="View_{{ $value->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{ __('common.view') }}
                </h5>
                <input hidden value="{{ $value->id }}" id="register_id">
                <button type="button" class="close close-modal-header" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body content-body">
                <div class="row">
                    <div class="col col_view">
                        <div>
                            <label class="control-label" for="">{{ __("consultations.name")}}</label>
                            <input type="text" disabled value="{{$value->name}}" class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>
                        </div>
                        <div class="mt-3">
                            <label class="control-label" for="">{{ __("consultations.phone")}}</label>
                            <input type="text" disabled value="{{$value->phone}}" class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>
                        </div>
                        <div class="mt-3">
                            <label class="control-label" for="">{{ __("consultations.year_of_birth")}}</label>
                            <input type="text" disabled value="{{$value->year_of_birth}}" class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>
                        </div>
                        <div class="mt-3">
                            <label class="control-label" for="">{{ __("consultations.status")}}</label>
                            <input type="text" disabled value="{{ $value->status == 0 ? __('consultations.notContact') : ($value->status == 1 ? __('consultations.contacted') : __('consultations.contactAgain') ) }}" class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <label class="control-label" for="">{{ __("consultations.email")}}</label>
                            <input type="text" disabled value="{{$value->email}}" class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>
                        </div>
                        <div class="mt-3">
                            <label class="control-label" for="">{{ __("consultations.address")}}</label>
                            <input type="text" disabled value="{{$value->address}}" class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>
                        </div>
                        <div class="mt-3">
                            <label class="control-label" for="">{{ __("consultations.course")}}</label>
                            <input type="text" disabled value="{{$value->course->title}}" class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>
                        </div>
                        <div class="mt-3">
                            <label class="control-label" for="">{{ __("consultations.created")}}</label>
                            <input type="text" disabled value="{{$value->created_at->format('d-m-Y')}}" class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>
                <div class="mt-3 view_reason">
                    <label class="control-label" for="">{{ __("consultations.reason")}}</label><br>
                    <textarea disabled class="form-control bg-white text-dark form-inline" autocomplete="off" readonly>{{$value->reason}}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('common.closed') }}</button>
            </div>
        </div>
    </div>
</div>