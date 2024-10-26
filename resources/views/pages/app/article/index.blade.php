<x-layouts.app title="Artikel">

    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a
                            href="index.html">Home</a></li>
                    <li><span>Our Blog</span></li>
                </ul><!-- /.eduhive-breadcrumb list-unstyled -->
                <h2 class="page-header__title">Blog List Right Sidebar</h2>
            </div><!-- /.page-header__content -->
        </div><!-- /.container -->
        <img src="assets/images/shapes/page-header-shape-1.png" alt="shape" class="page-header__shape-one">
        <img src="assets/images/shapes/page-header-shape-2.png" alt="shape" class="page-header__shape-two">
        <div class="page-header__shape-three"></div><!-- /.page-header__shape-three -->
        <div class="page-header__shape-four"></div><!-- /.page-header__shape-four -->
    </section><!-- /.page-header -->

    <section class="blog-page blog-page--sidebar section-space">
        <div class="container">
            <div class="row gutter-y-60">
                <div class="col-lg-8">
                    <div class="row gutter-y-30">
                        <div class="col-md-12">
                            <div class="blog-card blog-card--three wow fadeInUp" data-wow-duration='1500ms'
                                data-wow-delay='00ms'>
                                <div class="blog-card__image">
                                    <img src={{ asset('app/images/blog/blog-l-1-1.jpg') }}
                                        alt="There are many variations of passages of available">
                                    <a href="blog-details-right.html" class="blog-card__image__link"><span
                                            class="sr-only">There are many variations of passages of available</span>
                                        <!-- /.sr-only --></a>
                                    <div class="blog-card__date">
                                        <span class="blog-card__date__day">25</span>
                                        <span class="blog-card__date__month">june</span>
                                    </div><!-- /.blog-card__date -->
                                </div><!-- /.blog-card__image -->
                                <div class="blog-card__content">
                                    <ul class="list-unstyled blog-card__meta">
                                        <li>
                                            <a href="#">
                                                <span class="blog-card__meta__icon">
                                                    <i class="far fa-user"></i>
                                                </span>
                                                by Admin
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="blog-card__meta__icon">
                                                    <i class="icon-comments"></i>
                                                </span>
                                                2 Comments
                                            </a>
                                        </li>
                                    </ul><!-- /.list-unstyled blog-card__meta -->
                                    <h3 class="blog-card__title"><a href="blog-details-right.html">There are many
                                            variations of passages of available</a></h3><!-- /.blog-card__title -->
                                    <p class="blog-card__text">Neque Porro Est Qui Dolorem Ipsum Quia Quaed Inventor
                                        Veritatis Et Quasi Architecto Beatae Vitae Dicta Sunt Explicabo. Aelltes Port
                                        Lacus Quis Enim Var Sed Efficitur Turpis Gilla Sed Sit.</p>
                                    <!-- /.blog-card__text -->
                                    <a href="blog-details-right.html" class="blog-card__btn eduhive-btn">
                                        <span class="eduhive-btn__text">read more</span>
                                        <span class="eduhive-btn__icon">
                                            <span class="eduhive-btn__icon__inner"><i
                                                    class="icon-arrow-right-2"></i></span>
                                        </span>
                                    </a><!-- /.blog-card__btn -->
                                </div><!-- /.blog-card__content -->
                            </div><!-- /.blog-card -->
                        </div><!-- /.col-md-12 -->

                        <div class="col-12">
                            <ul class="post-pagination">
                                <li>
                                    <a href="#"><span class="post-pagination__icon"><i
                                                class="icon-left-arrow"></i></span></a>
                                </li>
                                <li>
                                    <a href="#">01</a>
                                </li>
                                <li>
                                    <a href="#">02</a>
                                </li>
                                <li>
                                    <a href="#">03</a>
                                </li>
                                <li class="active">
                                    <a href="#"><span class="post-pagination__icon"><i
                                                class="icon-right-arrow"></i></span></a>
                                </li>
                            </ul><!-- /.post-pagination -->
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </div><!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <aside class="widget-area">
                            <div class="sidebar__categories-wrapper sidebar__single">
                                <h4 class="sidebar__title">Categories</h4><!-- /.sidebar__title -->
                                <ul class="sidebar__categories list-unstyled">
                                    <li><a href="blog-details-right.html">Computer Science <span>(4)</span></a></li>
                                    <li><a href="blog-details-right.html">Development <span>(2)</span></a></li>
                                    <li><a href="blog-details-right.html">Arts & Design <span>(6)</span></a></li>
                                    <li><a href="blog-details-right.html">Sale Marketing <span>(9)</span></a></li>
                                    <li><a href="blog-details-right.html">Data Science <span>(10)</span></a></li>
                                </ul><!-- /.sidebar__categories list-unstyled -->
                            </div><!-- /.sidebar__categories-wrapper sidebar__single -->
                            <div class="sidebar__tags-wrapper sidebar__single">
                                <h4 class="sidebar__title">Tags</h4><!-- /.sidebar__title -->
                                <div class="sidebar__tags">
                                    <a href="blog-details-right.html">education</a>
                                    <a href="blog-details-right.html">accounting</a>
                                    <a href="blog-details-right.html">course</a>
                                    <a href="blog-details-right.html">coach</a>
                                    <a href="blog-details-right.html">motivation</a>
                                </div><!-- /.sidebar__tags -->
                            </div><!-- /.sidebar__tags-wrapper sidebar__single -->
                        </aside><!-- /.widget-area -->
                    </div><!-- /.sidebar -->
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-page blog-page--sidebar section-space -->
</x-layouts.app>
