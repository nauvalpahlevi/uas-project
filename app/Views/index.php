<!DOCTYPE html>
<html>
<head>
    <title>Study Tracker</title>
</head>
<body>
    <h1>Study Tracker</h1>
    <a href="/study/add">Add Subject</a>
    <table>
        <thead>
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
                <th>Kesibukan</th>
                <th>Instansi</th>
                <th>Riwayat Pendidikan</th>
                <th>Program Studi</th>
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
                <td><?= $subject['kesibukan']; ?></td>
                <td><?= $subject['instansi']; ?></td>
                <td><?= $subject['riwayat_pendidikan']; ?></td>
                <td><?= $subject['prodi']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>