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

  <?= $this->endSection() ?>