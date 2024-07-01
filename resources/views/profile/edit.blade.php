@section('page.title', __('Профиль'))

<div class="flex flex-col gap-3 max-w-xl mx-auto">
    @foreach(['data-form', 'password-form', 'remove-form'] as $form)
        <div class="p-4 sm:p-8 bg-white sm:shadow sm:rounded-xl">
            <div class="max-w-xl">
                @include("profile.partials.$form")
            </div>
        </div>
    @endforeach
</div>

<script>
    function pageRedirect(e) {
        if (!!e.value) {
            window.location = '/profile?id=' + e.value;
            return;
        }
        window.location = '/profile';
    }
</script>
