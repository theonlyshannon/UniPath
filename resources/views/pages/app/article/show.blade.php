<x-layouts.app title="{{ $article->title }}" description="{{ $article->excerpt }}" image="{{ asset($article->thumbnail) }}"
    keywords="{{ $article->tags->pluck('name')->join(', ') }}">

    <section class="blog-details-page section-space">
        <div class="container">
            <div class="row gutter-y-60">
                <div class="col-lg-8">
                    <div class="blog-details">
                        <div class="blog-card blog-card--three wow fadeInUp" data-wow-delay="00ms"
                            data-wow-duration="1500ms">
                            <div class="blog-card__image">
                                <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}">
                                <div class="blog-card__date">
                                    <span class="blog-card__date__day"></span>
                                    <span class="blog-card__date__month">June</span>
                                </div>
                            </div>
                            <div class="blog-card__content">
                                <ul class="list-unstyled blog-card__meta">
                                    <li>
                                        <a href="#">
                                            <span class="blog-card__meta__icon">
                                                <i class="far fa-user"></i>
                                            </span>
                                            by Admin
                                        </a>
                                    </li>
                                </ul>
                                <h3 class="blog-card__title">{{ $article->title }}</h3>
                                <div class="blog-details__inner__content">
                                    <p class="blog-details__inner__text">{!! $article->content !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="blog-details__meta">
                            <div class="blog-details__categories">
                                <h4 class="blog-details__meta__title">Categories:</h4>
                                <div class="blog-details__categories__box">

                                    @foreach ($article->categories as $category)
                                        <a href="{{ route('app.article.index', $category->slug) }}"
                                            class="blog-details__categories__btn">{{ $category->name }}</a>
                                    @endforeach

                                </div>
                            </div>

                            <div class="blog-details__tags">
                                <h4 class="blog-details__meta__title">Tags:</h4>
                                <div class="blog-details__tags__box">

                                    @foreach ($article->tags as $tag)
                                        <a href="{{ route('app.article.index', $tag->slug) }}">{{ $tag->name }}</a>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="comments-one">
                        <h3 class="comments-one__title">02 Comments</h3>
                        <ul class="list-unstyled comments-one__list">
                            <x-ui.article-comment-card />
                        </ul>
                    </div>

                    <div class="comments-form">
                        <h3 class="comments-form__title">Leave a Comment</h3>
                        <x-ui.article-comment-form :article="$article"/>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <aside class="widget-area">
                            <div class="sidebar__posts-wrapper sidebar__single">
                                <h4 class="sidebar__title sidebar__posts-title">Latest posts</h4>
                                <ul class="sidebar__posts list-unstyled">
                                    @foreach ($recentArticles as $article)
                                        <li class="sidebar__posts__item">
                                            <div class="sidebar__posts__image">
                                                <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}">
                                            </div>
                                            <div class="sidebar__posts__content">
                                                <div class="sidebar__posts__meta">
                                                    <a href="#">
                                                        <span class="sidebar__posts__meta__icon">
                                                            <i class="icon-user"></i>
                                                        </span>
                                                        By {{ $article->writer->name }}
                                                    </a>
                                                </div>
                                                <h4 class="sidebar__posts__title">
                                                    <a href="{{ route('app.article.show', $article->slug) }}">
                                                        {{ $article->title }}
                                                    </a>
                                                </h4>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="sidebar__categories-wrapper sidebar__single">
                                <h4 class="sidebar__title">Categories</h4>
                                <ul class="sidebar__categories list-unstyled">

                                    @foreach ($categories as $category)
                                        <li>
                                            <a
                                                href="{{ route('app.article.index', ['category' => $category->slug]) }}">
                                                {{ $category->name }}
                                                <span></span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="sidebar__tags-wrapper sidebar__single">
                                <h4 class="sidebar__title">Tags</h4>
                                <div class="sidebar__tags">
                                    @foreach ($tags as $tag)
                                        <a href="{{ route('app.article.index', ['tag' => $tag->slug]) }}">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
