<ul class="list-unstyled comments-one__list mt-5">
    <li class="comments-one__card">
        <div class="comments-one__card__image">
            <img src="{{ asset('app/images/courses/course-c-1-1.png') }}" alt="Kevin martin">
        </div>
        <div class="comments-one__card__content">
            <div class="comments-one__card__top">
                <div class="comments-one__card__info">
                    <h3 class="comments-one__card__title">{{ $review->student->name }}</h3>
                    <p class="comments-one__card__date">{{ $review->date_formatted }}
                        PM</p>
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

{{--
<ul class="list-unstyled comments-one__list">
    <li class="comments-one__card">
        <div class="comments-one__card__image">
            <img src="{{ asset('app/images/courses/course-c-1-1.png') }}" alt="Kevin martin">
        </div>
        <div class="comments-one__card__content">
            <div class="comments-one__card__top">
                <div class="comments-one__card__info">
                    <h3 class="comments-one__card__title">Kevin martin</h3>
                    <p class="comments-one__card__date">March 20, 2023 at 2:37
                        PM</p>
                </div>
                <div class="eduhive-ratings">
                    <span class="eduhive-ratings__icon">
                        <i class="fa fa-star"></i>
                    </span>
                    <span class="eduhive-ratings__icon">
                        <i class="fa fa-star"></i>
                    </span>
                    <span class="eduhive-ratings__icon">
                        <i class="fa fa-star"></i>
                    </span>
                    <span class="eduhive-ratings__icon">
                        <i class="fa fa-star"></i>
                    </span>
                    <span class="eduhive-ratings__icon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>
            <p class="comments-one__card__text">Neque porro est qui dolorem
                ipsum quia quaed inventor veritatis et quasi architecto beatae
                vitae dicta sunt explicabo. Aelltes port lacus quis enim var sed
                efficitur turpis gilla sed sit amet finibus eros. Lorem Ipsum is
                simply dummy</p>
        </div>
    </li>
</ul> --}}
