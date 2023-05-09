<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <label>
                <input type="checkbox" class="check_all">
                {{__('common.checkedAll')}}
            </label>
        </div>
        @foreach ($permissions as $item)
            <div class="col-md-12">
                <div class="card border-primary mb-3" id="card">
                    <div class="card-header bg-primary text-white">
                        <label>
                            <input type="checkbox" id="child_{{$item->key_code}}" class="{{$permissionsRoleChecked->contains('id', $item->id) ? 'checkbox_all_dis' : 'checkbox_all'}}" name="{{$permissionsRoleChecked->contains('id', $item->id) ? '' : 'permission_id[]'}}" value="{{$item->id}}" {{$permissionsRoleChecked->contains('id', $item->id) ? 'checked disabled' : ''}} {{$permissionUserChecked->contains('id', $item->id) ? 'checked' : ''}}>
                        </label>
                        {{ $item->name }}
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            @foreach ($item->permissionChildrent as $value)
                                <div class="card-body text-primary col-md-3">
                                    <h5 class="card-title">
                                        <label>
                                            <input type="checkbox" class="{{isset($permissionsRoleChecked) ? $permissionsRoleChecked->contains('id', $value->id) ? '' : 'checkbox_childrent' : ''}} child_{{$value->type}}" data-code="child_{{$value->type}}" name="{{isset($permissionsRoleChecked) ? $permissionsRoleChecked->contains('id', $value->id) ? '' : 'permission_id[]' : ''}}" {{isset($permissionsRoleChecked) ? $permissionsRoleChecked->contains('id', $value->id) ? 'checked disabled' : '' : ''}} {{isset($permissionUserChecked) ? $permissionUserChecked->contains('id', $value->id) ? 'checked' : '' : ''}} value="{{ $value->id }}">
                                        </label>
                                        {{ $value->name }}
                                    </h5>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('common.save')}}</button>
                @if(Request::segment(3) != 'profile')
                    <a href="{{route(\App\Models\User::LIST)}}" class="btn btn-default"><i class="fa fa-reply"></i> {{__('common.return')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
@section('script')
    <script type="text/javascript">
        mn_selected = 'mn_users';
        $(function() {
            $('.checkbox_all').on('click', function() {
                $(this).parents('#card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
            });

            $('.check_all').on('click', function() {
                $(this).parents('').find('.checkbox_all').prop('checked', $(this).prop('checked'));
                $(this).parents('').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
            });
        });
        var checked = $('input.checkbox_all:checked').length;
        var checked_dis = $('input.checkbox_all_dis:checked').length;
        var count = '<?php echo count(config('permission.access')); ?>';
        if (count == (checked + checked_dis)){
            $('.check_all').attr('checked', true)
        }

        $('.checkbox_childrent').click(function () {
            let code = $(this).data('code');
            console.log(code)
            var count_child_all = $('.'+code).length;
            var count_child_checked = $('input.'+code+':checked').length;
            if (count_child_all == count_child_checked){
                $('#'+code).prop('checked', $(this).prop('checked'));
            }else{
                $('#'+code).prop('checked', false)
            }
        });
    </script>
@endsection
