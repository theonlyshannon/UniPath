<footer class="main-footer section-space-top">
    <div class="container">
        <div class="row gutter-y-40">
            <div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                <div class="footer-widget footer-widget--about">
                    <h2 class="footer-widget__title">About Us</h2>
                    <p class="footer-widget__about-text">Unipath adalah platform belajar bagi orang-orang yang berminat kuliah dan mencari beasiswa .</p>
                    <ul class="footer-widget__info">
                        <li>
                            <span class="footer-widget__info__icon"><i class="icon-location"></i></span>
                            <a href="https://maps.app.goo.gl/fwmPckXiLGxFPHcm9">Jl. DI Panjaitan No.128, Kabupaten Banyumas</a>
                        </li>
                        <li>
                            <span class="footer-widget__info__icon"><i class="icon-email"></i></span>
                            <a href="mailto:intechofficial@gmail.com">unipathofficial@gmail.com</a>
                        </li>
                        <li>
                            <span class="footer-widget__info__icon"><i class="icon-telephone"></i></span>
                            <a href="tel:+6120320024">081489735184</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                <div class="footer-widget footer-widget--links">
                    <h2 class="footer-widget__title">Quick Link</h2>
                    <ul class="list-unstyled footer-widget__links">
                        <li>
                            <a href="{{ route('app.about') }}">
                                <span class="footer-widget__links__icon">
                                    <i class="icon-double-arrow"></i>
                                </span>
                                About Unipath
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.course.index') }}">
                                <span class="footer-widget__links__icon">
                                    <i class="icon-double-arrow"></i>
                                </span>
                                Kelas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.article.index') }}">
                                <span class="footer-widget__links__icon">
                                    <i class="icon-double-arrow"></i>
                                </span>
                                Artikel
                            </a>
                        </li>
                        <li>
                            <a href="contact.html">
                                <span class="footer-widget__links__icon">
                                    <i class="icon-double-arrow"></i>
                                </span>
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                <div class="footer-widget footer-widget--links">
                    <h2 class="footer-widget__title">Courses</h2>
                    <ul class="list-unstyled footer-widget__links">
                        <li>
                            <a href="{{ route('app.course.index') }}">
                                <span class="footer-widget__links__icon">
                                    <i class="icon-double-arrow"></i>
                                </span>
                                SAINTEK
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.course.index') }}">
                                <span class="footer-widget__links__icon">
                                    <i class="icon-double-arrow"></i>
                                </span>
                                Matematika
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.course.index') }}">
                                <span class="footer-widget__links__icon">
                                    <i class="icon-double-arrow"></i>
                                </span>
                                Biologi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.course.index') }}">
                                <span class="footer-widget__links__icon">
                                    <i class="icon-double-arrow"></i>
                                </span>
                                Fisika
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-footer__bottom">
        <div class="container">
            <div class="main-footer__bottom__inner">
                <p class="main-footer__copyright">
                    &copy; Copyright <span class="dynamic-year"></span> by Unipath.
                </p>
            </div>
        </div>
    </div>
    <img src="{{ asset('app/images/shapes/footer-shape-1.png') }}" alt="shape" class="main-footer__shape-one">
    <img src="{{ asset('app/images/shapes/footer-shape-2.png') }}" alt="shape" class="main-footer__shape-two">
    <img src="{{ asset('app/images/shapes/footer-shape-3.png') }}" alt="shape" class="main-footer__shape-three">
    <img src="{{ asset('app/images/shapes/footer-shape-4.png') }}" alt="shape" class="main-footer__shape-four">
    <img src="{{ asset('app/images/shapes/footer-shape-5.png') }}" alt="shape" class="main-footer__shape-five">
</footer>
