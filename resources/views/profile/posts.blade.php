@extends('layouts.base')
@section('page.title', 'Own Posts')
@section('header')
    <x-header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-header>
@endsection
@section('content')
    <div class="wrapper py-10">
        <div class="container mx-auto">
            @if(count($posts) > 0)
                <div class="list grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                    @foreach ($posts as $post)
                        <div class="item rounded-lg p-5">
                            <p class="text-xl font-bold pb-3">
                                <a href="{{ route('feed.show', ['post' => $post->id]) }}">
                                    {{ $post->title }}
                                </a>
                            </p>
                            <p>
                                {{ $post->content }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 px-4">
                    {{ $posts->onEachSide(3)->links() }}
                </div>
            @else
                No publications
            @endif
        </div>
    </div>
@endsection

<style>
    .wrapper{
        background-color: #f7f7f7;

        .item{
            background-color: #fff;
        }
    }
</style>
