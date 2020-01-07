@extends('layouts.app')

@section('content')

<div class="card">
    @include('partials.discussion-header')
    
    <div class="card-body">
        <div class="text-center">
            <strong>
                {{$discussion->title}}
            </strong>
        </div>

        <hr>

        {!!$discussion->content!!}
        <hr>

        @if($discussion->bestReply)
            <div class="card mt-2">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img height="40px" width="40px" style="border-radius:50%" src="{{Gravatar::src($discussion->bestReply->owner->email)}}">
                            <strong>{{$discussion->bestReply->owner->name}}</strong>
                        </div>
                        <div>
                            @if(auth()->user()->id == $discussion->user_id)
        
                                <strong>BEST REPLY</strong>
        
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $discussion->bestReply->content!!}
                </div>
            </div>
        @endif
    </div>
</div>

<div style="height:30px"></div>
@foreach ($discussion->replies()->paginate(3) as $reply)
    <div class="card mt-2">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img height="40px" width="40px" style="border-radius:50%" src="{{Gravatar::src($reply->owner->email)}}">
                    <strong>{{$reply->owner->name}}</strong>
                </div>

                @auth
                <div>
                    @if(auth()->user()->id == $discussion->user_id)
                        <form action="{{ route('discussions.best-reply', ['discussion' => $discussion, 'reply' => $reply] )}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Mark as best Reply</button>                   
                        </form>
                    @endif
                </div>
                @endauth

            </div>
        </div>
        <div class="card-body">
            {!! $reply->content!!}
        </div>
    </div>
@endforeach

{{$discussion->replies()->paginate(3)->links()}}

<div class="card">
    <div class="card-header">Add a Replay</div>
    <div class="card-body">
        @auth
        <form action="{{route('replies.store', $discussion->slug)}}" method="POST">
            @csrf
            <input id="content" type="hidden" name="content">
            <trix-editor input="content"></trix-editor>
            <button class="btn btn-success btn-sm text-white mt-2">Replay</button>
        </form>
        @else 
        <a href="{{route('login')}}" class="btn btn-info">Sign in to Add a Reply</a>
    </div>
</div>
@endauth


@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection

