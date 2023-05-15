@if ($paginator->hasPages())
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class=" btn btn-main page-item disabled d-inline" aria-disabled="true">
                    <span class="page-link">@lang('pagination.previous')</span>
                </button>
            @else
                <button class="btn btn-main page-item d-inline">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </button>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button class="btn btn-main page-item d-inline">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </button>
            @else
                <button class="btn btn-main page-item disabled d-inline" aria-disabled="true">
                    <span class="page-link">@lang('pagination.next')</span>
                </button>
            @endif
        </div>
@endif
