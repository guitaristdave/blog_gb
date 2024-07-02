<?php

namespace App\Http\Controllers;

use App\Models\Post;
use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ?string $username = null)
    {
        if (is_null($username)) {
            $posts = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.*', 'users.name')
                ->orderByDesc('created_at')
                ->paginate(10);
        } else {
            $user = User::query()->where('name', $username)->first();
            if (!$user) {
                abort(404);
            }
            $posts = DB::table('posts')
                ->where('user_id', '=', $user->id)
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.*', 'users.name')
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return view('feed.index', compact('posts'));
    }

    public function posts(Request $request)
    {
        if (Auth::guest()) {
            return redirect()->route('feed');
        }

        return view('feed.posts', [
            'user' => $request->user(),
            'posts' => DB::table('posts')
                ->where('user_id', '=', Auth::user()->id)
                ->orderByDesc('created_at')
                ->paginate(10),
        ]);
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
//            'title.unique' => 'Такой заголовок уже существует',
            'title.max' => 'Заголовок не может быть больше 255 символов',
            'content.required' => 'Пожалуйста, введите содержимое поста.',
//            'image.required' => 'Пожалуйста, загрузите фото.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Поддерживаемые форматы изображений: jpeg, png, jpg.',
            'image.max' => 'Максимальный размер изображения 2MB.',
        ];

        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ], $errorMessages);

            $post = new Post();

            $post->title = $validatedData['title'];
            $post->content = $validatedData['content'];
            $post->user_id = Auth::id();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Получаем расширение файла
                $image->storeAs('public/images', $imageName);
                $post->image = 'storage/images/' . $imageName;
            }

            $post->save();
        } catch (ValidationException $e) {
            return redirect()->route('feed.create')->withErrors($e->errors())->withInput();
        }

        return redirect()->route('feed.posts')->with('message', 'Пост успешно создан!');
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
        try {
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
        } catch (ValidationException $e) {
            return redirect()->route('feed.edit', ['post' => $post->id])->withErrors($e->errors())->withInput();
        }

        return redirect()->route('feed.show', ['post' => $post->id])->with('message', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('feed.posts')->with('message', 'Post deleted!');
    }
}
