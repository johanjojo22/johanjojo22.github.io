<?php

session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

include 'layout/header.php';

$id_laporan = (int)$_GET['id_laporan'];
$laporan = select("SELECT * FROM laporan_kegiatan WHERE id_laporan = $id_laporan")[0];

if (isset($_POST['edit_laporan'])) {
    if (edit_laporan($_POST) > 0) {
        echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'laporan.php';
        </script>";
    } else {
        echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'laporan.php';
        </script>";
    }
}

?>


<div class="mx-5 py-5">
    <h3>Edit laporan</h3>
    <hr>

    <form action="" method="POST">
    <input type="hidden" name="id_laporan" value="<?= $laporan['id_laporan']; ?>">
        <div class="row">
            <style>
                input, select {
                    box-shadow: none !important;
                }
            </style>
            <div class="mb-3 col-6">
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama kegiatan" required value="<?=$laporan ['nama_kegiatan']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="lokasi_lap">Lokasi Laporan</label>
                <input type="text" name="lokasi_lap" class="form-control" placeholder="Lokasi Laporan" value="<?=$laporan ['lokasi_lap']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="sumber_dana">Sumber Dana</label>
                <input type="text" name="sumber_dana" class="form-control" placeholder="Sumber Dana" value="<?=$laporan ['sumber_dana']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="anggaran_kes">Anggaran Keseluruhan</label>
                <input type="text" name="anggaran_kes" class="form-control" placeholder="Anggaran Keseluruhan" value="<?=$laporan ['anggaran_kes']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="anggaran_fis">Anggaran Fisik</label>
                <input type="text" name="anggaran_fis" class="form-control" placeholder="Anggaran Fisik" value="<?=$laporan ['anggaran_fis']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="nilai_kontrak">Nilai Kontrak</label>
                <input type="text" name="nilai_kontrak" class="form-control" placeholder="Nilai Kontrak" value="<?=$laporan ['nilai_kontrak']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="realisasi">Realisasi</label>
                <input type="text" name="realisasi" class="form-control" placeholder="Realisasi (Rp)" value="<?=$laporan ['realisasi']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="persenan">Persenan</label>
                <input type="text" name="persenan" class="form-control" placeholder="(%)" value="<?=$laporan ['persenan']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="sisa_anggaran">Sisa Anggaran</label>
                <input type="text" name="sisa_anggaran" class="form-control" placeholder="Sisa Anggaran (Rp)" value="<?=$laporan ['sisa_anggaran']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="sisa_tender">Sisa Tender</label>
                <input type="text" name="sisa_tender" class="form-control" placeholder="Sisa Tender (Rp)" value="<?=$laporan ['sisa_tender']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="realisasi_fisik">Realisasi Fisik (%)</label>
                <input type="text" name="realisasi_fisik" class="form-control" placeholder="Realisasi Fisik" value="<?=$laporan ['realisasi_fisik']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="denda">Denda Keterlambatan</label>
                <input type="text" name="denda" class="form-control" placeholder="Denda Keterlambatan" value="<?=$laporan ['denda']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="kontrak_pelaksana">Kontrak Pelaksana</label>
                <input type="text" name="kontrak_pelaksana" class="form-control" placeholder="Nama Perusahaan dan Pelakasana" value="<?=$laporan ['kontrak_pelaksana']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="tanggal_kontrak">Tanggal Kontrak</label>
                <input type="text" name="tanggal_kontrak" class="form-control" placeholder="Tanggal Kontrak" value="<?=$laporan ['tanggal_kontrak']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="tgl_spmk">Tanggal SPMK</label>
                <input type="text" name="tgl_spmk" class="form-control" placeholder="Tanggal SPMK" value="<?=$laporan ['tgl_spmk']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="tgl_selesai">Tanggal Selesai Kontrak</label>
                <input type="text" name="tgl_selesai" class="form-control" placeholder="Tanggal Selesai Kontrak" value="<?=$laporan ['tgl_selesai']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="<?=$laporan ['keterangan']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="bulan_lap">Bulan Laporan</label>
                <select name="bulan_lap" class="form-control">
                    <option value="Januari" <?php if ($laporan ['bulan_lap'] == "Januari") echo "selected"; ?>>Januari</option>
                    <option value="Februari" <?php if ($laporan ['bulan_lap'] == "Februari") echo "selected"; ?>>Februari</option>
                    <option value="Maret" <?php if ($laporan ['bulan_lap'] == "Maret") echo "selected"; ?>>Maret</option>
                    <option value="April" <?php if ($laporan ['bulan_lap'] == "April") echo "selected"; ?>>April</option>
                    <option value="Mei" <?php if ($laporan ['bulan_lap'] == "Mei") echo "selected"; ?>>Mei</option>
                    <option value="Juni" <?php if ($laporan ['bulan_lap'] == "Juni") echo "selected"; ?>>Juni</option>
                    <option value="Juli" <?php if ($laporan ['bulan_lap'] == "Juli") echo "selected"; ?>>Juli</option>
                    <option value="Agustus" <?php if ($laporan ['bulan_lap'] == "Agustus") echo "selected"; ?>>Agustus</option>
                    <option value="September" <?php if ($laporan ['bulan_lap'] == "September") echo "selected"; ?>>September</option>
                    <option value="Oktober" <?php if ($laporan ['bulan_lap'] == "Oktober") echo "selected"; ?>>Oktober</option>
                    <option value="November" <?php if ($laporan ['bulan_lap'] == "November") echo "selected"; ?>>November</option>
                    <option value="Desember" <?php if ($laporan ['bulan_lap'] == "Desember") echo "selected"; ?>>Desember</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="tahun_lap">Tahun</label>
                <select class="form-select" name="tahun_lap" id="tahun_lap"></select>
            </div>        </div>
        <div class="text-end">
            <button type="submit" name="edit_laporan" class="btn btn-primary me-1">Update</button>
            <button type="reset" class="btn btn-danger float-end mb-4">Reset</button>
        </div>
    </form>
</div>


<?php

include 'layout/footer.php';

?>
<script>
    var selectElement = document.getElementById("tahun_lap");
    var currentYear = new Date().getFullYear();
    var startYear = 2010;

    for (var i = currentYear; i >= startYear; i--) {
        var option = document.createElement("option");
        option.text = i;
        selectElement.add(option);
    }

    // Update options every year
    setInterval(function () {
        var currentYear = new Date().getFullYear();

        if (currentYear > startYear) {
            for (var i = currentYear; i > startYear; i--) {
                var option = document.createElement("option");
                option.text = i;
                selectElement.add(option, selectElement.options[1]);
            }

            startYear = currentYear;
        }
    }, 1000 * 60 * 60 * 24); // Check every day for a new year
</script>