<?php

namespace LaravelForum;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function discussions(){
        return $this->hasMany(Discussion::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
