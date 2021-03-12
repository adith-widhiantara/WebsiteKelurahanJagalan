<article class="blog_item">
    <div class="blog_item_img">
        <img class="card-img rounded-0" src="assets/img/blog/{{ $image }}" alt="">
        <a href="#" class="blog_item_date">
            <h3>{{ $dateDay }}</h3>
            <p>{{ $dateMonth }}</p>
        </a>
    </div>
    <div class="blog_details">
        <a class="d-inline-block" href="{{ $routeDetail }}">
            <h2 class="blog-head" style="color: #2d2d2d;">
                {{ $title }}
            </h2>
        </a>
        <p>{{ $description }}</p>
        <ul class="blog-info-link">
            <li><a href="#"><i class="fa fa-user"></i> {{ $author }}</a></li>
            <li><a href="#"><i class="fa fa-tags"></i> {{ $tags }}</a></li>
        </ul>
    </div>
</article>