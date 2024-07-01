@section('page.title', __('Подтверждение Email адреса'))

<div class="flex flex-col gap-3 max-w-xl mx-auto">
    <div class="text-sm text-gray-600 text-justify">
        {{ __('Спасибо, что зарегистрировались! Прежде чем приступить к работе, не могли бы вы подтвердить свой адрес электронной почты, перейдя по ссылке, которую мы только что отправили вам по электронной почте? Если вы не получили это письмо, мы с радостью отправим вам другое.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="font-medium text-sm text-green-600">
            {{ __('На адрес электронной почты, который вы указали при регистрации, была отправлена новая ссылка для подтверждения.') }}
        </div>
    @endif

    <div class="flex items-center justify-between mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>{{ __('Отправить письмо со ссылкой') }}</x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-blue-500">{{ __('Выйти') }}</button>
        </form>
    </div>
</div>
