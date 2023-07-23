<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3>Data Alumni</h3>
        </div>
        <br>
        <div class="container-fluid">

            <?php if (session()->role === 'admin') : ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                    <i class="fas fa-plus mr-1"></i>
                    Add
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ImportModal">
                    <i class="fas fa-file-import mr-1"></i>
                    Import
                </button>
                <a href="/study/download-excel" class="btn btn-success">
                    <i class="fas fa-download mr-1"></i>
                    Download Excel
                </a>
                <a href="<?= base_url('export/pdf') ?>" class="btn btn-primary"> <i class="fas fa-download mr-1"></i> Download PDF</a>
                <?php if (!empty($pdfFileName)) : ?>
                    <a href="<?= base_url('export/download/' . $pdfFileName) ?>" class="btn btn-success">Download PDF</a>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (session()->role === 'user') : ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" hidden>
                    <i class="fas fa-plus mr-1"></i>
                    Add
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ImportModal" hidden>
                    <i class="fas fa-file-import mr-1"></i>
                    Import
                </button>
                <a href="/study/download-excel" class="btn btn-success" hidden>
                    <i class="fas fa-download mr-1"></i>
                    Download Excel
                </a>
                <a href="<?= base_url('export/pdf') ?>" class="btn btn-primary" hidden> <i class="fas fa-download mr-1"></i> Download PDF</a>
                <?php if (!empty($pdfFileName)) : ?>
                    <a href="<?= base_url('export/download/' . $pdfFileName) ?>" class="btn btn-success">Download PDF</a>
                <?php endif; ?>

            <?php endif; ?>


        </div>
        <br>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped text-center" id="dataTable">
                    <thead class="table-secondary">
                        <tr>
                            <th>NIS</th>
                            <th>Name</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th>Tahun Lulus</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subjects as $subject) : ?>
                            <tr>
                                <td><?= $subject['nis']; ?></td>
                                <td><?= $subject['name']; ?></td>
                                <td><?= $subject['tempat_lahir']; ?></td>
                                <td><?= $subject['tanggal_lahir']; ?></td>
                                <td><?= $subject['alamat']; ?></td>
                                <td><?= $subject['telpon']; ?></td>
                                <td><?= $subject['email']; ?></td>
                                <td><?= $subject['jurusan']; ?></td>
                                <td><?= $subject['tahun_lulus']; ?></td>
                                <td>
                                    <div class="flex-column">
                                        <?php if (session()->role === 'admin') : ?>
                                            <a class="text-primary" data-toggle="modal" data-target="#editModal<?= $subject['nis']; ?>">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a class="text-danger" href="<?= base_url('study/delete/' . $subject['nis']) ?>" onclick="return confirm('Apa anda yakin untuk menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (session()->role === 'user') : ?>
                                            <a class="text-primary" data-toggle="modal" data-target="#editModal<?= $subject['nis']; ?>" hidden>
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a class="text-danger" href="<?= base_url('study/delete/' . $subject['nis']) ?>" onclick="return confirm('Apa anda yakin untuk menghapus data ini?')" hidden>
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>


                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= $subject['nis'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('study/edit/' . $subject['nis']) ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" name="name" class="form-control" id="name" value="<?= $subject['name']; ?>" placeholder="Nama" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= $subject['tempat_lahir']; ?>" placeholder="Tempat Lahir" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input type="text" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?= $subject['tanggal_lahir']; ?>" placeholder="Tanggal Lahir" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $subject['alamat']; ?>" placeholder="Alamat">
                                                </div>
                                                <div class="form-group">
                                                    <label for="telpon">Telpon</label>
                                                    <input type="text" name="telpon" class="form-control" id="telpon" value="<?= $subject['telpon']; ?>" placeholder="Telpon">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" value="<?= $subject['email']; ?>" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jurusan">Jurusan</label>
                                                    <input type="text" name="jurusan" class="form-control" id="jurusan" value="<?= $subject['jurusan']; ?>" placeholder="Jurusan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tahun_lulus">Tahun Lulus</label>
                                                    <input type="text" name="tahun_lulus" class="form-control" id="tahun_lulus" value="<?= $subject['tahun_lulus']; ?>" placeholder="Tahun lulus" required>
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
                    </tbody>
                </table>
            </div>


            <!-- Import Modal -->
            <div class="modal fade" id="ImportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= csrf_field(); ?>
                        <form method="post" action="/study/import-excel" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="excel_file" class="form-label">Excel File:</label>
                                    <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xlsx" required>
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

            <!-- Add Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/study/save" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="nis">NIS<span class="text-danger">*</span></label>
                                    <input type="text" name="nis" class="form-control" id="nis" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                    <input type="text" name="alamat" class="form-control" id="alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="telpon">Telpon</label>
                                    <input type="text" name="telpon" class="form-control" id="telpon">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="jurusan">Jurusan<span class="text-danger">*</span></label>
                                    <input type="text" name="jurusan" class="form-control" id="jurusan" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_lulus">Tahun Lulus<span class="text-danger">*</span></label>
                                    <input type="text" name="tahun_lulus" class="form-control" id="tahun_lulus" required>
                                </div>
                                <div class="form-group">
                                    <label>Kesibukan:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_kesibukan" id="bekerja" value="Bekerja">
                                        <label class="form-check-label" for="bekerja">
                                            Bekerja
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_kesibukan" id="wirausaha" value="Wirausaha">
                                        <label class="form-check-label" for="wirausaha">
                                            Wirausaha
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_kesibukan" id="kuliah" value="Kuliah">
                                        <label class="form-check-label" for="kuliah">
                                            Kuliah
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_kesibukan" id="belum_bekerja" value="Belum Bekerja">
                                        <label class="form-check-label" for="belum_bekerja">
                                            Belum Bekerja
                                        </label>
                                    </div>
                                </div>
                                <div class="bg-dark rounded-top">
                                    <hr>
                                    <center>
                                        <h5 class="text-light">Pekerjaan</h5>
                                    </center>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <label for="instansi">Instansi</label>
                                    <input type="text" name="instansi" class="form-control" id="instansi">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_masuk">Tahun Masuk</label>
                                    <input type="text" name="tahun_masuk" class="form-control" id="tahun_masuk">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_keluar">Tahun Keluar</label>
                                    <input type="text" name="tahun_keluar" class="form-control" id="tahun_keluar">
                                </div>
                                <div class="bg-dark rounded-top">
                                    <hr>
                                    <center>
                                        <h5 class="text-light">Kuliah</h5>
                                    </center>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <label for="riwayat_pendidikan">Riwayat Pendidikan</label>
                                    <input type="text" name="riwayat_pendidikan" class="form-control" id="riwayat_pendidikan">
                                </div>
                                <div class="form-group">
                                    <label for="nama_kampus">Nama Kampus</label>
                                    <input type="text" name="nama_kampus" class="form-control" id="nama_kampus">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_masuk_kampus">Tahun Masuk Kuliah</label>
                                    <input type="text" name="tahun_masuk_kampus" class="form-control" id="tahun_masuk_kampus">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_lulus_kampus">Tahun Lulus Kuliah</label>
                                    <input type="text" name="tahun_lulus_kampus" class="form-control" id="tahun_lulus_kampus">
                                </div>
                                <div class="form-group">
                                    <label for="prodi">Program Studi</label>
                                    <input type="text" name="prodi" class="form-control" id="prodi">
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>
<?php $this->section('scripts') ?>
<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<!-- Page level custom scripts -->
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

<?php $this->endSection() ?>