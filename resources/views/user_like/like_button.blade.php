
    @if (Auth::user()->is_liking($micropost->id))
        {!! Form::open(['route' => ['user.unlike', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unlike', ['class' => "btn btn-info btn-xs"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.like', $micropost->id], 'method' => 'post']) !!}
            {!! Form::submit('Like', ['class' => "btn btn-primary btn-xs"]) !!}
        {!! Form::close() !!}
    @endif
