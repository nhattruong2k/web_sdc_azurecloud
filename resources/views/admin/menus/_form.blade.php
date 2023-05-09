<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label required">{{ __('menus.title') }}</label>
                {!! Form::text('title', $menu->title, [
                    'class' => 'form-control',
                    'maxlength' => 50,
                    'required' => true,
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="parent_id" class="control-label">{{ __('menus.parent_id') }}</label>
                <select name="parent_id" id="" class="form-control search-selecte-category">
                    <option value="0">{{ __('menus.parent_id') }}</option>
                    @php
                        echo $menu->parent;
                    @endphp
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="parent_id" class="control-label required">{{ __('menus.order_by') }}</label>
                {!! Form::text('order_by', $menu->order_by ?? 0, [
                    'class' => 'form-control',
                    'id' => 'order_by',
                    'maxlength' => 4,
                ]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $menu->status, [
                    'id' => 'status',
                    Request::segment(3) == 'create' ? 'checked' : '',
                ]) !!}
                <label for="status">{{ __('menus.active') }}</label>
            </div>
        </div>

    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                    {{ __('common.save') }}</button>
                @if (Request::segment(3) != 'profile')
                    <a href="{{ route(\App\Models\Menus::LIST) }}" class="btn btn-default"><i class="fa fa-reply"></i>
                        {{ __('common.return') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    mn_selected = 'mn_menus';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._select')
    @include('partials._datetimepicker')
    @include('partials._bootstrap_fileupload')
    @include('partials.validation_number')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.search-selecte-category').select2({
                placeholder: "{{ __('menus.parent_id') }}",
            });
        });
        var Menu = {
            CONSTS: {
                URL_KEY_EXIST: '{{ route('menu-title-exist') }}',
            },
            SELECTORS: {
                frm: '#form-menu'
            },
            init: function() {
                this.setUpEvent();
            },
            setUpEvent: function() {
                $(Menu.SELECTORS.frm).validate({
                    rules: {
                        title: {
                            required: true,
                            minlength: 6,
                            remote: {
                                url: Menu.CONSTS.URL_KEY_EXIST,
                                type: 'post',
                                data: {
                                    title: function() {
                                        return $('input[name = "title"]').val()
                                    },
                                    id: function() {
                                        return formMenu.data('id');
                                    }
                                }
                            }
                        },
                        order_by: {
                            required: true,
                        }
                    },
                    messages: {
                        title: {
                            required: "{{ __('menus.validation.title_empty') }}",
                            minlength: "{{ __('menus.validation.title_min', ['amount' => 6]) }}",
                            remote: "{!! __('menus.validation.title_exist', ['title' => '{0}']) !!}"
                        },
                        order_by: {
                            required: "{{ __('menus.validation.order_by-empty') }}",
                        }
                    }
                });
            }
        }
        setInputFilter(document.getElementById("order_by"), function(value) {
            return /^\d*$/.test(value);
        });
        $(function() {
            Menu.init();
        });
    </script>
@endsection
