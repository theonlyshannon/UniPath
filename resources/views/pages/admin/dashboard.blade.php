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
                                <h5 class="text-muted mb-2">Jumlah Student</h5>
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

            <div class="page-content">
                <h4>Grafik Artikel Per Tanggal</h4>
                <canvas id="articleChart" width="400" height="200"></canvas>
            </div>
        @endcan

        @push('custom-scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('articleChart').getContext('2d');

                    const articleChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($labels),
                            datasets: [{
                                label: 'Jumlah Artikel',
                                data: @json($data),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        font: {
                                            size: 16
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return `Jumlah: ${tooltipItem.raw}`;
                                        }
                                    }
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
                            animation: {
                                duration: 1000,
                                easing: 'easeOutElastic'
                            }
                        }
                    });
                });
            </script>
        @endpush

    </x-layouts.admin>
