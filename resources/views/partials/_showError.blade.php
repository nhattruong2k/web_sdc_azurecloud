@if($errors->any())
    <div class="row">
        <div class="col-md-12">
            <div class="show-errors">
                @foreach ($errors->all() as $error)
                    <div class="text-danger font-italic">{{ $error }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endif
