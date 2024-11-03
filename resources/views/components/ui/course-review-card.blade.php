<ul class="list-unstyled comments-one__list mt-5">
    <li class="comments-one__card">
        <div class="comments-one__card__image">
            <img src="{{ asset('app/images/courses/course-c-1-1.png') }}" alt="Kevin martin">
        </div>
        <div class="comments-one__card__content">
            <div class="comments-one__card__top">
                <div class="comments-one__card__info">
                    <h3 class="comments-one__card__title">{{ $review->student->name }}</h3>
                    <p class="comments-one__card__date">{{ $review->date_formatted }}</p>
                </div>
                <div class="eduhive-ratings">
                    <ul>
                        <span class="eduhive-ratings__icon">
                            @for ($i = 1; $i <= 5; $i++)
                                    <a href="#">
                                        <i class="icon_star icon-star {{ $i <= $review->rating ? 'active' : '' }}"></i>
                                    </a>
                            @endfor
                        </span>
                    </ul>
                </div>
            </div>
            <p>{{ $review->review }}</p>
        </div>
    </li>
</ul>

