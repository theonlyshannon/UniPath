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

        @can('dashboard-mentor-view')
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
                                <i class="fa fa-book icon-white"></i>
                            </div>
                            <div class="information">
                                <h5 class="text-muted mb-2">Jumlah Kelas</h5>
                                <h4 class="mb-0"> {{ \App\Models\Course::where('mentor_id', auth()->user()->mentor->id)->count() }}</h4>
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
                                <h5 class="text-muted mb-2">Review</h5>
                                {{-- <h4 class="mb-0">{{ \App\Models\Article::count() }}</h4> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div style="width: 100%; margin-top: 50px;">
                <h4>Jumlah Pendaftar Siswa</h4>
                <canvas id="studentRegistrationChart"></canvas>
            </div>
        @endcan

        @push('plugin-scripts')
            <script>
                const visitorCtx = document.getElementById('visitorChart')?.getContext('2d');
                if (visitorCtx) {
                    const visitorChart = new Chart(visitorCtx, {
                        type: 'line',
                        data: {
                            labels: @json($articleDate),
                            datasets: [{
                                label: 'Pengunjung',
                                data: @json($dataVisitor),
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
                }

                // Chart untuk Tag
                const tagCtx = document.getElementById('tagChart')?.getContext('2d');
                if (tagCtx) {
                    const tagChart = new Chart(tagCtx, {
                        type: 'pie',
                        data: {
                            labels: @json($tagLabels),
                            datasets: [{
                                data: @json($tagData),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)',
                                    'rgba(255, 159, 64, 0.6)'
                                ],
                                borderWidth: 0
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
                }

                const studentRegCtx = document.getElementById('studentRegistrationChart')?.getContext('2d');
                if (studentRegCtx) {
                    const studentRegChart = new Chart(studentRegCtx, {
                        type: 'line',
                        data: {
                            labels: @json($studentLabels),
                            datasets: [{
                                label: 'Registrasi Siswa',
                                data: @json($studentData),
                                borderColor: 'rgba(54, 162, 235, 1)',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
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
                                },
                                x: {
                                    type: 'time', // Mengatur tipe sumbu X sebagai waktu
                                    time: {
                                        unit: 'day'
                                    } // Unit waktu yang akan ditampilkan
                                }
                            }
                        }
                    });
                }
            </script>
        @endpush
    </x-layouts.admin>
