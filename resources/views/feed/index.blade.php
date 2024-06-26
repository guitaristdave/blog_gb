@extends('layouts.base')
@section('page.title', 'Лента')

@section('content')
    <div class="container mt-5">
        @foreach($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><a
                            href="{{ route('feed.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Автор: {{$post->name}}</h6>
                    <p class="card-text">{{$post->content}}</p>
                    <p class="card-text"><small class="text-muted">Дата: {{$post->created_at}}</small></p>
                </div>
            </div>
        @endforeach
        <div class="center">
            {{$posts->links()}}
        </div>
    </div>
@endsection
