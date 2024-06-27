@extends('layouts.base')
@section('page.title', 'Добавить пост')

@section('content')
    <div class="wrapper py-10">
        <div class="container mx-auto max-w-3xl">
            <div class="grid gap-6">
                <h4 class="text-2xl font-bold mb-6">
                    {{ __('Добавить пост') }}
                </h4>
                <form action="{{ route('feed.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-md">
                    @csrf
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Заголовок') }}
                        </label>
                        <input type="text" name="title" id="title" value="{{old('title')}}" class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autofocus>
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Текст') }}
                        </label>
                        <textarea name="content" id="content" rows="8" class="form-textarea mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{old('content')}}</textarea>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Добавить пост') }}
                        </button>
                    </div>
                </form>
            </div>
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

        </div>
    </div>
@endsection
