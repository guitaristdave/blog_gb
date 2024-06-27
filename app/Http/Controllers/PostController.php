<?php

namespace App\Http\Controllers;

use App\Models\Post;
use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.*', 'users.name')
        ->paginate(10);
        return view('feed.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $errorMessages = [
            'title.required' => 'Пожалуйста, укажите заголовок поста.',
            'title.unique' => 'Такой заголовок уже существует',
            'title.max' => 'Заголовок не может быть больше 255 символов',
            'content.required' => 'Пожалуйста, введите содержимое поста.'
        ];
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
        ], $errorMessages);
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->user_id = Auth::id();
        $post->save();
        return redirect('/feed')->with('message', 'Post created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $post = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.*', 'users.name')
        ->where('posts.id', $id)
        ->first();
        return view('feed.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('feed.create', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $errorMessages = [
            'title.required' => 'Пожалуйста, укажите заголовок поста.',
            'title.max' => 'Заголовок не может быть больше 255 символов',
            'content.required' => 'Пожалуйста, введите содержимое поста.'
        ];
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ], $errorMessages);
        $post?->update($validatedData);
        return redirect('/feed')->with('message', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/feed')->with('message', 'Post deleted!');
    }
}
