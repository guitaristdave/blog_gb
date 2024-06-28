<!DOCTYPE html>

{{--@section('page.title', 'Page Title')--}}
{{--@section('page.keywords', 'Keywords')--}}
{{--@section('page.description', 'Description')--}}
{{--@section('page.canonical', 'Canonical')--}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page.title', config('app.name', 'Laravel'))</title>

    @include('includes.head')
</head>
<body class="flex flex-col justify-between min-h-screen font-sans antialiased">

<header class="relative z-50 bg-white shadow">
    @include('includes.header')
</header>

<main class="relative flex flex-grow flex-col items-center">
    @if(\Illuminate\Support\Facades\View::hasSection('header') || isset($header))
        <div class="container bg-gray-100 shadow max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <div class="font-semibold text-xl text-gray-600 leading-tight cursor-default">
                @hasSection('header')
                    @yield('header')
                @elseif(isset($header))
                    {{$header}}
                @endif
            </div>
        </div>
    @endif

    @if(\Illuminate\Support\Facades\View::hasSection('message') || isset($message))
        <div id="message" class="container bg-gray-50 shadow max-w-7xl my-3 py-6 px-4 sm:px-6 lg:px-8 flex items-center gap-3 justify-between">
            <div class="font-semibold cursor-default">
                @hasSection('message')
                    @yield('message')
                @elseif(isset($message))
                    {{$message}}
                @endif
            </div>
            <x-danger-button onclick="document.querySelector('#message').style.display = 'none'">Close</x-danger-button>
        </div>
    @endif

    {{--    TODO: check--}}
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

    <div class="container max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        @isset($slot)
            {{$slot}}
        @endisset
        @yield('content')
    </div>


    {{--    <div class="container">--}}

{{--        Slot:--}}
{{--        @isset($slot) {{$slot}} @endisset--}}
{{--        Content:--}}
{{--        @yield('content')--}}

{{--    </div>--}}
</main>

<footer class="relative z-50 bg-white border-t border-gray-100 text-gray-500 py-2">
    @include('includes.footer')
</footer>

</body>
</html>
