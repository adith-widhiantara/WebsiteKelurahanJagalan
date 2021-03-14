<aside class="single_sidebar_widget post_category_widget">
    <h4 class="widget_title" style="color: #2d2d2d;">Category</h4>
    <ul class="list cat-list">
        @foreach ($categoryList as $category)
        <li>
            <a href="{{ route('category.show', $category->slug) }}" class="d-flex">
                <p>{{ $category->name }}</p>
                <p>({{ \App\Models\News\News::where('category_id', $category->id)->count() }})</p>
            </a>
        </li>
        @endforeach
    </ul>
</aside>