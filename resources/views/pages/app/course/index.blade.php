<x-layouts.app title="Kelas">
    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a
                            href="index.html">Home</a></li>
                    <li><span>Our Course</span></li>
                </ul>
                <h2 class="page-header__title">Unipath Course</h2>
            </div>
        </div>
        <img src="{{ asset('app/images/shapes/page-header-shape-1.png') }}" alt="shape" class="page-header__shape-one">
        <img src="{{ asset('app/images/shapes/page-header-shape-2.png') }}" alt="shape" class="page-header__shape-two">
        <div class="page-header__shape-three"></div>
        <div class="page-header__shape-four"></div>
    </section>

    <section class="courses-three section-space2" id="courses">
        <div class="container">
            <div class="sec-title sec-title--center">
                <h6 class="sec-title__tagline">our courses</h6>
            </div>
            <div class="row gutter-y-30">
                @foreach ($courses as $course)
                    <x-ui.course-card :course="$course" />
                @endforeach
            </div>
        </div>
        <img src="{{ asset('app/images/shapes/courses-shape-3-1.png') }}" alt="shape" class="courses-three__shape-one">
        <img src="{{ asset('app/images/shapes/courses-shape-3-2.png') }}" alt="shape" class="courses-three__shape-two">
        <div class="courses-three__box-one"></div>
        <div class="courses-three__box-two"></div>
    </section>

</x-layouts.app>
