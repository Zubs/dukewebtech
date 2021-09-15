<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
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
        ]);

        $post = new Post;
        $post->id = Str::uuid();
        $post->title = $request->title;
        $post->excerpt = Str::words($request->body, 15);
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->user_id = Auth::id();

        // Handle image
        if ($request->hasFile('audio') && $request->file('audio')->isValid()) {
            $document = $request->file('audio');
            $file_name = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $document->getClientOriginalExtension();
            $document->storeAs('/public/audio', $file_name);
            $post->audio_name = $file_name;
        };

        if ($post->save()) {
            return redirect()->route('dashboard')->with('success', 'Post created successfully');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->views = $post->views + 1;
        $post->save();

        return view('posts.show')->with('post', $post);
    }

    public function review (Post $post)
    {
        return view('admin.edit')->with('post', $post);
    }

    public function approve (Post $post) {
        $post->published = true;
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post approved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = $this->validate($request, [
            'title' => ['string', 'required', 'max:255', 'unique:posts'],
            'body' => ['string', 'required'],
        ]);

        $post = Post::firstWhere('slug', $slug);
        $post->title = $request->title;
        $post->excerpt = Str::words($request->body, 15);
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;

        // Handle image
        if ($request->hasFile('audio') && $request->file('audio')->isValid()) {
            Storage::delete('/public/audio/'.$post->audio_name);
            $document = $request->file('audio');
            $file_name = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $document->getClientOriginalExtension();
            $document->storeAs('/public/audio', $file_name);
            $post->audio_name = $file_name;
        };

        if ($post->save()) {
            return redirect()->route('dashboard')->with('success', 'Post created successfully');
        };
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
