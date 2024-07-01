<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Manage users') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <select onchange="pageRedirect(this)" id="select" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value=""></option>
        @foreach ($users as $item)
            <option
                value="<?php echo $item->id; ?>" @selected($selectedUser && $selectedUser->id == $item->id)>
                {{$item->name}} / {{$item->email}}
            </option>
        @endforeach
    </select>
</section>
