<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="card-header">
    <h2>Dashboard</h2>
  </div>
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Jumlah Alumni</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $studentCount; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Bekerja</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $bekerja; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-briefcase fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Wirausaha</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $wirausaha; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-store fa-2x text-gray-300"></i>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                Kuliah</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $kuliah; ?> </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-school fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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