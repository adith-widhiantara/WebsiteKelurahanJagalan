@if ( $allNews->hasPages() )
<nav class="blog-pagination justify-content-center d-flex">
    <ul class="pagination">
        @if ( $allNews->onFirstPage() )
        <li class="page-item">
            <a href="#" class="page-link" aria-label="Previous">
                <i class="ti-angle-left"></i>
            </a>
        </li>
        @else
        <li class="page-item">
            <a href="{{ $allNews->previousPageUrl() }}" class="page-link" aria-label="Previous">
                <i class="ti-angle-left"></i>
            </a>
        </li>
        @endif

        @if($allNews->currentPage() > 2)
        <li class="page-item">
            <a href="{{ $allNews->url(1) }}" class="page-link">1</a>
        </li>
        @endif
        @if($allNews->currentPage() > 3)
        <li class="page-item">
            <a href="#" class="page-link">...</a>
        </li>
        @endif

        @for ( $i = 1; $i <= $allNews->lastPage(); $i++ )
            @if($i >= $allNews->currentPage() - 1 && $i <= $allNews->currentPage() + 1)
                @if ($i == $allNews->currentPage())
                <li class="page-item active">
                    <a href="#" class="page-link">{{ $i }}</a>
                </li>
                @else
                <li class="page-item">
                    <a href="{{ $allNews->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
                @endif
                @endif
                @endfor

                @if($allNews->currentPage() < $allNews->lastPage() - 2)
                    <li class="page-item">
                        <a href="#" class="page-link">...</a>
                    </li>
                    @endif

                    @if($allNews->currentPage() < $allNews->lastPage() - 1)
                        <li class="page-item">
                            <a href="{{ $allNews->url($allNews->lastPage()) }}"
                                class="page-link">{{ $allNews->lastPage() }}</a>
                        </li>
                        @endif

                        @if ($allNews->hasMorePages())
                        <li class="page-item">
                            <a href="{{ $allNews->nextPageUrl() }}" class="page-link" aria-label="Next">
                                <i class="ti-angle-right"></i>
                            </a>
                        </li>
                        @else
                        <li class="page-item">
                            <a href="#" class="page-link" aria-label="Next">
                                <i class="ti-angle-right"></i>
                            </a>
                        </li>
                        @endif
    </ul>
</nav>
@endif