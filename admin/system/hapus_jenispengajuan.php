<?php
  include("../../system/koneksi.php");
    $tanggal= mktime(date("m"),date("d"),date("Y"));
    $tgl = date("Y-m-d", $tanggal);
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "DELETE FROM jenis_pengajuan WHERE id_jenis_pengajuan='$id'";
    $hasil_query = mysqli_query($con, $query);
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($con).
           " - ".mysqli_error($con));
    } 
  }


  header("location:../jenis_pengajuan?proses=delete");
?>