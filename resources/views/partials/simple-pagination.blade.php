@if ($paginator->hasPages())
    <nav aria-label="{{ __('Pagination Navigation') }}" class="my-2">
        <div class="join">
            @if ($paginator->onFirstPage())
                <button type="button" class="join-item btn btn-outline btn-disabled" disabled>
                    {!! __('pagination.previous') !!}
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="join-item btn btn-outline">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="join-item btn btn-outline">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <button type="button" class="join-item btn btn-outline btn-disabled" disabled>
                    {!! __('pagination.next') !!}
                </button>
            @endif
        </div>
    </nav>
@endif
