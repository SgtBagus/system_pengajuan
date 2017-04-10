<?php
  include("koneksi.php");
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "DELETE FROM pengajuan WHERE id_pengajuan='$id'";
    $hasil_query = mysqli_query($con, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($con).
           " - ".mysqli_error($con));
    }
  }
  header("location:../pengajuan.php");
?>