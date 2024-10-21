<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PostsController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Post::class);

        return view('posts.index', [
            'posts' => Post::paginate(10),
        ]);
    }

    public function show(Post $post)
    {
        Gate::authorize('view', Post::class);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        Gate::authorize('create', Post::class);

        return view('posts.create');
    }

    public function store(PostsRequest $request)
    {
        Gate::authorize('create', Post::class);

        Post::create([...$request->validated(), 'slug' => \Str::slug($request->title)]);

        if ($request->has('create_another')) {
            return to_route('posts.create')->with('toast-notification', [
                'type' => 'success',
                'message' => 'New slider has been added! You can create another one.',
            ]);
        }

        return to_route('posts.index');
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', Post::class);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', Post::class);

        if ($request->title !== $post->title) {
            $post->title = $request->title;
            $post->content = $request['content'];
            $post->slug = \Str::slug($request->title);
        }

        $post->title = $request->title;
        $post->content = $request['content'];
        $post->save();

        return to_route('posts.index');
    }

    public function destroy(Post $post)
    {
        try {
            Gate::authorize('delete', Post::class);

            $post->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete post'], 500);
        }
    }
}
