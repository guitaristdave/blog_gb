@section('page.title', __('Последние посты'))
@if(session('message') !== null)
    <x-header-message>{{session('message')}}</x-header-message>
@endisset
@if($errors->any())
    @foreach($errors->all() as $error)
        <x-header-error class="max-w-xl">{{$error}}</x-header-error>
    @endforeach
@endif

@section('header')
    <div class="flex items-center justify-between">
        {{__('Последние посты')}}
        @auth
            <a href="{{route('feed.create')}}">
                <x-primary-button>{{ __('Добавить пост') }}</x-primary-button>
            </a>
        @endauth
    </div>
@endsection

<div class="grid grid-cols-1 gap-4">
    @foreach ($posts as $post)
        <div class="grid grid-cols-4 gap-4 bg-gray-50 rounded-lg">
            @isset($post->image)
                <a href="{{route('feed.show', ['post' => $post->id])}}" class="col-span-1 p-5">
                    <img class="rounded-lg mx-auto" src="{{asset($post->image)}}" alt="Post Picture">
                </a>
            @endisset
            <div class="flex flex-col {{isset($post->image) ? 'col-span-3' : 'col-span-4'}} p-5">
                <div>
                    <a href="{{ route('feed.show', ['post' => $post->id]) }}" class="text-xl font-bold">
                        {{$post->title}}
                    </a>
                </div>
                <p class="flex-grow py-4">{{$post->content}}</p>
                <div class="flex justify-between items-center text-gray-400 text-sm cursor-default">
                    <div class="text-gray-500">Автор: {{$post->name}}</div>
                    <div class="text-xs">Опубликовано: {{date('H:i d.m.Y', strtotime($post->created_at))}}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="py-4">{{$posts->onEachSide(2)->links()}}</div>
