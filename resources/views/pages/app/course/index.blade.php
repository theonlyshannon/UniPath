<x-layouts.app title="Kelas">
    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a
                            href="index.html">Home</a></li>
                    <li><span>Our Course</span></li>
                </ul><!-- /.eduhive-breadcrumb list-unstyled -->
                <h2 class="page-header__title">Blog List Right Sidebar</h2>
            </div><!-- /.page-header__content -->
        </div><!-- /.container -->
        <img src="assets/images/shapes/page-header-shape-1.png" alt="shape" class="page-header__shape-one">
        <img src="assets/images/shapes/page-header-shape-2.png" alt="shape" class="page-header__shape-two">
        <div class="page-header__shape-three"></div><!-- /.page-header__shape-three -->
        <div class="page-header__shape-four"></div><!-- /.page-header__shape-four -->
    </section><!-- /.page-header -->

    <section class="courses-three section-space2" id="courses">
        <div class="container">
            <div class="sec-title sec-title--center wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                <h6 class="sec-title__tagline">our courses</h6><!-- /.sec-title__tagline -->
                <h3 class="sec-title__title"><span>Our</span> <span class="sec-title__title__shape">Most</span> <span>Popular</span> <span class="sec-title__title__text">Courses</span></h3><!-- /.sec-title__title -->
            </div><!-- /.sec-title -->
            <div class="row gutter-y-30">
                @foreach ($courses as $course)
                    <div class="col-lg-6">
                        <div class="course-card course-card--two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='00ms'>
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
                                {{-- <div class="course-card__ratings">
                                    <div class="eduhive-ratings">
                                        @for ($i = 0; $i < 5; $i++)
                                            <span class="eduhive-ratings__icon">
                                                <i class="fa fa-star{{ $i < $course->averageRating() ? '' : '-o' }}"></i>
                                            </span>
                                        @endfor
                                    </div>
                                    <p class="course-card__ratings__text">{{ $course->reviews_count ?? 0 }} Ratings</p>
                                </div> --}}
                                <h4 class="course-card__price">Rp<span>{{ number_format($course->price, 0, ',', '.') }}</span></h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- /.row gutter-y-30 -->
        </div><!-- /.container -->
        <img src="assets/images/shapes/courses-shape-3-1.png" alt="shape" class="courses-three__shape-one">
        <img src="assets/images/shapes/courses-shape-3-2.png" alt="shape" class="courses-three__shape-two">
        <div class="courses-three__box-one"></div><!-- /.courses-three__box-one -->
        <div class="courses-three__box-two"></div><!-- /.courses-three__box-two -->
    </section><!-- /.courses-three section-space2 -->

</x-layouts.app>
