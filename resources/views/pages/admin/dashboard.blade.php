    <x-layouts.admin title="Dashboard">
        <x-ui.breadcumb-admin>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </x-ui.breadcumb-admin>

        @can('dashboard-admin-view')
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt-3 mt-xl-0">
                    <div class="card card-statistics">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class="fa fa-users icon-white"></i>
                            </div>
                            <div class="information">
                                <h5 class="text-muted mb-2">Jumlah Siswa</h5>
                                <h4 class="mb-0">{{ \App\Models\Student::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt-3 mt-xl-0">
                    <div class="card card-statistics">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class="fa-regular fa-user icon-white"></i>
                            </div>
                            <div class="information">
                                <h5 class="text-muted mb-2">Jumlah Mentor</h5>
                                <h4 class="mb-0">{{ \App\Models\Mentor::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt-3 mt-xl-0">
                    <div class="card card-statistics">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class="fa fa-book icon-white"></i>
                            </div>
                            <div class="information">
                                <h5 class="text-muted mb-2">Jumlah Kelas</h5>
                                <h4 class="mb-0">{{ \App\Models\Course::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt-3 mt-xl-0">
                    <div class="card card-statistics">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class="fa-regular fa-newspaper icon-white"></i>
                            </div>
                            <div class="information">
                                <h5 class="text-muted mb-2">Jumlah Artikel</h5>
                                <h4 class="mb-0">{{ \App\Models\Article::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('dashboard-writer-view')
            <div class="row">

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt-3 mt-xl-0">
                    <div class="card card-statistics">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class="fa-regular fa-comment icon-white"></i>
                            </div>
                            <div class="information">
                                <h5 class="text-muted mb-2">Jumlah Komentar</h5>
                                <h4 class="mb-0">0</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt-3 mt-xl-0">
                    <div class="card card-statistics">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class=" fa-regular fa-user icon-white"></i>
                            </div>
                            <div class="information">
                                <h5 class="text-muted mb-2">Jumlah Pengunjung</h5>
                                <h4 class="mb-0">{{ \App\Models\ArticleVisitor::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt-3 mt-xl-0">
                    <div class="card card-statistics">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-container me-3">
                                <i class="fa-regular fa-newspaper icon-white"></i>
                            </div>
                            <div class="information">
                                <h5 class="text-muted mb-2">Jumlah Artikel</h5>
                                <h4 class="mb-0">{{ \App\Models\Article::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div style="width: 100%; margin: auto; padding-top: 50px;">
                <h4>Jumlah Pengunjung Artikel</h4>
                <canvas id="visitorChart"></canvas>
            </div>
        @endcan

        @push('plugin-scripts')
            <script>
                const ctx = document.getElementById('visitorChart').getContext('2d');

                const visitorChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                            label: 'Jumlah Pengunjung',
                            data: @json($data),
                            fill: false,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        animation: {
                            duration: 2000,
                            easing: 'easeInOutQuad',
                            delay: (context) => context.dataIndex * 300,
                            onComplete: function() {
                                console.log('Animasi selesai!');
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return `Pengunjung: ${tooltipItem.raw}`;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        @endpush
    </x-layouts.admin>
