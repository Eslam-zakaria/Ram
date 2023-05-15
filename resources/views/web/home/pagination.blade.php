@if ($paginator->lastPage() > 1)
    <div class="pagination justify-content-center" data-aos="fade-up">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}">{{ __('messages.Previous') }}</a>
            </li>
            <?php
                if($paginator->lastPage() <= 4){
                $count = $paginator->lastPage();
                } else {
                $count = 4; 
                }
            ?>
            @for ($i = 1; $i <= $count; $i++) 
            <li class="page-item"><a class="page-link {{ ($paginator->currentPage() == $i) ? ' active' : '' }}" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endfor
            @if($paginator->lastPage() > 4)
            <li class="page-item d-flex align-items-end"><span>...</span></li>
            <li class="page-item"><a class="page-link {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' active' : '' }}" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
            @endif
            @if($paginator->currentPage() < $paginator->lastPage())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}">{{ __('messages.Next') }}</a>
            </li>
            @endif
        </ul>
    </div>
@endif