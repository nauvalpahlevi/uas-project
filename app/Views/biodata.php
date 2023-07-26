<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<style>
    /* Berikan warna berbeda pada tab aktif */
    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background-color: #007bff;
        /* Ganti dengan warna yang diinginkan */
        color: #fff;
        /* Ganti dengan warna teks yang diinginkan */
    }
</style>
<div class="container-fluid text-dark">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="h3 mb-4 text-gray-800">Informasi Akun</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col text-center">
                    <img class="img-profile rounded-circle" src="<?= base_url('assets/img/undraw_profile.svg') ?>" width="300" height="400">
                    <hr>
                    <h5><?= session()->name ?></h5>
                    <h5>Tahun Lulus <?= session()->tahun_lulus ?></h5>
                    <br>
                </div>
                <div class="container mt-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tabA-tab" data-toggle="tab" href="#tabA" role="tab" aria-controls="tabA" aria-selected="true">Data Pribadi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tabB-tab" data-toggle="tab" href="#tabB" role="tab" aria-controls="tabB" aria-selected="false">Data Pendidikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tabC-tab" data-toggle="tab" href="#tabC" role="tab" aria-controls="tabC" aria-selected="false">Data Pekerjaan</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabA" role="tabpanel" aria-labelledby="tabA-tab">
                            <h2>Data Pribadi</h2>
                            <div class="form-group">
                                <label>Tempat, Tanggal Lahir</label>
                                <p class="form-control-static"><?= session()->tempat_lahir ?>, <?= session()->tanggal_lahir ?></p>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <p class="form-control-static"><?= session()->alamat ?></p>
                            </div>
                            <div class="form-group">
                                <label>Telpon</label>
                                <p class="form-control-static"><?= session()->telpon ?></p>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <p class="form-control-static"><?= session()->email ?></p>
                            </div>
                            <div class="form-group">
                                <label>Jurusan</label>
                                <p class="form-control-static"><?= session()->jurusan ?></p>
                            </div>
                            <div class="form-group">
                                <label>Status Kesibukan</label>
                                <p class="form-control-static"><?= session()->status_kesibukan ?></p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabB" role="tabpanel" aria-labelledby="tabB-tab">
                            <h2 class="float-left">Data Pendidikan</h2>
                            <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addPendidikanModal">
                                <i class="fas fa-plus"></i> Add
                            </button>
                            <!-- Tampilkan data pendidikan dari database -->
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>Riwayat Pendidikan</th>
                                        <th>Nama Kampus</th>
                                        <th>Tahun Masuk</th>
                                        <th>Tahun Lulus</th>
                                        <th>Program Studi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="pendidikanTable">
                                    <?php foreach ($pendidikan as $row) : ?>
                                        <tr>
                                            <td><?= $row['riwayat_pendidikan']; ?></td>
                                            <td><?= $row['nama_kampus']; ?></td>
                                            <td><?= $row['tahun_masuk_kampus']; ?></td>
                                            <td><?= $row['tahun_lulus_kampus']; ?></td>
                                            <td><?= $row['prodi']; ?></td>
                                            <td>
                                                <a class="btn btn-primary " data-toggle="modal" data-target="#editModalPendidikan-<?= $row['id']; ?>">
                                                    <i class="fas fa-pen"> Edit</i>
                                                </a>
                                            </td>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModalPendidikan-<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Pendidikan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('pendidikan/editPendidikan/' . $row['id']) ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="riwayat_pendidikan">Riwayat Pendidikan</label>
                                                                    <input type="text" name="riwayat_pendidikan" class="form-control" id="riwayat_pendidikan" value="<?= $row['riwayat_pendidikan']; ?>" placeholder="Riwayat Pendidikan" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama_kampus">Nama Kampus</label>
                                                                    <input type="text" name="nama_kampus" class="form-control" id="nama_kampus" value="<?= $row['nama_kampus']; ?>" placeholder="Nama Kampus" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tahun_masuk_kampus">Tahun Masuk Kampus</label>
                                                                    <input type="text" name="tahun_masuk_kampus" class="form-control" id="tahun_masuk_kampus" value="<?= $row['tahun_masuk_kampus']; ?>" placeholder="Tahun Masuk Kampus" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tahun_lulus_kampus">Tahun Lulus Kampus</label>
                                                                    <input type="text" name="tahun_lulus_kampus" class="form-control" id="tahun_lulus_kampus" value="<?= $row['tahun_lulus_kampus']; ?>" placeholder="Tahun Lulus Kampus">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="prodi">Program Studi</label>
                                                                    <input type="text" name="prodi" class="form-control" id="prodi" value="<?= $row['prodi']; ?>" placeholder="Program Studi" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tabC" role="tabpanel" aria-labelledby="tabC-tab">
                            <h2 class="float-left">Data Pekerjaan</h2>
                            <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addPekerjaanModal">
                                <i class="fas fa-plus"></i> Add
                            </button>
                            <!-- Tampilkan data pekerjaan dari database -->
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>Instansi</th>
                                        <th>Tahun Masuk</th>
                                        <th>Tahun Keluar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="pekerjaanTable">
                                    <?php foreach ($pekerjaan as $row) : ?>
                                        <tr>
                                            <td><?= $row['instansi']; ?></td>
                                            <td><?= $row['tahun_masuk']; ?></td>
                                            <td><?= $row['tahun_keluar']; ?></td>
                                            <td>
                                                <a class="btn btn-primary " data-toggle="modal" data-target="#editModalPekerjaan-<?= $row['id']; ?>">
                                                    <i class="fas fa-pen"> Edit</i>
                                                </a>
                                            </td>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModalPekerjaan-<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Pekerjaan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('pekerjaan/editPekerjaan/' . $row['id']) ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="instansi">Instansi</label>
                                                                    <input type="text" name="instansi" class="form-control" id="instansi" value="<?= $row['instansi']; ?>" placeholder="Instansi" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tahun_masuk">Tahun Masuk</label>
                                                                    <input type="text" name="tahun_masuk" class="form-control" id="tahun_masuk" value="<?= $row['tahun_masuk']; ?>" placeholder="Tahun Masuk" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tahun_keluar">Tahun Keluar</label>
                                                                    <input type="text" name="tahun_keluar" class="form-control" id="tahun_keluar" value="<?= $row['tahun_keluar']; ?>" placeholder="Tahun Keluar">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menambahkan data pendidikan -->
