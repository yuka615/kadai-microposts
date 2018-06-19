
    @if (Auth::user()->is_liking($micropost->id))
        {!! Form::open(['route' => ['user.unlike', $micropost->id], 'method' => 'delete']) !!}
            <!--{!! Form::submit('Unlike', ['class' => "btn btn-info btn-xs"]) !!}-->
            {{ Form::button('<span class="glyphicon glyphicon-remove">unlike</span>', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.like', $micropost->id], 'method' => 'post']) !!}
            <!--{!! Form::submit('Like', ['class' => "btn btn-primary btn-xs"]) !!}-->
            {{ Form::button('<span class="glyphicon glyphicon-heart">like</span>', array('class'=>'btn btn-info', 'type'=>'submit')) }}
        {!! Form::close() !!}
    @endif
