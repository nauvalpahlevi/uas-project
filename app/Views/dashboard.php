<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="card-header">
    <h2>Dashboard</h2>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">Jumlah Alumni</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myBarChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-5">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">Aktifitas Alumni</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myPieChart"></canvas>
            </div>
          </div>
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
    $kategori = $row['status_kesibukan'];
    // $kategori = 'test';


    // Tambahkan jumlah data pada kategori yang sesuai
    if (isset($aktifitas[$kategori])) {
      $aktifitas[$kategori]++;
    } else {
      $aktifitas[$kategori] = 1;
    }
  }
  ?>
  <?= $this->endSection() ?>
  <?php $this->section('scripts') ?>

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
              var total = data.datasets[0].data.reduce((a, b) => a + b, 0);
              var percentage = ((value / total) * 100).toFixed(2) + '%';
              return label + ': ' + percentage;
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
          backgroundColor: [
            'rgba(26, 188, 156, 0.7)',
            'rgba(52, 152, 219, 0.7)',
            'rgba(155, 89, 182, 0.7)',
            'rgba(231, 76, 60, 0.7)',
            'rgba(243, 156, 18, 0.7)',
            'rgba(46, 204, 113, 0.7)',
            'rgba(149, 165, 166, 0.7)',
            'rgba(230, 126, 34, 0.7)',
            'rgba(22, 160, 133, 0.7)',
            'rgba(142, 68, 173, 0.7)'
          ],
          borderColor: [
            'rgba(26, 188, 156, 0.7)',
            'rgba(52, 152, 219, 0.7)',
            'rgba(155, 89, 182, 0.7)',
            'rgba(231, 76, 60, 0.7)',
            'rgba(243, 156, 18, 0.7)',
            'rgba(46, 204, 113, 0.7)',
            'rgba(149, 165, 166, 0.7)',
            'rgba(230, 126, 34, 0.7)',
            'rgba(22, 160, 133, 0.7)',
            'rgba(142, 68, 173, 0.7)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          tooltip: {
            enabled: true,
            mode: 'index',
            intersect: false,
            callbacks: {
              label: function(context) {
                var label = 'Tahun ' + context.label;
                var value = context.raw;
                return label + ': ' + value + ' Orang';
              }
            }
          }
        },
        scales: {
          x: {
            grid: {
              display: false
            },
            ticks: {
              display: false
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              display: false
            }
          }
        },
        legend: {
          display: false
        },
        cornerRadius: 10, // Mengatur radius sudut batang
        indexAxis: 'y', // Mengatur orientasi sumbu
        barPercentage: 0.6, // Mengatur lebar batang relatif terhadap lebar sumbu
        categoryPercentage: 0.8 // Mengatur lebar grup batang relatif terhadap lebar sumbu
      }
    });
  </script>
  <?php $this->endSection() ?>