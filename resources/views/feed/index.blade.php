@section('page.title', 'Лента')
@section('header', __('Последние посты'))
@section('message', session('message'))

<x-app-layout>
    <div class="grid grid-cols-1 gap-4">
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
                    <div class="flex justify-between items-center w-full">
                        <div class="text-sm text-gray-500">
                            Автор: {{$post->name}}
                        </div>
                        <div class="text-xs text-gray-400">
                            Опубликовано: {{date('H:i d.m.Y', strtotime($post->created_at))}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="py-4">
        {{ $posts->links() }}
    </div>
</x-app-layout>
