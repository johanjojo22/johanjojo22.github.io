<?php

function select($query) {
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// create data
function create_data($post)
{
    global $db;

    $no_ruas = strip_tags($post['no_ruas']);
    $nama_ruas = strip_tags($post['nama_ruas']);
    $kecamatan = strip_tags($post['kecamatan']);
    $desa = strip_tags($post['desa']);
    $panjang_ruas = strip_tags($post['panjang_ruas']);
    $status = strip_tags($post['status']);
    $baik = strip_tags($post['baik']);
    $sedang = strip_tags($post['sedang']);
    $rusak_ringan = strip_tags($post['rusak_ringan']);
    $rusak_berat = strip_tags($post['rusak_berat']);
    $kondisi = "";
    $tahun = strip_tags($post['tahun']);
    $gambar = upload_files();
    $link = strip_tags($post['link']);

    if (!$gambar) {
        return false;
    }

    $baik_percentage = ($baik + $sedang);

    if ($baik_percentage > 100) {
        $kondisi = "Mantap";
    } else {
        $kondisi = "Tidak Mantap";
    }

    $query = "INSERT INTO ruas_jalan VALUES (null, '$no_ruas', '$nama_ruas', '$kecamatan', '$desa', '$panjang_ruas', '$status', '$baik', '$sedang', '$rusak_ringan', '$rusak_berat', '$kondisi', '$tahun', '$gambar', '$link', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// edit data
function edit_data($post)
{
    global $db;

    $id = $post['id'];
    $no_ruas = strip_tags($post['no_ruas']);
    $nama_ruas = strip_tags($post['nama_ruas']);
    $kecamatan = strip_tags($post['kecamatan']);
    $desa = strip_tags($post['desa']);
    $panjang_ruas = strip_tags($post['panjang_ruas']);
    $status = strip_tags($post['status']);
    $baik = strip_tags($post['baik']);
    $sedang = strip_tags($post['sedang']);
    $rusak_ringan = strip_tags($post['rusak_ringan']);
    $rusak_berat = strip_tags($post['rusak_berat']);
    $kondisi = "";
    $tahun = strip_tags($post['tahun']);
    $link = strip_tags($post['link']);


    $baik_percentage = ($baik + $sedang);

    if ($baik_percentage > 100) {
        $kondisi = "Mantap";
    } else {
        $kondisi = "Tidak Mantap";
    }
    
    // Check if a new image was uploaded
    if ($_FILES['gambar']['name'] != '') {
        $gambar = upload_files();
        
        // Update the image field in the database
        $query = "UPDATE ruas_jalan SET no_ruas = '$no_ruas', nama_ruas = '$nama_ruas', kecamatan = '$kecamatan', desa = '$desa', panjang_ruas = '$panjang_ruas', status = '$status', baik = '$baik', sedang = '$sedang', rusak_ringan = '$rusak_ringan', rusak_berat = '$rusak_berat', kondisi = '$kondisi', tahun = '$tahun', gambar = '$gambar', link = '$link' WHERE id = $id";
    } else {
        // No new image uploaded, update other fields without changing the image
        $query = "UPDATE ruas_jalan SET no_ruas = '$no_ruas', nama_ruas = '$nama_ruas', kecamatan = '$kecamatan', desa = '$desa', panjang_ruas = '$panjang_ruas', status = '$status', baik = '$baik', sedang = '$sedang', rusak_ringan = '$rusak_ringan', rusak_berat = '$rusak_berat', kondisi = '$kondisi', tahun = '$tahun', link = '$link' WHERE id = $id";
    }

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// upload files
function upload_files()
{
    $gambarArray = array();
    $totalFiles = count($_FILES['gambar']['name']);

    for ($i = 0; $i < $totalFiles; $i++) {
        $namaFile = $_FILES['gambar']['name'][$i];
        $ukuranFile = $_FILES['gambar']['size'][$i];
        $error = $_FILES['gambar']['error'][$i];
        $tmpName = $_FILES['gambar']['tmp_name'][$i];

        $extensifileValid = ['jpg', 'jpeg', 'png'];
        $extensifile = explode('.', $namaFile);
        $extensifile = strtolower(end($extensifile));

        if (!in_array($extensifile, $extensifileValid)) {
            echo "<script>
                alert('Gagal mengubah/membuat data. Format gambar tidak valid');
                document.location.href = 'index.php';
            </script>";
            die();
        }

        if ($ukuranFile >100048000) {
            echo "<script>
                alert('gagal mengubah/membuat data. ukuran gambar maksimal 3MB');
                document.location.href = 'index.php';
            </script>";
            die();
        }

        // generate nama file baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $extensifile;

        move_uploaded_file($tmpName, 'assets/images/' . $namaFileBaru);
        $gambarArray[] = $namaFileBaru;
    }

    return implode(",", $gambarArray);
}

// delete data
function delete_data($id)
{
    global $db;

    $query = "DELETE FROM ruas_jalan WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// tambah user
function create_user($post)
{
    global $db;

    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    // password encryption
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user VALUES (null, '$username', '$password', '$level', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// delete user
function delete_user($id)
{
    global $db;

    $query = "DELETE FROM user WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function cari ($keyword){
    $query ="SELECT * FROM ruas_jalan
            WHERE
            no_ruas LIKE '%$keyword' OR
            nama_ruas LIKE '%$keyword' OR
            kecamatan LIKE '%$keyword' OR
            desa LIKE '%$keyword' OR
            panjang_ruas LIKE '%$keyword' OR 
            status LIKE '%$keyword' OR 
            baik LIKE '%$keyword' OR 
            sedang LIKE '%$keyword' OR
            rusak-ringan LIKE '%$keyword' OR 
            rusak-berat LIKE '%$keyword' OR 
            kondisi LIKE '%$keyword' OR 
            tahun LIKE '%$keyword' OR 
            gambar LIKE '%$keyword' OR
            link LIKE '%$keyword' OR ";

    return query($query);
            
}
function create_laporan($post)
{
    global $db;

    $nama_kegiatan = strip_tags($post['nama_kegiatan']);
    $lokasi_lap = strip_tags($post['lokasi_lap']);
    $sumber_dana = strip_tags($post['sumber_dana']);
    $anggaran_kes = strip_tags($post['anggaran_kes']);
    $anggaran_fis = strip_tags($post['anggaran_fis']);
    $nilai_kontrak = strip_tags($post['nilai_kontrak']);
    $realisasi = strip_tags($post['realisasi']);
    $persenan = strip_tags($post['persenan']);
    $sisa_anggaran = strip_tags($post['sisa_anggaran']);
    $sisa_tender = strip_tags($post['sisa_tender']);
    $realisasi_fisik = strip_tags($post['realisasi_fisik']);
    $denda = strip_tags($post['denda']);
    $kontrak_pelaksana = strip_tags($post['kontrak_pelaksana']);
    $tanggal_kontrak = strip_tags($post['tanggal_kontrak']);
    $tgl_spmk = strip_tags($post['tgl_spmk']);
    $tgl_selesai = strip_tags($post['tgl_selesai']);
    $keterangan = strip_tags($post['keterangan']);
    $bulan_lap = strip_tags($post['bulan_lap']);
    $tahun_lap = strip_tags($post['tahun_lap']);

    // Create the query
    $query = "INSERT INTO laporan_kegiatan VALUES (null, '$nama_kegiatan', '$lokasi_lap', '$sumber_dana', '$anggaran_kes', '$anggaran_fis', '$nilai_kontrak', '$realisasi', '$persenan', '$sisa_anggaran', '$sisa_tender', '$realisasi_fisik', '$denda', '$kontrak_pelaksana', '$tanggal_kontrak', '$tgl_spmk', '$tgl_selesai', '$keterangan', '$bulan_lap', '$tahun_lap')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// edit laporan
function edit_laporan($post)
{
    global $db;

    $id_laporan = $post['id_laporan'];
    $nama_kegiatan = strip_tags($post['nama_kegiatan']);
    $lokasi_lap = strip_tags($post['lokasi_lap']);
    $sumber_dana = strip_tags($post['sumber_dana']);
    $anggaran_kes = strip_tags($post['anggaran_kes']);
    $anggaran_fis = strip_tags($post['anggaran_fis']);
    $nilai_kontrak = strip_tags($post['nilai_kontrak']);
    $realisasi = strip_tags($post['realisasi']);
    $persenan = strip_tags($post['persenan']);
    $sisa_anggaran = strip_tags($post['sisa_anggaran']);
    $sisa_tender = strip_tags($post['sisa_tender']);
    $realisasi_fisik = strip_tags($post['realisasi_fisik']);
    $denda = strip_tags($post['denda']);
    $kontrak_pelaksana = strip_tags($post['kontrak_pelaksana']);
    $tanggal_kontrak = strip_tags($post['tanggal_kontrak']);
    $tgl_spmk = strip_tags($post['tgl_spmk']);
    $tgl_selesai = strip_tags($post['tgl_selesai']);
    $keterangan = strip_tags($post['keterangan']);
    $bulan_lap = strip_tags($post['bulan_lap']);
    $tahun_lap = strip_tags($post['tahun_lap']);

    // Create the query
    $query = "UPDATE laporan_kegiatan SET 
            nama_kegiatan = '$nama_kegiatan',
            lokasi_lap = '$lokasi_lap',
            sumber_dana = '$sumber_dana',
            anggaran_kes = '$anggaran_kes',
            anggaran_fis = '$anggaran_fis',
            nilai_kontrak = '$nilai_kontrak',
            realisasi = '$realisasi',
            persenan = '$persenan',
            sisa_anggaran = '$sisa_anggaran',
            sisa_tender = '$sisa_tender',
            realisasi_fisik = '$realisasi_fisik',
            denda = '$denda',
            kontrak_pelaksana = '$kontrak_pelaksana',
            tanggal_kontrak = '$tanggal_kontrak',
            tgl_spmk = '$tgl_spmk',
            tgl_selesai = '$tgl_selesai',
            keterangan = '$keterangan',
            bulan_lap = '$bulan_lap',
            tahun_lap = '$tahun_lap'
          WHERE id_laporan = $id_laporan";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete_laporan($id_laporan)
{
    global $db;

    $query = "DELETE FROM laporan_kegiatan WHERE id_laporan = $id_laporan";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
