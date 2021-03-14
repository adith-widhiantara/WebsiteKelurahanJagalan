@extends('base.base')

@section('title')
{{ $news->title }}
@endsection

@section('base')
{{-- slider --}}
@include('page.news.part.show.slider')
{{-- end slider --}}

{{-- main --}}
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                @include('page.news.part.show.main')

                <div class="navigation-top">
                    {{-- sosial media --}}
                    @include('page.news.part.show.social-media')
                    {{-- end sosial media --}}

                    {{-- next-prev-post --}}
                    @include('page.news.part.show.next-prev-post')
                    {{-- end next-prev-post --}}
                </div>

            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    {{-- search bar --}}
                    @include('page.news.part.search-bar')
                    {{-- end search bar --}}

                    {{-- category --}}
                    @include('page.news.part.category')
                    {{-- end category --}}

                    {{-- recent-post --}}
                    @include('page.news.part.recent-news')
                    {{-- end recent-post --}}
                </div>
            </div>
        </div>
    </div>
</section>
{{-- end main --}}
@endsection