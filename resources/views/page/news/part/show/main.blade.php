<div class="single-post">
    <div class="feature-img">
        <img class="img-fluid" src="{{ asset('image/news/'.$news->photo) }}" alt="">
    </div>
    <div class="blog_details">
        <h2 style="color: #2d2d2d;">
            {{ $news->title }}
        </h2>
        <ul class="blog-info-link mt-3 mb-4">
            <li>
                <a href="{{ route('user.show', $news->user->id) }}"><i class="fa fa-user"></i>
                    {{ $news->user->nama }}
                </a>
            </li>
            <li>
                <a href="{{ route('category.show', $news->category->name) }}"><i class="fa fa-tags"></i>
                    {{ $news->category->name }}
                </a>
            </li>
        </ul>
        <p class="excert">
            <?= $news->description ?>
        </p>
    </div>
</div>