<div class="modal fade" id="addPendidikanModal" tabindex="-1" role="dialog" aria-labelledby="addPendidikanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPendidikanModalLabel">Add Data Pendidikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pendidikan/addPendidikan" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Riwayat Pendidikan</label>
                        <input type="text" class="form-control" name="riwayat_pendidikan" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Kampus</label>
                        <input type="text" class="form-control" name="nama_kampus" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Masuk</label>
                        <input type="text" class="form-control" name="tahun_masuk_kampus" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Lulus</label>
                        <input type="text" class="form-control" name="tahun_lulus_kampus">
                    </div>
                    <div class="form-group">
                        <label>Program Studi</label>
                        <input type="text" class="form-control" name="prodi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk menambahkan data pekerjaan -->
<div class="modal fade" id="addPekerjaanModal" tabindex="-1" role="dialog" aria-labelledby="addPekerjaanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPekerjaanModalLabel">Add Data Pekerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pekerjaan/addPekerjaan" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Instansi</label>
                        <input type="text" class="form-control" name="instansi" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Masuk Kerja</label>
                        <input type="text" class="form-control" name="tahun_masuk" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Keluar Kerja</label>
                        <input type="text" class="form-control" name="tahun_keluar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?= $this->endSection() ?>
<?php $this->section('scripts') ?>
<script>
    function showTab(tabName) {
        // Ambil semua elemen dengan kelas "panel"
        const panels = document.querySelectorAll('.panel');

        // Sembunyikan semua panel
        panels.forEach(panel => {
            panel.classList.remove('is-show');
        });

        // Tampilkan panel yang sesuai dengan tab yang dipilih
        const targetPanel = document.querySelector(`.tab-${tabName}`);
        targetPanel.classList.add('is-show');
    }
</script>
<?php $this->endSection() ?>