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
        
  <link rel="stylesheet" href="assets/dist/sweetalert.css">
  <script src="assets/dist/sweetalert-dev.js"></script>

        <style>
body{background-image:url(assets/img/1.jpg); background-size:cover}
#test{padding:20px}
h1{text-align:center; color:#FFF}
p{margin-bottom:10px; color:#FFF}
</style>

    </head>

    <body>
        <div class="page-container">
            <img src='assets/img/logo.png' width='300' height='158'><br>
            <h1>Pengajuan Barang Dan Training<br>
<?php 
if (isset($_GET['proses'])) {
    $login = ($_GET["proses"]);
    if($login == "false"){
        echo'<script>
        sweetAlert("Mohon Maaf", "Periksa ulang Email atau Password anda!", "error");
        </script>';
    }
  } 
?>
            <form action="system/act?op=in" method="POST" >
                <input type="text" name="email" placeholder="Email" required
                oninvalid="this.setCustomValidity('Mohon isi Email Anda !')" 
                oninput="setCustomValidity('')">
                <input type="password" name="password" placeholder="Password" required
                oninvalid="this.setCustomValidity('Mohon isi Password Anda !')"  
                oninput="setCustomValidity('')">
                <button type="submit" value="Login" name="submit">Login</button>
                <div class="error"><span>+</span></div>
            </form>
        </div>
    </body>
</html>

