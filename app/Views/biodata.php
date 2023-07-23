<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid text-dark">
    <div class="card-header">
        <h5 class="h3 mb-4 text-gray-800">Biodata</h5>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div>
                        <div class="bg-dark text-light">
                            <hr>
                            <center>
                                <h5>Informasi Pribadi</h5>
                            </center>
                            <hr>
                        </div>
                        <p>Nama: <?= session()->get('name'); ?></p>
                        <p>Tempat Lahir: <?= session()->get('tempat_lahir'); ?></p>
                        <p>Tanggal Lahir: <?= session()->get('tanggal_lahir'); ?></p>
                        <p>Alamat: <?= session()->get('alamat'); ?></p>
                        <p>Telpon: <?= session()->get('telpon'); ?></p>
                        <p>Email: <?= session()->get('email'); ?></p>
                        <p>Jurusan: <?= session()->get('jurusan'); ?></p>
                        <p>Tahun Lulus: <?= session()->get('tahun_lulus'); ?></p>

                    </div>
                    <div>
                        <div class="bg-dark text-light">
                            <hr>
                            <center>
                                <h5>Informasi Pekerjaan</h5>
                            </center>
                            <hr>
                        </div>
                        <a href="" class="float-right badge badge-success"><i class="fas fa-plus mr-1"></i>Add</a>
                        <p>Nama Instansi: <?= session()->get('instansi'); ?></p>
                        <p>Tahun Masuk Kerja: <?= session()->get('tahun_masuk'); ?></p>
                        <p>Tahun Keluar Kerja: <?= session()->get('tahun_keluar'); ?></p>
                    </div>
                    <div>
                        <div class="bg-dark text-light">
                            <hr>
                            <center>
                                <h5>Informasi Pendidikan</h5>
                            </center>
                            <hr>
                        </div>
                        <a href="" class="float-right badge badge-success"><i class="fas fa-plus mr-1"></i>Add</a>
                        <p>Nama Instansi: <?= session()->get('nama_kampus'); ?></p>
                        <p>Tahun Masuk Kerja: <?= session()->get('tahun_masuk_kampus'); ?></p>
                        <p>Tahun Keluar Kerja: <?= session()->get('tahun_keluar_kampu'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>