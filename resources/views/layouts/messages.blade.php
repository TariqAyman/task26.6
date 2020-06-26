@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success" role="alert">
                {{$msg}}
            </div>
        @endforeach
    @else
        <div class="alert alert-success" role="alert">
            {{$data}}
        </div>
    @endif
@endif

@if(isset ($errors) && count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    @endforeach
@endif
