@extends('layouts.app')


@section('content')
    @if (Auth::check())
        <div class="row">
            
            <aside class="col-md-4">
            
            <style type="text/css">
            .label{
                color: #FF00BF;
                font-size: 25px;
            }
            
            .form-group {
            float: left;
            position: relative left;
            position: fixed; left:10px;
            width:300px;
            border: dashed 2px white;
            margin-left: 50px;
                }
                
            .form-group textarea {
            resize: vertical;
            height:200px;
            }
            
            .tweet {
                margin-top: 20px;
            }
            
            

            </style>
            
            
            <section class='text'>
             @if (Auth::id() == $user->id) <!-- Auth::user()->id wo Auth::id() ni kaetayo -->
                  {!! Form::open(['route' => 'microposts.store']) !!}
                      <div class="form-group">
                          {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                          {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                      </div>
                  {!! Form::close() !!}
            @endif
            
            
            </aside>
            <div class="col-xs-8">
            
                <span class='label label-info'>
            みんなの投稿</span>
            
            <section class='tweet'>
                
                @if (count($microposts) > 0)
                    @include('microposts.microposts', ['microposts' => $microposts])
                @endif
            </section>    
            </div>
        </div>
    @else
        <body>
        
    <link href="css/background.css" rel="stylesheet" type="text/css">
        
        <!--<div class="center jumbotron">-->
            <div class="text-center">
                <section class='signup'>
                <h1>Welcome to the Microposts</h1>
                
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-info']) !!}
                </section>
            </div>
        </div>
        
    </body>
    @endif
@endsection