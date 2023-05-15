
@if ($paginator->hasPages())
        <div class="pagination justify-content-center" data-aos="fade-up">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if (($paginator->hasMorePages() && ($paginator->currentPage() > 2)) || ($paginator->currentPage() == $paginator->lastPage()))
                    <a class="page-link" href="{{ $paginator->url($paginator->onFirstPage()) }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <li class="page-item">
                            &lsaquo;&lsaquo;
                        </li>
                    </a>
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">{{ __('messages.Previous') }}</a>
                    </li>
                @elseif($paginator->hasMorePages() && ($paginator->currentPage() == 2))
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">{{ __('messages.Previous') }}</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                            <li class="page-item"><a class="page-link active" href="{{ $paginator->url($paginator->currentPage()) }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                
                <?php 
                $nextPage = ($paginator->currentPage() + 1);
                ?>
                @if ($paginator->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($nextPage) }}">{{ $nextPage }}</a></li>
                    @if(($nextPage) < $paginator->lastPage())
                        @if((($nextPage) + 1) < $paginator->lastPage())
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url(($nextPage) + 1) }}">{{ (($nextPage) + 1) }}</a></li>
                        @endif
                        @if((($nextPage) + 2) < $paginator->lastPage())
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url(($nextPage) + 2) }}">{{ (($nextPage) + 2) }}</a></li>
                        @endif
                        @if((($nextPage) + 3) < $paginator->lastPage())
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url(($nextPage) + 3) }}">{{ (($nextPage) + 3) }}</a></li>
                        @endif
                        <li class="page-item d-flex align-items-end"><span>...</span></li>
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
                    @endif
                @endif


                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages() &&  (($paginator->currentPage() + 1) < $paginator->lastPage()))
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">{{ __('messages.Next') }}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">&rsaquo;&rsaquo;</a>
                    </li>
                @endif
            </ul>
        </div>
@endif