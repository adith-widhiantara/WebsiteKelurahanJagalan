@if ( $news->hasPages() )
<nav class="blog-pagination justify-content-center d-flex">
    <ul class="pagination">
        @if ( $news->onFirstPage() )
        <li class="page-item">
            <a href="#" class="page-link" aria-label="Previous">
                <i class="ti-angle-left"></i>
            </a>
        </li>
        @else
        <li class="page-item">
            <a href="{{ $news->previousPageUrl() }}" class="page-link" aria-label="Previous">
                <i class="ti-angle-left"></i>
            </a>
        </li>
        @endif

        @if($news->currentPage() > 2)
        <li class="page-item">
            <a href="{{ $news->url(1) }}" class="page-link">1</a>
        </li>
        @endif
        @if($news->currentPage() > 3)
        <li class="page-item">
            <a href="#" class="page-link">...</a>
        </li>
        @endif

        @for ( $i = 1; $i <= $news->lastPage(); $i++ )
            @if($i >= $news->currentPage() - 1 && $i <= $news->currentPage() + 1)
                @if ($i == $news->currentPage())
                <li class="page-item active">
                    <a href="#" class="page-link">{{ $i }}</a>
                </li>
                @else
                <li class="page-item">
                    <a href="{{ $news->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
                @endif
                @endif
                @endfor

                @if($news->currentPage() < $news->lastPage() - 2)
                    <li class="page-item">
                        <a href="#" class="page-link">...</a>
                    </li>
                    @endif

                    @if($news->currentPage() < $news->lastPage() - 1)
                        <li class="page-item">
                            <a href="{{ $news->url($news->lastPage()) }}" class="page-link">{{ $news->lastPage() }}</a>
                        </li>
                        @endif

                        @if ($news->hasMorePages())
                        <li class="page-item">
                            <a href="{{ $news->nextPageUrl() }}" class="page-link" aria-label="Next">
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