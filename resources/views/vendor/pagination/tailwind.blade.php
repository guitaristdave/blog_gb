@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="sm:hidden flex flex-1 items-center justify-between">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center rounded-md px-4 py-2 text-sm border font-medium leading-5 cursor-default bg-white text-gray-300 border-gray-300 dark:bg-gray-800 dark:text-gray-600 dark:border-gray-600">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center rounded-md px-4 py-2 text-sm border font-medium leading-5 hover:border-blue-300 cursor-pointer bg-white text-gray-600 border-gray-300 hover:text-gray-800 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:text-gray-100 dark:active:bg-gray-700 dark:active:text-gray-300">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center rounded-md px-4 py-2 text-sm border font-medium leading-5 hover:border-blue-300 cursor-pointer bg-white text-gray-600 border-gray-300 hover:text-gray-800 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:text-gray-100 dark:active:bg-gray-700 dark:active:text-gray-300">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center rounded-md px-4 py-2 text-sm border font-medium leading-5 cursor-default bg-white text-gray-300 border-gray-300 dark:bg-gray-800 dark:text-gray-600 dark:border-gray-600">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span aria-hidden="true" aria-label="{{ __('pagination.previous') }}" class="inline-flex items-center rounded-l-md px-2 py-2 text-sm border border-r-0 font-medium leading-5 cursor-default bg-white text-gray-300 border-gray-300 dark:bg-gray-800 dark:text-gray-600 dark:border-gray-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}" class="inline-flex items-center rounded-l-md px-2 py-2 text-sm border border-r-0 font-medium leading-5 cursor-pointer bg-white text-gray-600 border-gray-300 hover:text-gray-800 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:text-gray-100 dark:active:bg-gray-700 dark:active:text-gray-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true" class="inline-flex items-center px-4 py-2 text-sm border-t border-b font-medium leading-5 cursor-default bg-white text-gray-300 border-gray-300 dark:bg-gray-800 dark:text-gray-600 dark:border-gray-600">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-disabled="true" class="inline-flex items-center px-4 py-2 text-sm border-t border-b font-medium leading-5 cursor-default bg-white text-gray-300 border-gray-300 dark:bg-gray-800 dark:text-gray-600 dark:border-gray-600">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="inline-flex items-center px-4 py-2 text-sm border-t border-b font-medium leading-5 cursor-pointer bg-white text-gray-600 border-gray-300 hover:text-gray-800 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:text-gray-100 dark:active:bg-gray-700 dark:active:text-gray-300">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}" class="inline-flex items-center rounded-r-md px-2 py-2 text-sm border border-l-0 font-medium leading-5 cursor-pointer bg-white text-gray-600 border-gray-300 hover:text-gray-800 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:text-gray-100 dark:active:bg-gray-700 dark:active:text-gray-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <span aria-hidden="true" aria-label="{{ __('pagination.next') }}" class="inline-flex items-center rounded-r-md px-2 py-2 text-sm border border-l-0 font-medium leading-5 cursor-default bg-white text-gray-300 border-gray-300 dark:bg-gray-800 dark:text-gray-600 dark:border-gray-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
