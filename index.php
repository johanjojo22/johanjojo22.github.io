<?php

session_start();

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

include 'layout/header.php';

$data_ruas = select("SELECT * FROM ruas_jalan ORDER BY id DESC");

?>
    <div class="datas mx-3">
        <h1 class="pt-4">Laporan</h1>
        <hr>

        <div class="row">
            <div class="col-6">
                <?php if ($_SESSION['level'] == 1) : ?>
                    <a href="tambah.php" class="btn btn-primary mb-3">Tambah</a>
                <?php endif; ?>
            </div>
        </div>

        <div style="overflow-x: scroll; background: white;">
        <table class="table table-bordered table-striped" id="table">
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
                    <?php if ($_SESSION['level'] == 1) : ?>
                        <th>Action</th>
                    <?php endif; ?>
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

                                // Mendapatkan elemen canvas untuk menggambar diagram
                                var ctx<?= $data['id']; ?> = document.getElementById('myChart<?= $data['id']; ?>').getContext('2d');

                                // Membuat objek chart baru
                                var myChart<?= $data['id']; ?> = new Chart(ctx<?= $data['id']; ?>, {
                                    type: 'bar',
                                    data: chartData<?= $data['id']; ?>,
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                max: 200,
                                                ticks: {
                                                    stepSize: 50
                                                }
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    </td>
                    <td><button class="btn d-flex flex-wrap gap-1" data-bs-toggle="modal" data-bs-target="#imageModal<?= $data['id']; ?>">
                        <?php
                            $gambarArray = explode(",", $data['gambar']);
                            foreach ($gambarArray as $image) {
                            echo '<img src="assets/images/' . $image . '" alt="Image" width="20px;">';
                        }
                        ?>
                    </button>

                    </td>
                    <?php if ($_SESSION['level'] == 1) : ?>
                        <td>
                            <a href="edit.php?id=<?=$data['id']; ?>" class="btn btn-success m-1"><i class='bx bxs-edit-alt' ></i></a>
                            <a href="delete.php?id=<?=$data['id']; ?>" class="btn btn-danger m-1" onclick="return confirm('Ingin menghapus data?');"><i class='bx bxs-trash'></i></a>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

<?php foreach ($data_ruas as $data) : ?>
    <div class="modal fade" id="imageModal<?= $data['id']; ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" style="width: 100vw;">
        <div class="modal-dialog" style="width: 100vw;">
            <div class="modal-content m-image"
            style="width: 90vw;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, 0%);
            ">
                <div class="modal-header text-dark">
                    <h5 class="modal-title" id="modalLabel"><?= $data['nama_ruas']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-wrap gap-3 justify-content-center place-items-center">
                    <?php
                        $gambarArray = explode(",", $data['gambar']);
                        foreach ($gambarArray as $image) {
                        echo '<img src="assets/images/' . $image . '" alt="Image" width="30%;">';
                    }
                    ?>
                </div>
                <div class="modal-footer d-flex justify-content-absolute top-50 start-50 translate-middle">
                    <a href="<?= $data['link']; ?>" target="_blank">Titik Koordinat</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php

include 'layout/footer.php';

?>

<script>
    function filterData() {
    var inputYear = document.getElementById("year").value;
    var table = document.getElementById("table");
    var tbody = table.getElementsByTagName("tbody")[0];
    var rows = tbody.getElementsByTagName("tr");
  
    for (var i = 0; i < rows.length; i++) {
      var year = rows[i].getElementsByTagName("td")[12];
      if (year.innerHTML !== inputYear) {
        rows[i].style.display = "none";
      } else {
        rows[i].style.display = "";
      }
    }
  }
</script>