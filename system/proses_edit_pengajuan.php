<?php 
include 'koneksi.php';
$id_pengajuan = $_POST['id_pengajuan'];
$pengajuan = $_POST['pengajuan'];
$jenis_pengajuan = $_POST['jenis_pengajuan'];
$biaya = $_POST['biaya'];
$alasan = $_POST['alasan'];
$keterangan = $_POST['keterangan'];

$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

$query = "UPDATE pengajuan SET pengajuan='$pengajuan', jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl', biaya='$biaya',alasan='$alasan', keterangan ='$keterangan' WHERE id_pengajuan='$id_pengajuan'";
  $result = mysqli_query($con, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }

header("location:../pengajuan.php");
?>