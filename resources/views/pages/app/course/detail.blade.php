<x-layouts.app title="Kelas {{ $course->title }}">
    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a
                            href="{{ route('app.dashboard') }}">Home</a></li>
                    <li><span>Our Courses</span></li>
                    <li><span>{{ $course->title }}</span></li>
                </ul>
                <h2 class="page-header__title">{{ $course->title }}</h2>
            </div>
        </div>
        <img src="{{ asset('assets/images/shapes/page-header-shape-1.png') }}" alt="shape"
            class="page-header__shape-one">
        <img src="{{ asset('assets/images/shapes/page-header-shape-2.png') }}" alt="shape"
            class="page-header__shape-two">
        <div class="page-header__shape-three"></div>
        <div class="page-header__shape-four"></div>
    </section>

    <section class="course-details section-space">
        <div class="container">
            <div class="row gutter-y-40">
                <div class="col-xl-8 col-lg-7">
                    <div class="course-details__inner">
                        <h3 class="course-details__title">{{ $course->title }}</h3>
                        <div class="course-details__info-wrapper">
                            <div class="course-details__mentor">
                                <img src="{{ asset('storage/' . $course->mentor->profile_picture) }}"
                                    alt="{{ $course->mentor->name }}" class="course-details__mentor__image">
                                <h4 class="course-details__mentor__name">
                                    <a href="#">{{ $course->mentor->name }}</a>
                                </h4>
                            </div>
                            <div class="course-details__class">
                                <span class="course-details__class__icon">
                                    <i class="icon-video"></i>
                                </span>
                                <p class="course-details__class__text">{{ $course->syllabus->count() ?? 0 }} Classes
                                </p>
                            </div>
                        </div>
                        <div class="course-details__image">
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}">
                            <a href="{{ $course->trailer }}" class="course-details__video-btn video-btn video-popup">
                                <i class="icon-play"></i>
                                <span></span><span></span><span></span><span></span>
                            </a>
                            <span
                                class="course-details__category">{{ $course->courseCategory->name ?? 'Technology' }}</span>
                        </div>
                        <div class="course-details__description">
                            <h3 class="course-details__title course-details__title--description">Course Description</h3>
                            <p class="course-details__description__text">{{ $course->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="course-details__info">
                        <h3 class="course-details__info__title">Course Includes:</h3>
                        <ul class="course-details__info__list list-unstyled">
                            <li>
                                <div class="course-details__info__text">
                                    <div class="course-details__info__text__title">
                                        <span class="course-details__info__icon"><i class="icon-ranking"></i></span>
                                        Level:
                                    </div>
                                    <span>{{ ucfirst($course->level) }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="course-details__info__text">
                                    <div class="course-details__info__text__title">
                                        <span class="course-details__info__icon"><i class="icon-clock-1"></i></span>
                                        Duration:
                                    </div>
                                    <span>{{ $course->meetings }} hours</span>
                                </div>
                            </li>
                            <li>
                                <div class="course-details__info__text">
                                    <div class="course-details__info__text__title">
                                        <span class="course-details__info__icon"><i class="icon-graduation"></i></span>
                                        Lessons:
                                    </div>
                                    <span>{{ $course->syllabus->count() }}</span>
                                </div>
                            </li>
                        </ul>
                        <div class="course-details__info__price">This course Fee
                            Rp{{ number_format($course->price, 0, ',', '.') }}</div>
                        @if (Auth::check())
                            <form action="{{ route('app.cart.add', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="course-details__info__btn eduhive-btn">
                                    <span class="eduhive-btn__text">Join This course</span>
                                    <span class="eduhive-btn__icon">
                                        <span class="eduhive-btn__icon__inner"><i class="icon-arrow-right"></i></span>
                                    </span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="course-details__info__btn eduhive-btn">
                                <span class="eduhive-btn__text">Login untuk Bergabung</span>
                                <span class="eduhive-btn__icon">
                                    <span class="eduhive-btn__icon__inner"><i class="icon-arrow-right"></i></span>
                                </span>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
