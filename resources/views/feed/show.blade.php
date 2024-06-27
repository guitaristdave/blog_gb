@extends('layouts.base')
@section('page.title', 'Лента')

@section('content')
    <div class="wrapper py-10">
        <div class="container mx-auto">
            <div class="item p-5 rounded-lg">
                <div class="">
                    <h5 class="text-xl font-bold"><a
                            href="{{ route('feed.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Автор: {{$post->name}}</h6>
                    @if($post->image)
                        <img src="{{ asset($post->image) }}" class="my-4 rounded-md" alt="Post Picture">
                    @endif
                    <p class="card-text">{{$post->content}}</p>
                    <p class="card-text"><small class="text-muted">Дата: {{$post->created_at}}</small></p>
                </div>
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
        .item img {
            max-width: 100%;
            height: auto;
            max-height: 300px;
            display: block;
        }
    }
</style>
