<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SMK Widya Nusantara</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <?= $this->renderSection('styles') ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?= $this->include('layouts/components/sidebar') ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?= $this->include('layouts/components/topbar') ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <?= $this->renderSection('content') ?>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Codelapan <?= Date('Y') ?> </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $labels = [];
    $aktifitas = [];
    foreach ($subjects as $row) {
        $kategori = $row['tahun_lulus'];

        // Tambahkan jumlah data pada kategori yang sesuai
        if (isset($labels[$kategori])) {
            $labels[$kategori]++;
        } else {
            $labels[$kategori] = 1;
        }
    }

    foreach ($subjects as $row) {
        $kategori = $row['kesibukan'];

        // Tambahkan jumlah data pada kategori yang sesuai
        if (isset($aktifitas[$kategori])) {
            $aktifitas[$kategori]++;
        } else {
            $aktifitas[$kategori] = 1;
        }
    }
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script>

    <script>
        var data = <?= json_encode(array_values($aktifitas)) ?>;
        var labels = <?= json_encode(array_keys($aktifitas)) ?>;
        var backgroundColors = ['#1ABC9C', '#3498DB', '#9B59B6', '#E74C3C', '#F39C12', '#2ECC71',
            '#95A5A6', '#E67E22', '#16A085', '#8E44AD'
        ];

        // Filter data dan labels untuk menghapus data kosong
        var filteredData = [];
        var filteredLabels = [];
        var filteredBackgroundColors = [];

        for (var i = 0; i < data.length; i++) {
            if (labels[i] !== '') {
                filteredData.push(data[i]);
                filteredLabels.push(labels[i]);
                filteredBackgroundColors.push(backgroundColors[i]);
            }
        }
        // Chart Pir Data Example
        var ctx = document.getElementById("myPieChart").getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: filteredLabels,
                datasets: [{
                    label: 'Data',
                    data: filteredData,
                    backgroundColor: filteredBackgroundColors,
                }],
            },
            options: {
                responsive: true,
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[0].data[tooltipItem.index];
                            return label + ': ' + value + ' Orang';
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
                cutoutPercentage: 50,
            }
        });
    </script>


    <script>
        var ctx = document.getElementById('myBarChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($labels)) ?>,
                datasets: [{
                    label: 'Data',
                    data: <?= json_encode(array_values($labels)) ?>,
                    backgroundColor: ['#1ABC9C', '#3498DB', '#9B59B6', '#E74C3C', '#F39C12', '#2ECC71',
                        '#95A5A6', '#E67E22', '#16A085', '#8E44AD'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            display: false
                        }
                    }
                },
                tooltips: {
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return label + ': ' + value;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                }
            }
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>