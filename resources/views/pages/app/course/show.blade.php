<x-layouts.app title="{{ $course->title }}">
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
                        <div class="course-details__main-tab-box tabs-box">
                            <ul class="tab-buttons">
                                <li data-tab="#overview" class="tab-btn active-btn">overview</li>
                                <li data-tab="#curriculum" class="tab-btn">curriculum</li>
                                <li data-tab="#reviews" class="tab-btn">reviews</li>
                            </ul>
                            <div class="tabs-content">
                                <div class="tab active-tab fadeInUp animated" data-wow-delay="200ms" id="overview"
                                    style="display: block;">
                                    <div class="course-details__description wow fadeInUp" data-wow-duration="1500ms">
                                        <h3 class="course-details__title course-details__title--description">Course
                                            Descriptions</h3>
                                        <div class="course-details__description__inner">
                                            <p class="course-details__description__text">
                                                {!! $course->description !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab active-tab fadeInUp animated" data-wow-delay="200ms" id="curriculum"
                                    style="display: none;">
                                    <div class="course-details__accordion">
                                        <div class="eduhive-accordion" data-grp-name="eduhive-accordion">
                                            <div class="accordion active">
                                                <div class="accordion-title">
                                                    <h4>Syllabus</h4>
                                                    <span class="accordion-title__icon"></span>
                                                </div>
                                                <div class="accordion-content">
                                                    <div class="inner">
                                                        <div class="course-details__accordion__inner">
                                                            @foreach ($course->syllabus as $syllabus)
                                                                @if ($hasAccess)

                                                                    <a href="{{ $syllabus->video }}"
                                                                        class="course-details__accordion__class video-popup"
                                                                        onclick="markAsComplete('{{ $syllabus->id }}', 'video')">
                                                                        <span
                                                                            class="course-details__accordion__class__title">
                                                                            <span
                                                                                bclass="course-details__accordion__class__icon">
                                                                                <i class="icon-files"></i>
                                                                            </span>
                                                                            {{ $syllabus->title }}
                                                                        </span>
                                                                        <span class="course-details__accordion__class__right">
                                                                            <x-ui.base-button
                                                                                onclick="markAsComplete('{{ $syllabus->id }}', 'file'); window.location.href='{{ asset('storage/assets/files/course/syllabus/' . $syllabus->file) }}';"
                                                                                download>
                                                                                File Materi
                                                                            </x-ui.base-button>
                                                                        </span>

                                                                        <span class="course-details__accordion__class__right">
                                                                            <x-ui.base-button
                                                                                onclick="markAsComplete('{{ $syllabus->id }}', 'video'); window.open('{{ $syllabus->video }}', '_blank');">
                                                                                Video Materi
                                                                            </x-ui.base-button>
                                                                        </span>

                                                                        <span
                                                                            class="course-details__accordion__class__check {{ $syllabus->is_complete ? 'complete' : '' }}">
                                                                            <i class="icon-check"></i>
                                                                        </span>
                                                                    </a>
                                                                @else
                                                                    <!-- Materi terkunci -->
                                                                    <div
                                                                        class="course-details__accordion__class locked">
                                                                        <span
                                                                            class="course-details__accordion__class__title">
                                                                            <span
                                                                                class="course-details__accordion__class__icon">
                                                                                <i class="icon-lock"></i>
                                                                            </span>
                                                                            {{ $syllabus->title }}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab fadeInUp animated" data-wow-delay="200ms" id="reviews"
                                    style="display: none;">
                                    <div class="comments-one course-details__comments">
                                        <h3 class="comments-one__title">Apa Kata Mereka</h3>
                                        @if ($reviews->isEmpty() || !$reviews->where('is_active', true)->count())
                                            <p>Tidak ada commentar</p>
                                        @else
                                            @foreach ($reviews as $review)
                                                @if ($review->is_active)
                                                    <x-ui.course-review-card :review="$review" />
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="course-review-form mt-5">
                                        <x-ui.course-review-form :course="$course" />
                                    </div>
                                </div>
                            </div>
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
                                        <span class="course-details__info__icon"><i class="icon-clock-1"></i></span>
                                        Duration:
                                    </div>
                                    <span>{{ $course->meetings }} hours</span>
                                </div>
                            </li>
                            <li>
                                <div class="course-details__info__text">
                                    <div class="course-details__info__text__title">
                                        <span class="course-details__info__icon"><i
                                                class="icon-graduation"></i></span>
                                        Lessons:
                                    </div>
                                    <span>{{ $course->syllabus->count() }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="course-details__info__text">
                                    <div class="course-details__info__text__title">
                                        <span class="course-details__info__icon"><i
                                                class="icon-multiple-users"></i></span>
                                        Favourite Class:
                                    </div>
                                    <span>{{ $course->is_favourite ? 'Yes' : 'No' }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="course-details__info__text">
                                    <div class="course-details__info__text__title">
                                        <span class="course-details__info__icon"><i class="icon-medal"></i></span>
                                        Certifications:
                                    </div>
                                    <span>Yes</span>
                                </div>
                            </li>
                            <li>
                                <div class="course-details__info__text">
                                    <div class="course-details__info__text__title">
                                        <span class="course-details__info__icon"><i class="icon-globe"></i></span>
                                        Language:
                                    </div>
                                    <span>Indonesian</span>
                                </div>
                            </li>
                        </ul>
                        <div class="course-details__info__price">This course Fee
                            Rp{{ number_format($course->price, 0, ',', '.') }}</div>
                        @if (!$hasAccess)
                            @auth
                                <!-- Tambahkan ke keranjang (baik kursus gratis maupun berbayar) -->
                                <form action="{{ route('app.cart.add', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="course-details__info__btn eduhive-btn">
                                        <span class="eduhive-btn__text">Join This Course</span>
                                        <span class="eduhive-btn__icon">
                                            <span class="eduhive-btn__icon__inner"><i class="icon-arrow-right"></i></span>
                                        </span>
                                    </button>
                                </form>
                            @else
                                <!-- Tampilkan tombol login -->
                                <a href="{{ route('login') }}" class="course-details__info__btn eduhive-btn">
                                    <span class="eduhive-btn__text">Login untuk Bergabung</span>
                                    <span class="eduhive-btn__icon">
                                        <span class="eduhive-btn__icon__inner"><i class="icon-arrow-right"></i></span>
                                    </span>
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script-app')
        <script>
            function markAsComplete(syllabusId, type) {
                fetch(`/syllabus/${syllabusId}/complete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        type: type
                    })
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    }
                });
            }
        </script>
        <script>
            function setRating(rating) {
                document.getElementById('rating').value = rating;

                for (let i = 1; i <= 5; i++) {
                    const star = document.getElementById(`star-${i}`);
                    if (i <= rating) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                }
                console.log("Rating selected:", rating);
            }
        </script>
    @endpush
</x-layouts.app>
