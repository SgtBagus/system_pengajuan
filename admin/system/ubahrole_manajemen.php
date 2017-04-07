<?php 
include 'koneksi.php';

$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");

    $id = ($_GET["id"]);

$query = "UPDATE user SET role='manajemen', update_akun='$tgl $jam' WHERE id_user='$id'";
  $result = mysqli_query($link, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }

header("location:../user.php");
?>