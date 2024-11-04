<form action="{{ route('app.course.review.store', $course->id) }}" method="POST" class="comments-form__form contact-form-validated form-one">
    @csrf

    <h3 class="comments-form__title">Leave a Comment</h3>
    <div class="eduhive-ratings">
        <input type="hidden" name="rating" id="rating" value="0">

        @for ($i = 1; $i <= 5; $i++)
            <span class="eduhive-ratings__icon" onclick="setRating({{ $i }})">
                <i class="fa fa-star" id="star-{{ $i }}" data-value="{{ $i }}"></i>
            </span>
        @endfor
    </div>
    <div class="comments-form">
        <div class="form-one__group">
            <div class="form-one__control form-one__control--full wow fadeInUp" data-wow-duration="1500ms"
                data-wow-delay="100ms">
                <textarea type="text" name="review" placeholder="Write Message . ."></textarea>
            </div>
            <div class="form-one__control form-one__control--full wow fadeInUp" data-wow-duration="1500ms"
                data-wow-delay="150ms">
                <button type="submit" class="comments-form__btn eduhive-btn eduhive-btn--normal"><span>Post
                        Comment</span></button>
            </div>
        </div>
    </div>
</form>
