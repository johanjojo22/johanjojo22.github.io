<?php

session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (create_data($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal ditambahkan');
            document.location.href = 'index.php';
        </script>";
    }
}

?>


    <div class="mx-5 py-4">
        <h3>Buat laporan</h3>
        <hr>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="no_ruas" class="form-label">Nomor Ruas</label>
                    <input type="number" class="form-control" name="no_ruas" id="no_ruas" placeholder="Nomor ruas" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="status" class="form-label">Status:</label>
                    <select  class="form-control" name="status" id="status" value="<?= $data['status']; ?>" placeholder="Status jalan" required></div>
                        <option value="">Pilih Status Jalan</option>
                        <option value="JALAN KABUPATEN">JALAN KABUPATEN</option>
                        <option value="JALAN KOTA">JALAN KOTA</option>
                    </select>
                </div>
               
                <div class="mb-3 col-6">
                    <label for="nama_ruas" class="form-label">Nama Ruas</label>
                    <input type="text" class="form-control" name="nama_ruas" id="nama_ruas" placeholder="Nama ruas" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="panjang_ruas" class="form-label">Panjang Ruas (KM)</label>
                    <input type="number" class="form-control" name="panjang_ruas" id="panjang_ruas" placeholder="Panjang ruas" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="baik" class="form-label">Baik (%)</label>
                    <input type="number" class="form-control" name="baik" id="baik" placeholder="Persentase kondisi Baik" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="desa" class="form-label">Desa yang dilalui</label>
                    <input type="text" class="form-control" name="desa" id="desa" placeholder="Desa yang dilalui" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="sedang" class="form-label">Sedang (%)</label>
                    <input type="number" class="form-control" name="sedang" id="sedang" placeholder="Persentase kondisi Sedang" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="tahun" class="form-label">Tahun:</label>
                    <select  class="form-control" name="tahun" id="tahun"></select>
                </div>
                <div class="mb-3 col-6">
                    <label for="rusak_berat" class="form-label">Rusak berat (%)</label>
                    <input type="number" class="form-control" name="rusak_berat" id="rusak_berat" placeholder="Persentase kondisi Rusak berat" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="gambar[]" class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar[]" id="gambar[]" multiple>
                </div>
                <div class="mb-3 col-6">
                    <label for="rusak_ringan" class="form-label">Rusak ringan (%)</label>
                    <input type="number" class="form-control" name="rusak_ringan" id="rusak_ringan" placeholder="Persentase kondisi Rusak ringan" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="link" class="form-label">Titik Koordinat</label>
                    <input type="text" class="form-control" name="link" id="link" placeholder="Link Koordinat" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="kondisi" class="form-label">Kondisi</label>
                    <input type="text" class="form-control" name="kondisi" id="kondisi" placeholder="Auto filled" disabled>
                </div>
                
            </div>

            <div class="text-end">
                <button type="submit" name="tambah" class="btn btn-primary me-1">Simpan</button>
                <button onclick="goBack()" class="btn btn-danger">Kembali</button>

                <?php
                if(isset($_SERVER['HTTP_REFERER'])){
                $previous_page = $_SERVER['HTTP_REFERER'];
                } else {
                $previous_page = 'index.php'; // Halaman default jika tidak ada referer sebelumnya
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
    </div>
</div>

<?php

include 'layout/footer.php';

?>
<script>
    var selectElement = document.getElementById("tahun");
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