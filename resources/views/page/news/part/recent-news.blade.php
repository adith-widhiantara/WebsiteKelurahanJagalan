<aside class="single_sidebar_widget popular_post_widget">
    <h3 class="widget_title" style="color: #2d2d2d;">Recent Post</h3>

    @foreach ($recentNews as $news)
    <div class="media post_item">
        <img src="{{ asset('assets/img/blog/single_blog_1.png') }}" alt="post"
            style="height: 80px; width: 80px; object-fit: cover">
        <div class="media-body">
            <a href="{{ route('news.show', $news->slug) }}">
                <h3 style="color: #2d2d2d;">{{ $news -> title }}</h3>
            </a>
            <p>{{ $news -> created_at -> diffForHumans() }}</p>
        </div>
    </div>
    @endforeach

</aside>