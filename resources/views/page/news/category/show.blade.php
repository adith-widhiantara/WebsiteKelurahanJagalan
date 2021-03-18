@extends('base.base')

@section('title')
{{ $category->name }}
@endsection

@section('base')
{{-- slider --}}
@include('page.news.category.part.slider')
{{-- end slider --}}

<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    {{-- news-card area --}}
                    @each('page.news.category.part.news-card', $news, 'news',
                    'page.news.category.part.news-card-empty')
                    {{-- end news-card area --}}

                    @include('page.news.category.part.pagination')
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
@endsection