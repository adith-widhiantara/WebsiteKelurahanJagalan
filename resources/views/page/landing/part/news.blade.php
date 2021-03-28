<div class="services-area section-padding41">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle mb-60 text-center">
                    <h2>Berita Terbaru</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($recentNews as $news)
            <div class="col-xl-12">
                <div class="single-services single-services2 mb-30">
                    <div class="row no-gutters">
                        <div class="col-xl-4 col-lg-6 col-md-5">
                            <div class="features-img features-img2">
                                <img src="{{ asset('image/news/'. $news->photo) }}" alt="">
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-7">
                            <div class="features-caption features-caption2">
                                <h3>
                                    <a href="{{ route('news.show', $news->slug) }}">{{ $news -> title }}</a>
                                </h3>
                                <?= substr($news -> description, 0, 100).'...' ?>
                                <div>
                                </div>
                                <a href="{{ route('news.show', $news->slug) }}" class="all-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="details-btn text-center mt-50">
                    <a href="{{ route('news.index') }}" class="border-btn">Berita Lainnya</a>
                </div>
            </div>
        </div>
    </div>
</div>