<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user();
//        if (Auth::user()->is_admin) {
//            $posts = Post::all();
//        } else {
//            $posts = Auth::user()->post();
//        }

        return view('dashboard')->with($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => ['string', 'required', 'max:255', 'unique:posts'],
            'body' => ['string', 'required'],
            'audio' => ['required', 'mimes:audio/mp3']
        ]);

        var_dump($request->file);

        $post = new Post;
        $post->id = Str::uuid();
        $post->title = $request->title;
        $post->excerpt = Str::words($request->body, 30);
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->user_id = Auth::id();

        // Handle image
        if ($request->hasFile('audio') && $request->file('audio')->isValid()) {
            return 'File dey';
        };

        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        return $uuid;
        $post = Post::findOrFail($uuid);

        return view('posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->is_admin) {
            return view('admin.edit');
        }
        return view('posts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
