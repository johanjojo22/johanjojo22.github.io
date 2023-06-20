<?php
include 'config/app.php';

if (isset($_GET['year'])) {
    $tahun_terpilih = $_GET['year'];
    $data_ruas = select("SELECT * FROM ruas_jalan WHERE tahun = '$tahun_terpilih' ORDER BY id DESC");
} else {
    $data_ruas = select("SELECT * FROM ruas_jalan ORDER BY id DESC");
}

header("Content-type: application/vnd/ms-excel");
header("Content-Disposition: attachment; filename=ruas-jalan.xls");
?>

<table border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nomor Ruas</th>
            <th>Nama Ruas</th>
            <th>Kecamatan</th>
            <th>Desa yang dilalui</th>
            <th>Panjang Ruas (KM)</th>
            <th>Status</th>
            <th>Baik</th>
            <th>Sedang</th>
            <th>Rusak ringan</th>
            <th>Rusak berat</th>
            <th>Kondisi</th>
            <th>Tahun</th>
            <th>Link Koordinat</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($data_ruas as $data) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['no_ruas']; ?></td>
                <td><?= $data['nama_ruas']; ?></td>
                <td><?= $data['kecamatan']; ?></td>
                <td><?= $data['desa']; ?></td>
                <td><?= $data['panjang_ruas']; ?></td>
                <td><?= $data['status']; ?></td>
                <td><?= $data['baik']; ?></td>
                <td><?= $data['sedang']; ?></td>
                <td><?= $data['rusak_ringan']; ?></td>
                <td><?= $data['rusak_berat']; ?></td>
                <td><?= $data['kondisi']; ?> (<?= $data['baik'] + $data['sedang'] ?>)</td>
                <td><?= $data['tahun']; ?></td>
                <td><?= $data['link']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
