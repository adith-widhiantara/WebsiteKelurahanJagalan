<x-article>
    <x-slot name="image">{{ $news->photo }}</x-slot>
    <x-slot name="dateDay">{{ $news->created_at->isoFormat('D') }}</x-slot>
    <x-slot name="dateMonth">{{ $news->created_at->isoFormat('MMM') }}</x-slot>

    <x-slot name="routeDetail">{{ route('news.show', $news->slug) }}</x-slot>
    <x-slot name="title">{{ $news->title }}</x-slot>
    <x-slot name="description"><?= $news->description ?></x-slot>

    <x-slot name="author">{{ $news->user->nama }}</x-slot>
    <x-slot name="routeAuthor">{{ route('user.show', $news->user->id) }}</x-slot>
    <x-slot name="category">{{ $news->category->name }}</x-slot>
    <x-slot name="routeCategory">{{ route('category.show', $news->category->slug) }}</x-slot>
</x-article>