<?php

namespace LaravelForum;

use LaravelForum\Model;
use LaravelForum\Channel;
use LaravelForum\Notifications\ReplyMarkAsBestReply;


class Discussion extends Model
{
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function bestReply(){
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function scopeFilterByChannel($builder){
        if(request()->query('channel')){
            $channel = Channel::where('slug',request()->query('channel'))->first();
            session(['debug' => $channel]);

            if($channel){
                return $channel->discussions();
            }
            return $builder;
        }
        return $builder;

    }

    public function markAsBestReply(Reply $reply){
        $this->update([
            'reply_id' => $reply->id
        ]);

        $reply->owner->notify(new ReplyMarkAsBestReply($reply->discussion));
    }
}
