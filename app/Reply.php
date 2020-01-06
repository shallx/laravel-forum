<?php

namespace LaravelForum;

use LaravelForum\Model;

class Reply extends Model
{
    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function discussion(){
        return $this->belongsTo(Discussion::class, 'discussion_id');
    }
}
