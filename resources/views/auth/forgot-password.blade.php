@section('page.title', __('Восстановление пароля'))

<div class="flex flex-col gap-3 max-w-xl mx-auto">
    <div class="text-sm text-gray-600 text-justify">
        {{ __('Забыли свой пароль? Без проблем. Просто сообщите нам свой адрес электронной почты, и мы вышлем вам по электронной почте ссылку для сброса пароля, которая позволит вам выбрать новый.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status :status="session('status')"/>

    <form class="flex flex-col gap-3" method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>{{ __('Отправить ссылку для восстановления') }}</x-primary-button>
        </div>
    </form>
</div>
