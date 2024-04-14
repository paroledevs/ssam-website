<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Traits\ControllerHelpers;
use App\Asteroide\Traits\DealWithFiles;
use App\Asteroide\Traits\MapPolymorphicModels;
use App\Asteroide\Traits\Notifications;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\PostCategory;

class PostController extends Controller
{
    use ControllerHelpers,
        DealWithFiles,
        Notifications,
        MapPolymorphicModels;

    public function __construct()
    {
        $this->registerPolymorphicClasses('postCategory');
    }

    public function category()
    {
        return $this->morphModel('postCategory');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);

        return view('admin.blog.items', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);
        $categories = PostCategory::all();

        return view('admin.blog.create', compact('posts', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->polymorphicMapFromRequest($request);

        $post = $this->category()->posts()->save(new Post($request->all()));

        $post->fill([
            'main_image_path' => $request->hasFile('main_image') ? $this->saveFile($post->storagePath(), $request->main_image) : null,
            'cover_image_path' => $request->hasFile('cover') ? $this->saveFile($post->storagePath(), $request->cover) : null,
        ])->save();

        $this->prepareNotification($request);

        return redirect()->route('posts.edit', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate($this->itemsPerPage);
        $categories = PostCategory::all();

        return view('admin.blog.edit', compact('posts', 'post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->polymorphicMapFromRequest($request);

        $post->fill($request->all());

        if ($request->hasFile('main_image')) {
            $this->deleteFile($post->main_image_path);

            $post->main_image_path = $this->saveFile($post->storagePath(), $request->main_image);
        }

        if ($request->hasFile('cover')) {
            $this->deleteFile($post->cover_image_path);

            $post->cover_image_path = $this->saveFile($post->storagePath(), $request->cover);
        }

        $this->category()->posts()->save($post);

        $this->prepareNotification($request);

        return redirect()->route('posts.edit', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->deleteDir($post->storagePath());

        foreach ($post->blocks as $block) {
            $block->delete();
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
