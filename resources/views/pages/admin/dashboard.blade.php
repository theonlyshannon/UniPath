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

            <div class="chart-container">
                <div class="chart-item-large">
                    <h4>Jumlah Pengunjung Artikel</h4>
                    <canvas id="visitorChart"></canvas>
                </div>

                <div class="chart-card">
                    <h4>Artikel Berdasarkan Tag</h4>
                    <canvas id="tagChart"></canvas>
                </div>
            </div>
        @endcan

        @push('plugin-scripts')
            <script>
                const visitorCtx = document.getElementById('visitorChart').getContext('2d');
                const visitorChart = new Chart(visitorCtx, {
                    type: 'line',
                    data: {
                        labels: @json($articleDate), // Data tanggal
                        datasets: [{
                            label: 'Pengunjung',
                            data: @json($dataVisitor), // Data pengunjung
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        animation: {
                            duration: 2000,
                            easing: 'easeInOutQuad'
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                const tagCtx = document.getElementById('tagChart').getContext('2d');
                const tagChart = new Chart(tagCtx, {
                    type: 'pie',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                            data: @json($data),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ],
                            borderWidth: 0 // Tidak ada outline
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                });
            </script>
        @endpush
    </x-layouts.admin>
