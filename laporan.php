<?php

session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

include 'layout/header.php';

$data_laporan = select("SELECT * FROM laporan_kegiatan ORDER BY id_laporan DESC");

?>

<?php
    // Mendefinisikan data bulan
    $bulan = array(
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    // Mengecek apakah form telah dikirim
    if (isset($_POST['filter_bulan'])) {
        $bulan_laporan = $_POST['bulan'];
        $tahun_laporan = $_POST['tahun'];

        $filtered_data = array_filter($data_laporan, function($laporan) use ($bulan_laporan, $tahun_laporan) {
            return $laporan['bulan_lap'] == $bulan_laporan && $laporan['tahun_lap'] == $tahun_laporan;;
        });
    } else {
        // Jika form tidak dikirim, tampilkan semua data
        $filtered_data = $data_laporan;
    }
?>

<div class="datas mx-3 pt-3 pb-5">
    <h1>Laporan Bulanan</h1>
    <hr>

    <div class="row">
        <div class="col-6">
            <?php if ($_SESSION['level'] == 1) : ?>
                <a href="add_laporan.php" class="btn btn-primary mb-3" style="box-shadow: none;">Tambah</a>
            <?php endif; ?>
            <button class="btn btn-outline-success mb-3" onClick="tableToExcel()">Export ke Excel</button>
        </div>

        <form method="post" action="" class="col-6">
            <div class="text-end d-flex justify-content-center align-items-center">
                <select name="bulan" class="form-select mx-1" id="bulan">
                    <?php foreach ($bulan as $bln) : ?>
                        <option value="<?= $bln; ?>" <?= isset($bulan_laporan) && $bulan_laporan == $bln ? 'selected' : ''; ?>>
                            <?= $bln; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="tahun" class="form-select mx-1" id="tahun">
                    <?php 
                        $current_year = date("Y");
                        for ($i = $current_year; $i >= 2010; $i--) {
                            $selected = isset($tahun_laporan) && $tahun_laporan == $i ? 'selected' : '';
                            echo "<option value=\"$i\" $selected>$i</option>";
                        }
                    ?>
                </select>
                <button type="submit" name="filter_bulan" class="btn btn-outline-success">Tampilkan</button>
            </div>
        </form>
    </div>

    <div style="overflow-x: scroll; background: white;">
        <style>
            input, button, select {
                box-shadow: none !important;
            }
        </style>
        <table class="table table-bordered table-striped" id="table">
            <?php if (isset($filtered_data) && !empty($filtered_data)) : ?>
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Sumber Dana</th>
                        <th>Pagu Anggaran Keseluruhan (Rp)</th>
                        <th>Pagu Anggaran Fisik (Rp)</th>
                        <th>Nilai Kontrak (Rp)</th>
                        <th>Realisasi (Rp)</th>
                        <th>(Rp)</th>
                        <th>Sisa Anggaran (Rp)</th>
                        <th>Sisa Tender (Rp)</th>
                        <th>Realisasi Fisik (%)</th>
                        <th>Denda Keterlambatan</th>
                        <th>Kontrak Pelaksana</th>
                        <th>Tanggal Kontrak</th>
                        <th>Tanggal SPMK</th>
                        <th>Tanggal Selesai Kontrak</th>
                        <th>Ket.</th>
                        <th>Bulan Laporan</th>
                        <th>Tahun</th>
                        <?php if ($_SESSION['level'] == 1) : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($filtered_data as $laporan) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $laporan['nama_kegiatan']; ?></td>
                        <td><?= $laporan['lokasi_lap']; ?></td>
                        <td><?= $laporan['sumber_dana']; ?></td>
                        <td><?= $laporan['anggaran_kes']; ?></td>
                        <td><?= $laporan['anggaran_fis']; ?></td>
                        <td><?= $laporan['nilai_kontrak']; ?></td>
                        <td><?= $laporan['realisasi']; ?></td>
                        <td><?= $laporan['persenan']; ?></td>
                        <td><?= $laporan['sisa_anggaran']; ?></td>
                        <td><?= $laporan['sisa_tender']; ?></td>
                        <td><?= $laporan['realisasi_fisik']; ?></td>
                        <td><?= $laporan['denda']; ?></td>
                        <td><?= $laporan['kontrak_pelaksana']; ?></td>
                        <td><?= $laporan['tanggal_kontrak']; ?></td>
                        <td><?= $laporan['tgl_spmk']; ?></td>
                        <td><?= $laporan['tgl_selesai']; ?></td>
                        <td><?= $laporan['keterangan']; ?></td>
                        <td><?= $laporan['bulan_lap']; ?></td>
                        <td><?= $laporan['tahun_lap']; ?></td>
                        <?php if ($_SESSION['level'] == 1) : ?>
                            <td>
                                <a href="edit_laporan.php?id_laporan=<?= $laporan['id_laporan']; ?>" class="btn btn-success m-1"><i class='bx bxs-edit-alt'></i></a>
                                <a href="delete_laporan.php?id_laporan=<?= $laporan['id_laporan']; ?>" class="btn btn-danger m-1" onclick="return confirm('Ingin menghapus data?');"><i class='bx bxs-trash'></i></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <?php else : ?>
                <thead>
                    <tr>
                        <th colspan="19" class="text-center">Tidak ada data yang tersedia</th>
                    </tr>
                </thead>
            <?php endif; ?>
        </table>
    </div>
</div>

<script src="script/table2excel.js"></script>

<script>
      function tableToExcel(){
        var table2excel = new Table2Excel();
        table2excel.export(document.querySelectorAll("table.table"));
    }
</script>

<?php

include 'layout/footer.php';

?>