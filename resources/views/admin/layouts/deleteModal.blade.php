<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(array('url' => "", 'class' => 'form-horizontal', 'id' => 'form_modal_delete')) !!}
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('common.notification') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="del_modal_id" />
                <p>{{trans('common.confirm_delete')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">{{trans('common.no')}}</button>
                <button type="submit" class="btn btn-primary">{{trans('common.yes')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
