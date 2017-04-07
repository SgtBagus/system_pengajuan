<?php 
include 'koneksi.php';
$id_pengajuan = $_POST['id_pengajuan']; 
 
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

$query = "UPDATE pengajuan SET status='selesai', update_pengajuan='$tgl' WHERE id_pengajuan='$id_pengajuan'";
echo $query;
  $result = mysqli_query($link, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }

header("location:../pengajuan.php");
?> 