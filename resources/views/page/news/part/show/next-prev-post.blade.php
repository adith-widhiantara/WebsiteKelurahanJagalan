@php
$nextPost = \App\Models\News\News::where('id', $news->id + 1)->first();
$prevPost = \App\Models\News\News::where('id', $news->id - 1)->first();

if (empty($nextPost)) {
$nextPost = \App\Models\News\News::orderBy('id', 'asc')->first();
}

if (empty($prevPost)) {
$prevPost = \App\Models\News\News::orderBy('id', 'desc')->first();
}
@endphp

<div class="navigation-area">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
            <div class="thumb">
                <a href="{{ route('news.show', $prevPost->slug) }}">
                    <img src="{{ asset('image/news/'.$prevPost->photo) }}" alt=""
                        style="width: 60px; height: 60px; object-fit: cover">
                </a>
            </div>
            <div class="arrow">
                <a href="{{ route('news.show', $prevPost->slug) }}">
                    <span class="lnr text-white ti-arrow-left"></span>
                </a>
            </div>
            <div class="detials">
                <p>Prev Post</p>
                <a href="{{ route('news.show', $prevPost->slug) }}">
                    <h4 style="color: #2d2d2d;">{{ $prevPost -> title }}</h4>
                </a>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
            <div class="detials">
                <p>Next Post</p>
                <a href="{{ route('news.show', $nextPost->slug) }}">
                    <h4 style="color: #2d2d2d;">{{ $nextPost -> title }}</h4>
                </a>
            </div>
            <div class="arrow">
                <a href="{{ route('news.show', $nextPost->slug) }}">
                    <span class="lnr text-white ti-arrow-right"></span>
                </a>
            </div>
            <div class="thumb">
                <a href="{{ route('news.show', $nextPost->slug) }}">
                    <img src="{{ asset('image/news/'.$nextPost->photo) }}" alt=""
                        style="width: 60px; height: 60px; object-fit: cover">
                </a>
            </div>
        </div>
    </div>
</div>