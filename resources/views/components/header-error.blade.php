@props(['value'])

@php
    $id = 'error'.rand(1000000,9999999);
@endphp

<div id="{{$id}}" {{ $attributes->merge(['class' => 'flex gap-3 justify-between items-center bg-red-100 xl:rounded-xl px-4 sm:px-6 lg:px-8 mx-auto mb-6']) }}>
    <div class="py-3 text-red-500 font-semibold cursor-default">{{ $value ?? $slot }}</div>
</div>
