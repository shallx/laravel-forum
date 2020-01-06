@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        <form action="{{route('discussions.store')}}" method="POST" >
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" id="title" class="form-control" placeholder="Title" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Title Of the Page</small>
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <input id="content" type="hidden" name="content">
              <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
              <label for="channel">Channel</label>
              <select type="text" name="channel" id="channel" class="form-control">
                  @foreach ($channels as $channel)
                    <option value="{{$channel->id}}">{{$channel->name}}</option>                   
                  @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-success">Create Discussion</button>
        </form>
    </div>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection

