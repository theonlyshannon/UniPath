<x-layouts.app title="Unipath">
    <section class="main-slider-three" id="home">
        <div class="main-slider-three__carousel eduhive-owl__carousel eduhive-owl__carousel--basic-nav owl-carousel owl-theme"
            data-owl-options='{
            "items": 1,
            "margin": 0,
            "animateIn": "fadeIn",
            "animateOut": "fadeOut",
            "loop": true,
            "smartSpeed": 1000,
            "nav": false,
            "dots": false,
            "autoplay": true,
            "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"]
                }'>
            <div class="main-slider-three__item">
                <div class="main-slider-three__bg"
                    style="background-image: url(assets/images/shapes/main-slider-bg-2-1.png);"></div>
                <div class="container">
                    <div class="row gutter-y-60 align-items-center">
                        <div class="col-lg-12">
                            <div class="main-slider-three__content">
                                <div class="main-slider-three__video">
                                    <a href="https://www.youtube.com/watch?v=h9MbznbxlLc"
                                        class="main-slider-three__video__btn video-btn video-popup">
                                        <i class="icon-play"></i>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a>
                                </div>
                                <h2 class="main-slider-three__title">
                                    <span class="main-slider-three__title__inner">
                                        <span
                                            class="main-slider-three__title__text main-slider-three__title__text--1">Temani Perjalanan
                                            <span class="main-slider-three__title__highlight">perkuliahan mu</span>
                                           </span>
                                    </span>
                                    <span class="main-slider-three__title__inner">
                                        <span
                                            class="main-slider-three__title__text main-slider-three__title__text--2">bersama Unipath</span>
                                    </span>
                                </h2>
                                <div class="main-slider-three__bottom">
                                    <div class="main-slider-three__bottom__inner">
                                        <a href="courses.html" class="main-slider-three__btn eduhive-btn">
                                            <span class="eduhive-btn__text">Temukan Kelasmu</span>
                                            <span class="eduhive-btn__icon">
                                                <span class="eduhive-btn__icon__inner"><i
                                                        class="icon-right-arrow"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="main-slider-three__bottom__inner">
                                        <div class="main-slider-three__student">
                                            <div class="main-slider-three__student__image">
                                                <span class="count-text" data-stop="2"
                                                    data-speed="1500">2</span><span>k+</span>
                                            </div>
                                            <p class="main-slider-three__student__text">students</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-slider-three__content__circle-one main-slider-three__circle"></div>
                                <div class="main-slider-three__content__circle-two main-slider-three__circle"></div>
                            </div>
                            <div class="main-slider-three__images">
                                <div class="main-slider-three__image main-slider-three__image--top">
                                    <img src="{{ asset('app/images/study-1.jpg') }}" alt="main-slider"
                                        class="slider-image">
                                </div>
                                <div class="main-slider-three__image">
                                    <img src="{{ asset('app/images/study-2.jpg') }}" alt="main-slider"
                                        class="slider-image">
                                </div>
                                <div class="main-slider-three__image">
                                    <img src="{{ asset('app/images/study-3.jpg') }}" alt="main-slider"
                                        class="slider-image">
                                </div>
                                <div class="main-slider-three__image main-slider-three__image--top">
                                    <img src="{{ asset('app/images/study-4.jpg') }}" alt="main-slider"
                                        class="slider-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('app/images/shapes/main-slider-shape-3-2.png') }}" alt="shape"
                    class="main-slider-three__shape-one slider-image">
                <img src="{{ asset('app/images/shapes/main-slider-shape-3-2.png') }}" alt="shape"
                    class="main-slider-three__shape-two slider-image">
                <div class="main-slider-three__box-one"></div>
                <div class="main-slider-three__box-two"></div>
                <div class="main-slider-three__circle-one main-slider-three__circle"></div>
                <div class="main-slider-three__circle-two main-slider-three__circle"></div>
                <div class="main-slider-three__circle-three main-slider-three__circle"></div>
                <div class="main-slider-three__circle-four main-slider-three__circle"></div>
            </div>
        </div>
    </section>

    <section class="course-category course-category--home-3 section-space-bottom mb-5">
        <div class="container">
            <div class="row gutter-y-30">
                <h2 class="main-slider-three__title text-center mb-5">
                    Berikut Merupakan Beberapa Kategori Kelas Kami
                </h2>
                <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="00ms">
                    <div class="course-category__card course-category__card--1">
                        <div class="course-category__card__content">
                            <div class="course-category__card__icon-box course-category__card__icon-box--secondary">
                                <span class="course-category__card__icon">
                                    <i class="icon-briefcase"></i>
                                </span>
                            </div>
                            <h4 class="course-category__card__title">Sosial Dan Humaniora</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="300ms">
                    <div class="course-category__card course-category__card--4">
                        <div class="course-category__card__content">
                            <div class="course-category__card__icon-box course-category__card__icon-box--yellow2">
                                <span class="course-category__card__icon">
                                    <i class="icon-setting"></i>
                                </span>
                            </div>
                            <h4 class="course-category__card__title">Sains Dan Teknologi</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="00ms">
                    <div class="course-category__card course-category__card--5">
                        <div class="course-category__card__content">
                            <div class="course-category__card__icon-box course-category__card__icon-box--base">
                                <span class="course-category__card__icon">
                                    <i class="icon-healthcare"></i>
                                </span>
                            </div>
                            <h4 class="course-category__card__title">Kedokteran Umum</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms"
                    data-wow-delay="100ms">
                    <div class="course-category__card course-category__card--6">
                        <div class="course-category__card__content">
                            <div class="course-category__card__icon-box course-category__card__icon-box--primary">
                                <span class="course-category__card__icon">
                                    <i class="icon-coding-1"></i>
                                </span>
                            </div>
                            <h4 class="course-category__card__title">Akuntansi</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-one faq-one--home section-space">
        <div class="container">
            <div class="row gutter-y-50 align-items-center">
                <div class="col-lg-6">
                    <div class="funfact-one">
                        <div class="funfact-one__grid">
                            <div class="funfact-one__item funfact-one__item--secondary wow fadeInUp"
                                data-wow-duration="1500ms" data-wow-delay="00ms">
                                <div class="funfact-one__icon">
                                    <span class="funfact-one__icon__inner"><i class="icon-connectibity"></i></span>
                                </div>
                                <h3 class="funfact-one__title count-box">
                                    <span class="count-text" data-stop="30" data-speed="1500">0</span>
                                    <span>k+</span>
                                </h3>
                                <p class="funfact-one__text">Satisfied Student</p>
                            </div>
                            <div class="funfact-one__item funfact-one__item--primary wow fadeInUp"
                                data-wow-duration="1500ms" data-wow-delay="100ms">
                                <div class="funfact-one__icon">
                                    <span class="funfact-one__icon__inner"><i class="icon-batch-assign"></i></span>
                                </div>
                                <h3 class="funfact-one__title count-box">
                                    <span class="count-text" data-stop="6500" data-speed="1500">0</span>
                                    <span>+</span>
                                </h3>
                                <p class="funfact-one__text">Class Completed</p>
                            </div>
                            <div class="funfact-one__item funfact-one__item--primary wow fadeInUp"
                                data-wow-duration="1500ms" data-wow-delay="00ms">
                                <div class="funfact-one__icon">
                                    <span class="funfact-one__icon__inner"><i class="icon-students"></i></span>
                                </div>
                                <h3 class="funfact-one__title count-box">
                                    <span class="count-text" data-stop="6561" data-speed="1500">0</span>
                                    <span>+</span>
                                </h3>
                                <p class="funfact-one__text">Active Students</p>
                            </div>
                            <div class="funfact-one__item funfact-one__item--secondary wow fadeInUp"
                                data-wow-duration="1500ms" data-wow-delay="100ms">
                                <div class="funfact-one__icon">
                                    <span class="funfact-one__icon__inner"><i class="icon-instructors"></i></span>
                                </div>
                                <h3 class="funfact-one__title count-box">
                                    <span class="count-text" data-stop="400" data-speed="1500">0</span>
                                    <span>+</span>
                                </h3>
                                <p class="funfact-one__text">Experts Instructors</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faq-one__content">
                        <div class="sec-title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                            <h6 class="sec-title__tagline">faq’s</h6>
                            <h3 class="sec-title__title">Kami Selalu Memastikan <span
                                    class="sec-title__title__text">Kelas <br> Terbaik</span> Untuk <span>Pembelajaran
                                    Anda</span></h3>
                        </div>
                        <div class="faq-one__accordion">
                            <div class="eduhive-accordion" data-grp-name="eduhive-accordion">
                                <div class="accordion wow fadeInUp" data-wow-duration="1500ms">
                                    <div class="accordion-title">
                                        <h4>Berapa lama seharusnya sebuah persiapan untuk kuliah?</h4>
                                        <span class="accordion-title__icon">
                                            <i class="icon-double-arrow"></i>
                                        </span>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="inner">
                                            <p>Persiapan kuliah idealnya dimulai 6 bulan sebelumnya, mencakup pemilihan
                                                jurusan, pendaftaran, dan persiapan akademik serta mental.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion active wow fadeInUp" data-wow-duration="1500ms">
                                    <div class="accordion-title">
                                        <h4>Apa yang bisa dilakukan di web Unipath ini?</h4>
                                        <span class="accordion-title__icon">
                                            <i class="icon-double-arrow"></i>
                                        </span>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="inner">
                                            <p>Di sini ada banyak fitur yaitu ada kelas sesuai peminatan dan AI yang
                                                siap membantu kamu</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion wow fadeInUp" data-wow-duration="1500ms">
                                    <div class="accordion-title">
                                        <h4>Apakah Website ini juga bisa memaparkan persiapan beasiswa?</h4>
                                        <span class="accordion-title__icon">
                                            <i class="icon-double-arrow"></i>
                                        </span>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="inner">
                                            <p>Tentu saja bisa website ini menyajikan banyak informasi mengenai beasiswa
                                                sampai dengan cara agar lolos beasiswa</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq-one__image-inner">
        </div>
        <img src="{{ asset('app/images/shapes/faq-shape-1-5.png') }}" alt="shape" class="faq-one__shape-three">
    </section>

    <section class="offer-one section-space-top">
        <div class="container">
            <div class="row gutter-y-60">
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1500ms">
                    <div class="offer-one__image">
                        <img src="{{ asset('app/images/offer-1-1.webp') }}" alt="offer image"
                            class="offer-one__image__one">
                        <img src="{{ asset('app/images/offer-1-2.webp') }}" alt="offer image"
                            class="offer-one__image__two">
                        <img src="{{ asset('app/images/shapes/offer-shape-1-1.png') }}" alt="offer shape"
                            class="offer-one__image__shape">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="offer-one__content">
                        <div class="sec-title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                            <h6 class="sec-title__tagline">Keunggulan Unipath</h6>
                            <h3 class="sec-title__title"><span class="">Kita Memberikan</span> Pengalaman
                                Belajar <span class="sec-title__title__text">Sesuai Dengan Minat Kuliah Anda</span>
                            </h3>
                        </div>
                        <div class="offer-one__inner">
                            <div class="offer-one__item wow fadeInUp" data-wow-duration="1500ms">
                                <div class="offer-one__item__icon offer-one__item__icon--primary">
                                    <i class="icon-instructors"></i>
                                </div>
                                <div class="offer-one__item__content">
                                    <h4 class="offer-one__item__title">Expert Instructor</h4>
                                    <p class="offer-one__item__text">Di unipath semua instructor telah teruji dan
                                        pastinya ahli di bidang masing masing</p>
                                </div>
                            </div>
                            <div class="offer-one__item wow fadeInUp" data-wow-duration="1500ms">
                                <div class="offer-one__item__icon offer-one__item__icon--secondary">
                                    <i class="icon-copy-writing"></i>
                                </div>
                                <div class="offer-one__item__content">
                                    <h4 class="offer-one__item__title">Up-to-Date Course Content</h4>
                                    <p class="offer-one__item__text">Semua course up-to-date dengan materi terbaru</p>
                                </div>
                            </div>
                            <div class="offer-one__item wow fadeInUp" data-wow-duration="1500ms">
                                <div class="offer-one__item__icon offer-one__item__icon--base">
                                    <i class="icon-community"></i>
                                </div>
                                <div class="offer-one__item__content">
                                    <h4 class="offer-one__item__title">Biggest Student Community</h4>
                                    <p class="offer-one__item__text">Dilengkapi komunitas untuk membahas terkait
                                        pembelajaran yang sudah di berikan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('app/images/shapes/offer-shape-1-3.png') }}" alt="shape" class="offer-one__shape">
        <div class="offer-one__shape-box"></div>
    </section>


    @push('script-app')
        <script>
            $(document).ready(function() {
                $('#header-sticky').addClass('header-sticky');
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    items: 1,
                    margin: 0,
                    loop: false,
                    nav: false,
                    dots: false,
                    smartSpeed: 1000,
                });
            });
        </script>
    @endpush
</x-layouts.app>
