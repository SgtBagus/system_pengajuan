<?php 
include '../../system/koneksi.php';
$id_pengajuan = $_POST['id_pengajuan']; 
 
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

$query = "UPDATE pengajuan SET status='selesai', update_pengajuan='$tgl' WHERE id_pengajuan='$id_pengajuan'";
echo $query;
  $result = mysqli_query($con, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }

header("location:../pengajuan");
?> 