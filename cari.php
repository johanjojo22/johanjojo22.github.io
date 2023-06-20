<?php
session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');
}

include 'layout/header.php';

$tahun_query = select("SELECT DISTINCT tahun FROM ruas_jalan ORDER BY tahun");
$tahun_array = [];
foreach ($tahun_query as $tahun) {
    $tahun_array[] = $tahun['tahun'];
}

if (isset($_GET['year'])) {
    $tahun_terpilih = $_GET['year'];
    $data_ruas = select("SELECT * FROM ruas_jalan WHERE tahun = '$tahun_terpilih' ORDER BY id DESC");
} else {
    $data_ruas = select("SELECT * FROM ruas_jalan WHERE tahun = '$tahun_array[0]' ORDER BY id DESC");
}
?>

<div class="datas mx-3">
    <div style="overflow-x: scroll; background: white;">
        <form method="GET" action="">
            <label for="year">Pilih berdasarkan tahun</label>
            <select name="year" id="year" onchange="this.form.submit()">
                <?php foreach ($tahun_array as $tahun) : ?>
                    <option value="<?= $tahun ?>" <?= isset($tahun_terpilih) && $tahun_terpilih == $tahun ? 'selected' : '' ?>><?= $tahun ?></option>
                <?php endforeach; ?>
            </select>
        </form>

        <div class="row">
            <div>
                <input type="button" class="btn btn-outline-success mb-3" value="Export ke Excel" onclick="exportToExcel()">
            </div>
        </div>

        <table class="table table-bordered table-striped my-5" id="table">
            <thead>
                <tr class="text-center">
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
                    <th>Diagram</th>
                    <th>Gambar</th>
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
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chartModal<?= $data['id']; ?>">Diagram</button>
                            <!-- Modal -->
                            <div class="modal fade" id="chartModal<?= $data['id']; ?>" tabindex="-1" aria-labelledby="chartModalLabel<?= $data['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="chartModalLabel<?= $data['id']; ?>"><?= $data['nama_ruas'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <canvas id="myChart<?= $data['id']; ?>"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Data untuk diagram batang
                                    var chartData<?= $data['id']; ?> = {
                                        labels: ['Baik', 'Sedang', 'Rusak Ringan', 'Rusak Berat'],
                                        datasets: [{
                                            label: 'Persentase',
                                            data: [
                                                <?= $data['baik']; ?>,
                                                <?= $data['sedang']; ?>,
                                                <?= $data['rusak_ringan']; ?>,
                                                <?= $data['rusak_berat']; ?>
                                            ],
                                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    };

                                    // Opsi diagram batang
                                    var chartOptions<?= $data['id']; ?> = {
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                max: 100
                                            }
                                        }
                                    };

                                    // Membuat diagram batang
                                    var ctx<?= $data['id']; ?> = document.getElementById('myChart<?= $data['id']; ?>').getContext('2d');
                                    var myChart<?= $data['id']; ?> = new Chart(ctx<?= $data['id']; ?>, {
                                        type: 'bar',
                                        data: chartData<?= $data['id']; ?>,
                                        options: chartOptions<?= $data['id']; ?>
                                    });
                                });
                            </script>
                        </td>
                        <td>
                            <img src="assets/images/<?= $data['gambar']; ?>" alt="<?= $data['nama_ruas']; ?>" style="max-width: 100px; max-height: 100px;">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function exportToExcel() {
        let year = document.getElementById("year").value;
        window.location.href = "export-excel.php?year=" + year;
    }

    function filterData() {
        var yearFilter = document.getElementById("year-filter").value;
        window.location.href = "?year=" + yearFilter;
    }
</script>

<?php include 'layout/footer.php'; ?>