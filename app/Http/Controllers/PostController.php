<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostSaveRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostImageService;
use Auth;

class PostController extends Controller
{
    protected PostImageService $postImageService;

    public function __construct(PostImageService $postImageService)
    {
        $this->postImageService = $postImageService;
    }

    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        //$categories = Category::pluck('title', 'id')->all();
        $categories = Category::select('id', 'title')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostSaveRequest $request)
    {
        $data = $request->validated();
        /*$post = new Post($data);
        $user = auth()->user();
        $user->posts()->save($post);*/
        $post = Auth::user()->posts()->create($data);
        $this->postImageService->uploadImage($post, $request->validated()['image'] ?? []);
        return redirect()->route('posts.index')->with('status', 'Post created!');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::select('id', 'title')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(PostSaveRequest $request, $id)
    {
        $data = $request->validated();
        $post = Post::findOrFail($id);
        if ($request->has('image')) {
            $this->postImageService->removeImage($post->image);
        }
        $post->update($data);
        $this->postImageService->uploadImage($post, $request->validated()['image'] ?? []);

        return redirect()->route('posts.index')->with('status', 'Post updated!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->postImageService->removeImage($post->image);
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Post deleted!');
    }
}
