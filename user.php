<?php

session_start();

include 'layout/header.php';

// login section
if (!isset($_SESSION["login"])) {
    header('location:login.php');   
}

// membatasi hak ases user
if ($_SESSION["level"] != 1) {
    echo "<script>
        alert('Anda tidak memiliki akses halaman ini');
        document.location.href = 'index.php';
    </script>";

    exit;
}

$data_user = select("SELECT * FROM user");

if (isset($_POST['add'])) {
    if (create_user($_POST) > 0) {
        echo "<script>
            alert('User berhasil ditambahkan');
            document.location.href = 'user.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan user');
            document.location.href = 'user.php';
        </script>";
    }
}

if (isset($_POST['edit'])) {
    if (edit_user($_POST) > 0) {
        echo "<script>
            alert('User berhasil diedit');
            document.location.href = 'user.php';
        </script>";
    } else {
        echo "<script>
            alert('User gagal diedit');
            document.location.href = 'user.php';
        </script>";
    }
}


?>


    <div class="datas mx-5">
        <h1 class="pt-4">Account</h1>
        <hr>

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button>
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <?php $no = 1; ?>
                <?php foreach ($data_user as $user) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td class="text-muted"><em>Password Encrypted</em></td>
                    <td>
                        <?php if ($user['level'] == 1) {
                            echo "Admin";
                        } else {
                            echo "User";
                        }?>
                    </td>
                    <td><?= $user['added_at']; ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $user['id']; ?>"><i class='bx bxs-trash' ></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal add-->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalLabel">Tambah user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                        </div>

                        <div class="mb-3">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="">Pilih Level</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <?php foreach ($data_user as $user) : ?>
        <div class="modal fade" id="deleteModal<?= $user['id']; ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalLabel">hapus user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ingin menghapus user <b><?= $user['username']?></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
</div>

<?php

include 'layout/footer.php';

?>
