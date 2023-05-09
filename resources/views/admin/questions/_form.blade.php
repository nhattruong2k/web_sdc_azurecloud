<div class="container-fluid">
    @include('partials._showError')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="question" class="control-label required">{{ __('questions.question') }}</label>
                {!! Form::textArea('question', $question->question, array('class' => 'form-control', 'id' => 'question', 'autofocus' => true, 'autocomplete' => 'off')) !!}
                <label id="question-error" class="error mt-1" for="question" hidden></label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="answer" class="control-label required">{{ __('questions.answer') }}</label>
                {!! Form::textArea('answer', $question->answer, array('class' => 'form-control', 'id' => 'answer', 'autofocus' => true, 'autocomplete' => 'off')) !!}
                <label id="answer-error" class="error mt-1" for="answer" hidden></label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::checkbox('status', 1, $question->status ?? 1, ['id' => 'status']) !!}
                <label for="status">{{ __('common.status') }}</label>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                    {{ __('common.save') }}</button>
                @if (Request::segment(3) != 'profile')
                    <a href="{{ route(\App\Models\Question::LIST) }}" class="btn btn-default"><i class="fa fa-reply"></i>
                        {{ __('common.return') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    mn_selected = 'mn_questions';
</script>
@section('script')
    @include('partials._formValidation')
    @include('partials._select')
    @include('partials._datetimepicker')
    @include('partials._bootstrap_fileupload')
    <script type="text/javascript">
    $(function(){
        question = CKEDITOR.replace('question');
        answer = CKEDITOR.replace('answer');
        question.on('change', function() {
            showErrorCkeditor(question.getData(), $('#question-error'));
        })
        answer.on('change', function() {
            showErrorCkeditor(answer.getData(), $('#answer-error'));
        })
    })
        var Question = {
            CONSTS: {
                URL_KEY_EXIST: '{{ route('questions.question_exist') }}',
            },
            SELECTORS: {
                frm: '#form-question'
            },
            init: function() {
                this.setUpEvent();
            },
            setUpEvent: function() {
                $(Question.SELECTORS.frm).validate({
                    ignore: [],
                    rules: {
                        question: {
                            required: function(question) {
                                return CKEDITOR.instances.question.updateElement();
                            },
                            minlength: 20,
                            maxlength: 300,
                            remote: {
                                type: 'post',
                                url: Question.CONSTS.URL_KEY_EXIST,
                                data: {
                                    'question': function() {
                                        return question.getData();
                                    },
                                    'id': function() {
                                        return '{{ $question->id }}';
                                    }
                                }
                            },
                        },
                        answer: {
                            required: function(answer) {
                                return CKEDITOR.instances.answer.updateElement();
                            },
                            minlength: 20,
                            maxlength: 500,
                        },
                    },
                    messages: {
                        question: {
                            required: "{!! __('questions.validation.question_empty') !!}",
                            minlength: "{!! __('questions.validation.question_min', ['amount' => 20]) !!}",
                            maxlength: "{!! __('questions.validation.question_max', ['amount' => 300]) !!}",
                            remote: "{!! __('questions.validation.question_exist') !!}",
                        },
                        answer: {
                            required: "{!! __('questions.validation.answer_empty') !!}",
                            minlength: "{!! __('questions.validation.answer_min', ['amount' => 20]) !!}",
                            maxlength: "{!! __('questions.validation.answer_max', ['amount' => 500]) !!}",
                        }

                    }
                });
                $(Question.SELECTORS.frm).submit(function (){
                    $('.error').removeAttr('hidden');
                })
            }
        }
        $(function() {
            Question.init();
        });
    </script>
@endsection
