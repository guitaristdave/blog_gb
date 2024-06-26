@extends('layouts.base')
@section('page.title', 'Лента')

@section('content')
    <div class="wrapper py-10">
        <div class="container mx-auto">
            <div class="grid gap-4">
                @foreach($posts as $post)
                    <div class="item p-5 rounded-lg">
                        <div class="">
                            <h5 class="text-xl font-bold"><a
                                    href="{{ route('feed.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Автор: {{$post->name}}</h6>
                            <p class="card-text">{{$post->content}}</p>
                            <p class="card-text"><small class="text-muted">Дата: {{$post->created_at}}</small></p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection

<style>
    .wrapper{
        background-color: var(--bg-gray);

        .item{
            background-color: #fff;
        }
    }
</style>
