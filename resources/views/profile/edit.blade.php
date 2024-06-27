<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if($user->is_admin)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900">
                            Manage users
                        </h2>
                        <select onchange="pageRedirect(this)" id="select">
                            <option value=""></option>
                            @foreach ($users as $item)
                                <option value="<?php echo $item->id; ?>" @selected($selectedUser && $selectedUser->id == $item->id)>
                                    {{$item->name}} / {{$item->email}}
                                </option>
                            @endforeach
                        </select>
                        @if($selectedUser)
                            <div>
                                @include('profile.partials.update-user-profile-information-form', ['user' => $selectedUser])
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function pageRedirect(e){
        if(!!e.value){
            window.location = '/profile?id='+e.value
            return
        }
        window.location = '/profile'
    }
</script>
