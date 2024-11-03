<div class="col-lg-6">
    <div class="course-card course-card--two">
        <div class="course-card__image">
            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}">
        </div>
        <div class="course-card__content">
            <div class="course-card__content__top">
                <div class="course-card__category">{{ $course->courseCategory->name ?? 'Category' }}</div>
                <div class="course-card__duration">
                    <span class="course-card__duration__icon">
                        <i class="icon-clock"></i>
                    </span>
                    {{ $course->duration ?? 'Duration' }}
                </div>
            </div>
            <h3 class="course-card__title">
                <a href="{{ route('app.course.show', $course->slug) }}">{{ $course->title }}</a>
            </h3>
            <div class="course-card__info">
                <div class="course-card__lessons">
                    <span class="course-card__lessons__icon">
                        <i class="icon-open-book"></i>
                    </span>
                    {{ $course->syllabus->count() }} Lessons
                </div>
                <div class="course-card__students">
                    <span class="course-card__students__icon">
                        <i class="icon-multiple-users-silhouette"></i>
                    </span>
                    {{ $course->students_count ?? 0 }} Students
                </div>
            </div>
            @php
                $hasAccess = Auth::check() && Auth::user()->hasPurchasedCourse($course->id);
            @endphp
            <h4 class="course-card__price">
                @if($hasAccess)
                    <span>Sudah Dibeli</span>
                @elseif($course->price == 0)
                    <span>Gratis</span>
                @else
                    Rp<span>{{ number_format($course->price, 0, ',', '.') }}</span>
                @endif
            </h4>
        </div>
    </div>
</div>
