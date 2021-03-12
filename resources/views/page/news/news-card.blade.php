<div class="blog_left_sidebar">
    @foreach ($allNews as $news)
    <x-article>
        <x-slot name="image">single_blog_1.png</x-slot>
        <x-slot name="dateDay">{{ $news->created_at->isoFormat('D') }}</x-slot>
        <x-slot name="dateMonth">{{ $news->created_at->isoFormat('MMM') }}</x-slot>

        <x-slot name="routeDetail">#</x-slot>
        <x-slot name="title">{{ $news->title }}</x-slot>
        <x-slot name="description">{{ $news->description }}</x-slot>

        <x-slot name="author">{{ $news->user->name }}</x-slot>
        <x-slot name="tags">Travel, Lifestyle</x-slot>
    </x-article>
    @endforeach

    @include('page.news.part.pagination')
</div>