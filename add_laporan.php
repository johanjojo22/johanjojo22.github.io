<?php

session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

include 'layout/header.php';

if (isset($_POST['add_laporan'])) {
    if (create_laporan($_POST) > 0) {
        echo "<script>
            alert('data laporan berhasil ditambahkan');
            document.location.href = 'laporan.php';
        </script>";
    } else {
        echo "<script>
            alert('data laporan gagal ditambahkan');
            document.location.href = 'laporan.php';
        </script>";
    }
}

?>

<div class="mx-5 py-5">
    <h3>Buat laporan</h3>
    <hr>

    <form action="" method="POST">
        <div class="row">
            <style>
                input, select{
                    box-shadow: none !important;
                }
            </style>
            <div class="mb-3 col-6">
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama kegiatan" required>
            </div>
            <div class="mb-3 col-6">
                <label for="lokasi_lap">Lokasi Laporan</label>
                <input type="text" name="lokasi_lap" class="form-control" placeholder="Lokasi Laporan">
            </div>
            <div class="mb-3 col-6">
                <label for="sumber_dana">Sumber Dana</label>
                <input type="text" name="sumber_dana" class="form-control" placeholder="Sumber Dana">
            </div>
            <div class="mb-3 col-6">
                <label for="anggaran_kes">Anggaran Keseluruhan</label>
                <input type="text" name="anggaran_kes" class="form-control" placeholder="Anggaran Keseluruhan">
            </div>
            <div class="mb-3 col-6">
                <label for="anggaran_fis">Anggaran Fisik</label>
                <input type="text" name="anggaran_fis" class="form-control" placeholder="Anggaran Fisik">
            </div>
            <div class="mb-3 col-6">
                <label for="nilai_kontrak">Nilai Kontrak</label>
                <input type="text" name="nilai_kontrak" class="form-control" placeholder="Nilai Kontrak">
            </div>
            <div class="mb-3 col-6">
                <label for="realisasi">Realisasi</label>
                <input type="text" name="realisasi" class="form-control" placeholder="Realisasi (Rp)">
            </div>
            <div class="mb-3 col-6">
                <label for="persenan">Persenan</label>
                <input type="text" name="persenan" class="form-control" placeholder="(%)">
            </div>
            <div class="mb-3 col-6">
                <label for="sisa_anggaran">Sisa Anggaran</label>
                <input type="text" name="sisa_anggaran" class="form-control" placeholder="Sisa Anggaran (Rp)">
            </div>
            <div class="mb-3 col-6">
                <label for="sisa_tender">Sisa Tender</label>
                <input type="text" name="sisa_tender" class="form-control" placeholder="Sisa Tender (Rp)">
            </div>
            <div class="mb-3 col-6">
                <label for="realisasi_fisik">Realisasi Fisik (%)</label>
                <input type="text" name="realisasi_fisik" class="form-control" placeholder="Realisasi Fisik">
            </div>
            <div class="mb-3 col-6">
                <label for="denda">Denda Keterlambatan</label>
                <input type="text" name="denda" class="form-control" placeholder="Denda Keterlambatan">
            </div>
            <div class="mb-3 col-6">
                <label for="kontrak_pelaksana">Kontrak Pelaksana</label>
                <input type="text" name="kontrak_pelaksana" class="form-control" placeholder="Nama Perusahaan dan Pelakasana">
            </div>
            <div class="mb-3 col-6">
                <label for="tanggal_kontrak">Tanggal Kontrak</label>
                <input type="text" name="tanggal_kontrak" class="form-control" placeholder="Tanggal Kontrak">
            </div>
            <div class="mb-3 col-6">
                <label for="tgl_spmk">Tanggal SPMK</label>
                <input type="text" name="tgl_spmk" class="form-control" placeholder="Tanggal SPMK">
            </div>
            <div class="mb-3 col-6">
                <label for="tgl_selesai">Tanggal Selesai Kontrak</label>
                <input type="text" name="tgl_selesai" class="form-control" placeholder="Tanggal Selasai Kotrak">
            </div>
            <div class="mb-3 col-6">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
            </div>
            <div class="mb-3 col-6">
                <label for="bulan_lap">Bulan Laporan</label>
                <select name="bulan_lap" class="form-control">
                    <option>Pilih bulan</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="tahun_lap">Tahun</label>
                <select class="form-select" name="tahun_lap" id="tahun_lap"></select>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" name="add_laporan" class="btn btn-primary me-1">Simpan</button>
            <button onclick="goBack()" class="btn btn-danger">Kembali</button>
            <?php
                if(isset($_SERVER['HTTP_REFERER'])){
                $previous_page = $_SERVER['HTTP_REFERER'];
                } else {
                $previous_page = 'laporan.php'; // Halaman default jika tidak ada referer sebelumnya
                }
                ?>

                <script>
                function goBack() {
                window.location.href = "<?php echo $previous_page; ?>";
                }
                </script>
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