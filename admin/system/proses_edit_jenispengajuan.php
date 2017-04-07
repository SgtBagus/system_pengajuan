<?php 
include 'koneksi.php';
$id = $_POST['id'];
$jenis_pengajuan = $_POST['jenis_pengajuan'];
$deskripsi = $_POST['deskripsi'];

$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

$query = "UPDATE jenis_pengajuan SET jenis_pengajuan='$jenis_pengajuan', deskripsi='$deskripsi' WHERE id_jenis_pengajuan ='$id'";
  $result = mysqli_query($link, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));

  }
header("location:../jenis_pengajuan.php");
?>