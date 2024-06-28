@section('page.title', "Пост - $post->title")
@section('header', __($post->title))
@section('message', session('message'))

<x-app-layout>
    <div class="grid grid-cols-4 gap-4 bg-gray-50 rounded-lg">
        @isset($post->image)
            <a href="{{ route('feed.show', ['post' => $post->id]) }}" class="col-span-1">
                <img class="rounded-lg mx-auto" src="{{asset($post->image)}}" alt="Post Picture">
            </a>
        @endisset
        <div class="flex flex-col {{isset($post->image) ? 'col-span-3' : 'col-span-4'}} p-5">
            <p class="flex-grow pb-4">
                {{$post->content}}
            </p>
            <div class="flex gap-4 items-center w-full {{ Auth::user()->id === $post->user_id ? 'justify-end' : 'justify-between' }}">
                <div class="text-xs text-gray-400">
                    Опубликовано: {{date('H:i d.m.Y', strtotime($post->created_at))}}
                </div>
                @if(Auth::user()->id === $post->user_id)
                    <a class="text-sm text-blue-500" href="{{ route('feed.edit', ['post' => $post->id]) }}">
                        Редактировать
                    </a>
                    <a class="text-sm text-red-500" href="{{ route('feed.remove', ['post' => $post->id]) }}">
                        Удалить
                    </a>
                @else
                    <div class="text-sm text-gray-500">
                        Автор: {{$post->name}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
