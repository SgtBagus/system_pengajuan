<?php
session_start();
include"system/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
	    <link rel="icon" type="image/png" href="assets/img/icon.png">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/supersized.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>

        <div class="page-container">
            <h1>Pengajuan Barang Dan Training<br><h5>( Login )</h5></h1>
            <form action="system/act.php?op=in" method="POST">
                <input type="email" name="email" class="username" placeholder="Email">
                <input type="password" name="password" class="password" placeholder="Password">
                <button type="submit" value="Login" name="submit">Login</button>
                <div class="error"><span>+</span></div>
            </form>
        </div>
        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/js/supersized.3.2.7.min.js"></script>
        <script src="assets/js/supersized-init.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>

