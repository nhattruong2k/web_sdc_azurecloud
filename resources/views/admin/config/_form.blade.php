<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="key" class="control-label required">{{ __('config.key') }}</label>
                @if (Route::currentRouteName() == \App\Models\Config::CREATE)
                    {!! Form::text('key', $config->key, [
                        'class' => 'form-control',
                        'required' => true,
                        'maxlength' => 50,
                        'autofocus' => true,
                        'autocomplete' => 'off',
                        'id' => 'key',
                    ]) !!}
                @elseif (Route::currentRouteName() == \App\Models\Config::UPDATE)
                    {!! Form::text('key', $config->key, [
                        'class' => 'form-control',
                        'required' => true,
                        'autofocus' => true,
                        'autocomplete' => 'off',
                        'id' => 'key',
                        'disabled',
                    ]) !!}
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="value" class="control-label required">{{ __('config.value') }}</label>
                {!! Form::text('value', $config->value, [
                    'class' => 'form-control',
                    'required' => true,
                    'autofocus' => true,
                    'autocomplete' => 'off',
                ]) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $config->status ?? 1, ['id' => 'status']) !!}
                <label for="status">{{ __('config.active') }}</label>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                    {{ __('common.save') }}</button>
                @if (Request::segment(3) != 'profile')
                    <a href="{{ route(\App\Models\Config::LIST) }}" class="btn btn-default"><i class="fa fa-reply"></i>
                        {{ __('common.return') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    mn_selected = 'mn_config';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._select')
    @include('partials._datetimepicker')
    @include('partials._bootstrap_fileupload')
    <script type="text/javascript">
        var Config = {
            CONSTS: {
                URL_KEY_EXIST: '{{ route('config.key-exist') }}',
            },
            SELECTORS: {
                frmConfig: '#form-config'
            },
            init: function() {
                this.setUpEvent();
            },
            setUpEvent: function() {
                $(Config.SELECTORS.frmConfig).validate({
                    rules: {
                        key: {
                            required: true,
                            minlength: 3,
                            not_Space_Key: true,
                            remote: {
                                type: 'post',
                                url: Config.CONSTS.URL_KEY_EXIST,
                                data: {
                                    'key': function() {
                                        return $('#key').val();
                                    },
                                    'id': function() {
                                        return '{{ $config->id }}';
                                    }
                                }
                            },
                        },
                        value: {
                            required: true,
                            maxlength: 255,
                        },
                    },
                    messages: {
                        key: {
                            required: "{!! __('config.validation.key_empty') !!}",
                            minlength: "{!! __('config.validation.key_min', ['amount' => 3]) !!}",
                            remote: "{!! __('config.validation.key_exist', ['key' => '{0}']) !!}",
                            not_Space_Key: "{!! __('config.validation.key_space') !!}",
                        },
                        value: {
                            required: "{!! __('config.validation.value_empty') !!}",
                            maxlength: "{!! __('config.validation.max_length') !!}",
                        }

                    }
                });
            }
        }
        $.validator.addMethod("not_Space_Key", function() {
            var key = $("#key").val();
            key = key.split(' ');
            return (key.length == 1);
        });
        $(function() {
            Config.init();
        });
    </script>
@endsection
