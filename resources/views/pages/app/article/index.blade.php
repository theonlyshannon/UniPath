<x-layouts.app title="Artikel">

    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a
                            href="index.html">Home</a></li>
                    <li><span>Our Blog</span></li>
                </ul>
                <h2 class="page-header__title">List Article</h2>
            </div>
        </div>
        <img src="{{asset('app/images/shapes/page-header-shape-1.png')}}" alt="shape" class="page-header__shape-one">
        <img src="{{asset('app/images/shapes/page-header-shape-2.png')}}" alt="shape" class="page-header__shape-two">
        <div class="page-header__shape-three"></div>
        <div class="page-header__shape-four"></div>
    </section>

    <section class="blog-page blog-page--sidebar section-space">
        <div class="container">
            <div class="row gutter-y-60">
                <div class="col-lg-8">
                    <div class="row gutter-y-30">
                        <div class="col-12">

                            @foreach ($articles as $article)
                                <x-ui.article-card :article="$article" />
                            @endforeach

                            <ul class="post-pagination">
                                <li>
                                    <a href="#"><span class="post-pagination__icon"><i
                                                class="icon-left-arrow"></i></span></a>
                                </li>
                                <li>
                                    <a href="#">01</a>
                                </li>
                                <li class="active">
                                    <a href="#"><span class="post-pagination__icon"><i
                                                class="icon-right-arrow"></i></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <aside class="widget-area">
                            <div class="sidebar__categories-wrapper sidebar__single">
                                <h4 class="sidebar__title">Categories</h4>
                                <ul class="sidebar__categories list-unstyled">

                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('app.article.index', ['category' => $category->slug]) }}">
                                                {{ $category->name }}
                                                <span></span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="sidebar__tags-wrapper sidebar__single">
                                <h4 class="sidebar__title">Tags</h4>
                                <div class="sidebar__tags">

                                    @foreach ($tags as $tag)
                                        <a href="{{ route('app.article.index', ['tag' => $tag->slug]) }}">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
