@extends('layouts.base')
@section('page.title', 'Лента')

@section('content')
    <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Автор: {{$post->name}}</h6>
                    <p class="card-text">{{$post->content}}</p>
                    <p class="card-text"><small class="text-muted">Дата: {{$post->created_at}}</small></p>
                </div>
            </div>
    </div>
@endsection
