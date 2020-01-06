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
    </div>
</div>

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

