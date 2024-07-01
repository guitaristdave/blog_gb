@section('page.title', __('Редактирование пользователя'))

<div class="flex flex-col gap-3 max-w-xl mx-auto">
    @if(Auth::user()->is_admin)
        <div class="p-4 sm:p-8 bg-white sm:shadow sm:rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.manage-users-form')
            </div>
        </div>

        @if($selectedUser)
            <div class="p-4 sm:p-8 bg-white sm:shadow sm:rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.manage-data-form', ['user' => $selectedUser])
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white sm:shadow sm:rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.remove-form', ['action' => 'profile.destroy-user'])
                </div>
            </div>
        @endif

    @endif
</div>

<script>
    function pageRedirect(e) {
        if (!!e.value) {
            window.location = '/manage?id=' + e.value;
            return;
        }
        window.location = '/manage';
    }
</script>
