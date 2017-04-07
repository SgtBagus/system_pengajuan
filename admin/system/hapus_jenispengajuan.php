<?php
  include("koneksi.php");
    $tanggal= mktime(date("m"),date("d"),date("Y"));
    $tgl = date("Y-m-d", $tanggal);
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "DELETE FROM jenis_pengajuan WHERE id_jenis_pengajuan='$id'";
    $hasil_query = mysqli_query($link, $query);
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($link).
           " - ".mysqli_error($link));
    } 
  }


  header("location:../jenis_pengajuan.php");
?>