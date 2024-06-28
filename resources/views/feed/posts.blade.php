@section('page.title', 'Personal')
@section('header', __('Личные публикации'))
@section('message', session('message'))

<x-app-layout>
    <div class="flex justify-end pb-3">
        <a href="{{route('feed.create')}}">
            <x-primary-button class="ms-3">{{ __('Добавить пост') }}</x-primary-button>
        </a>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @if(!empty($posts))
            @foreach ($posts as $post)
                <div class="grid grid-cols-4 gap-4 bg-gray-50 rounded-lg">
                    @isset($post->image)
                        <a href="{{ route('feed.show', ['post' => $post->id]) }}" class="col-span-1">
                            <img class="rounded-lg mx-auto" src="{{asset($post->image)}}" alt="Post Picture">
                        </a>
                    @endisset
                    <div class="flex flex-col {{isset($post->image) ? 'col-span-3' : 'col-span-4'}} p-5">
                        <a href="{{ route('feed.show', ['post' => $post->id]) }}" class="text-xl font-bold">
                            {{$post->title}}
                        </a>
                        <p class="flex-grow py-4">
                            {{$post->content}}
                        </p>
                        <div class="flex gap-4 justify-end items-center w-full">
                            <div class="text-xs text-gray-400">
                                Опубликовано: {{date('H:i d.m.Y', strtotime($post->created_at))}}
                            </div>
                            <a class="text-sm text-blue-500" href="{{ route('feed.edit', ['post' => $post->id]) }}">
                                Редактировать
                            </a>
                            <a class="text-sm text-red-500" href="{{ route('feed.remove', ['post' => $post->id]) }}">
                                Удалить
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            No publications
        @endif
    </div>
    <div class="py-4">
        {{ $posts->links() }}
    </div>
</x-app-layout>
