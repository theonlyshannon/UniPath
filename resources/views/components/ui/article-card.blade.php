<div class="col-md-12">
    <div class="blog-card blog-card--three fadeInUp" data-wow-duration='1500ms'>
        <div class="blog-card__image">
            <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}">
            <div class="blog-card__date">
                <span class="blog-card__date__day">{{ $article->created_at }}</span>
                <span class="blog-card__date__month">{{ $article->created_at }}</span>
            </div>
        </div>
        <div class="blog-card__content">
            <ul class="list-unstyled blog-card__meta">
                <li>
                    <a href="#">
                        <span class="blog-card__meta__icon">
                            <i class="far fa-user"></i>
                        </span>
                        {{ $article->writer->name }}
                    </a>
                </li>
            </ul>
            <h3 class="blog-card__title">
                <a href="{{ route('app.article.show', $article->slug) }}">
                    {{ $article->title }}
                </a>
            </h3>
            <p class="blog-card__text">{!! $article->content !!}</p>
            <a href="{{ route('app.article.show', $article->slug) }}" class="blog-card__btn eduhive-btn">
                <span class="eduhive-btn__text">read more</span>
                <span class="eduhive-btn__icon">
                    <span class="eduhive-btn__icon__inner"><i class="icon-arrow-right-2"></i></span>
                </span>
            </a>
        </div>
    </div>
</div>
