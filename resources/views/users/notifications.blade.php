@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        <ul class="list-group">
            @if($notifications)
            @foreach ($notifications as $notification)
                <li class="list-group-item">
                    @if ($notification->type == 'LaravelForum\Notifications\NewReplyAdded')
                        A new Reply was added to your discussion
                        @elseif($notification->type == 'LaravelForum\Notifications\ReplyMarkAsBestReply')
                        Your Reply was Marked as the Best Reply
                    @endif

                    <strong>
                        {{$notification->data['discussion']['title']}}
                    </strong>

                    <a href="{{route('discussions.show',$notification->data['discussion']['slug'])}}" class="btn float-right btn-sm btn-info">View Discussion</a>                        
                </li>               
            @endforeach
            @endif
            
        </ul>
    </div>
</div>

@endsection
