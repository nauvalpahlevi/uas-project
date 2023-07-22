<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="card-header">
        <h5 class="h3 mb-4 text-gray-800">Biodata</h5>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <p>Nama: <?= session()->get('name'); ?></p>
                    <p>Tempat Lahir: <?= session()->get('tempat_lahir'); ?></p>
                    <p>Tanggal Lahir: <?= session()->get('tanggal_lahir'); ?></p>
                    <p>Alamat: <?= session()->get('alamat'); ?></p>
                    <p>Telpon: <?= session()->get('telpon'); ?></p>
                    <p>Email: <?= session()->get('email'); ?></p>
                    <p>Jurusan: <?= session()->get('jurusan'); ?></p>
                    <p>Tahun Lulus: <?= session()->get('tahun_lulus'); ?></p>
                    <hr>
                    <p>Data Pekerjaan</p>
                    <div class="form-group">
                        <label for="name">Nama Instansi</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Instansi</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Instansi</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>