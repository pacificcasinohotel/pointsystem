@if (count($errors->all()) > 0)
<div class="alert alert-block alert-danger fade in">
    <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
    <h4>Error</h4>
    Please check the form below for errors
</div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success fade in">
        <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-check"></i>
                <strong>Success</strong>  
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger fade in">
        <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-times"></i>
                <strong>Error:</strong> <br />
                 @if(is_array($message))
                     @foreach ($message as $m)
                        {{ $m }} <br />
                    @endforeach
                 @else
                     {{ $message }}
                 @endif
    </div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning fade in">
        <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-warning"></i>
                <strong>Warning</strong>  
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
    </div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-block alert-info fade in">
    <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
    <h4>Info</h4>
    @if(is_array($message))
        @foreach ($message as $m)
            {{ $m }}
        @endforeach
    @else
        {{ $message }}
    @endif
</div>
@endif