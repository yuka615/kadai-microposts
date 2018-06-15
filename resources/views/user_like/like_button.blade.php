@if (Auth::id() != $user->id)
    @if (Auth::user()->is_liking($user->id))
        {!! Form::open(['route' => ['user.unlike', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unlike', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.like', $user->id]]) !!}
            {!! Form::submit('Like', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif