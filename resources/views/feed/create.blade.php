@section('page.title', __(isset($post) ? 'Изменить пост' : 'Добавить пост'))

<div class="flex flex-col gap-3 max-w-xl mx-auto">
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3">
            <strong class="font-bold">Ошибки!</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form
        action="{{ isset($post) ? route('feed.update', ['post' => $post->id]) : route('feed.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="flex flex-col gap-3"
    >
        @csrf
        @if(isset($post))
            @method('PATCH')
        @endif
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Заголовок') }}</label>
            <input type="text" name="title" id="title" value="{{ isset($post) ? $post->title : old('title') }}" class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autofocus>
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Текст') }}</label>
            <textarea name="content" id="content" rows="8" class="form-textarea mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ isset($post) ? $post->content : old('content') }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Загрузить фото') }}</label>
            <input type="file" name="image" id="image" class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
        </div>
    </form>
</div>
