<?php

session_start();

include 'config/app.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // check username
    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");

    // check password
    if (mysqli_num_rows($result) == 1) {

        $hasil = mysqli_fetch_assoc($result);
        if (password_verify($password, $hasil['password'])) {
            $_SESSION['login']      = true;
            $_SESSION['id']         = $hasil['id'];
            $_SESSION['username']   = $hasil['username'];
            $_SESSION['level']      = $hasil['level'];

            header('location:dashboard.php');
            exit;
        }
    }

    $error = true;
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <title>Signin Template · Bootstrap v5.0</title>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/styleq.css" rel="stylesheet">
  </head>
<body>
    <main class="form-signin pt-5">
      <form action="" method="POST" class="bg-dark pb-5 mt-5">
          <h1 class="h6 text-center fw-bold m-0 text-uppercase py-3">dinas binamarga</h1>

          <?php if (isset($error)) : ?>
              <div class="alert alert-danger mt-4 mx-3">
                  <b>Username atau password salah</b>
              </div>
          <?php endif; ?>

          <div class="mb-3 mt-4 mx-3">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
          </div>
          <div class="mb-3 mx-3">
            <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          </div>

          <div class="text-center mt-5">
              <button class="btn btn-md px-5 text-uppercase fw-bold" type="submit" name="login">Login</button>
          </div>
      </form>
    </main>
</body>
</html>
