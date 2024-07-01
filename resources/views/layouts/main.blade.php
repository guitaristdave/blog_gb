<!DOCTYPE html>

{{--@section('page.title', 'Page Title')--}}
{{--@section('page.keywords', 'Keywords')--}}
{{--@section('page.description', 'Description')--}}
{{--@section('page.canonical', 'Canonical')--}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page.title', config('app.name', 'Laravel'))</title>

    @include('includes.head')
</head>
<body class="flex flex-col justify-between min-h-screen font-sans antialiased">

<header class="relative z-50 bg-white shadow">
    @include('includes.header')
</header>

<main class="relative bg-white flex flex-grow flex-col xl:gap-3 items-center">
    <!-- Header / Title -->
    <div class="container xl:rounded-b-xl bg-gray-100 max-w-7xl py-3 px-4 sm:px-6 lg:px-8 shadow">
        <div class="font-semibold text-xl text-gray-600 leading-tight cursor-default">
            @hasSection('header')
                @yield('header')
            @elseif(isset($header))
                {{$header}}
            @else
                @yield('page.title', config('app.name', 'Laravel'))
            @endif
        </div>
    </div>

    <!-- Messages -->
    <div class="container max-w-7xl flex flex-col xl:gap-3">
        @if(session('error'))
            <div id="error" class="flex gap-3 justify-between items-center bg-red-100 xl:rounded-xl px-4 sm:px-6 lg:px-8">
                <div class="py-3 text-red-500 font-semibold cursor-default">{{session('error')}}</div>
                <x-secondary-button class="fill-current text-red-500" onclick="document.querySelector('#error').classList.add('close')">close</x-secondary-button>
            </div>
        @endif
        @if(session('message'))
            <div id="message" class="flex gap-3 justify-between items-center bg-blue-100 xl:rounded-xl px-4 sm:px-6 lg:px-8">
                <div class="py-3 text-blue-500 font-semibold cursor-default">{{session('message')}}</div>
                <x-secondary-button class="fill-current text-red-500" onclick="document.querySelector('#message').classList.add('close')">close</x-secondary-button>
            </div>
        @endif
    </div>

    <!--
    {{--    TODO: check/remove--}}
    {{--    auth: min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100--}}
    {{--    guest_block: w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg--}}
    {{--    Page Heading:--}}
    {{--    @isset($header)--}}
    {{--        <header class="bg-white shadow">--}}
    {{--            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
    {{--                {{ $header }}--}}
    {{--            </div>--}}
    {{--        </header>--}}
    {{--    @endisset--}}
    {{--    Logo: <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
    -->

    <!-- Content -->
    <div class="container max-w-7xl py-3 px-4 sm:px-6 lg:px-8 flex-grow mt-6 xl:mt-0">
        @isset($slot)
            {!! $slot !!}
        @endisset
        @yield('content')
    </div>
</main>

<footer class="relative bg-gray-100 shadow py-2 border-t border-gray-100 text-gray-500">
    @include('includes.footer')
</footer>

</body>
</html>
