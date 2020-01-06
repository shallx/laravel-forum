<?php

namespace LaravelForum\Http\Controllers;

use LaravelForum\User;
use Illuminate\Http\Request;
use LaravelForum\Discussion;
use LaravelForum\Http\Requests\CreateDiscussionRequest;

class DiscussionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    public function index()
    {
        return view('discussions.index', [
            'discussions' => Discussion::paginate(5)
        ]);
    }

    public function create()
    {
        return view('discussions.create');
    }

    public function store(Request $request){
        $user = User::find(auth()->user()->id);
        $user->discussions()->create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'content' => $request->content,
            'channel_id' => $request->channel,
        ]);

        session()->flash('success', 'Discussion Created Successfully');
        return view('discussions.index', [
            'discussions' => Discussion::paginate(5)
        ]);
    }

    public function show(Discussion $discussion){
        return view('discussions.show', ['discussion' => $discussion]);
    }
}
