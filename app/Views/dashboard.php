<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-8 col-lg-7">
      <!--Chart Jumlah Alumni-->
      <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Jumlah Alumni</h5>
      </div>
      <div class="card shadow mb-4">
        <canvas id="myPieChart" class="container p-1"></canvas>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
