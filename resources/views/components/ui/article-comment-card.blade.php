<li class="comments-one__card">
    <div class="comments-one__card__image">
        <img src="{{ asset('app/images/blog/blog-comment-1-1.png') }}" alt="Profile Picture">
    </div>
    <div class="comments-one__card__content">
        <div class="comments-one__card__top">
            <div class="comments-one__card__info">
                <h3 class="comments-one__card__title">{{ $comment->name }}</h3>
                <p class="comments-one__card__date">{{ $comment->created_at_formatted }}</p>
            </div>
        </div>
        <p class="comments-one__card__text">{{ $comment->comment }}</p>
    </div>
</li>
