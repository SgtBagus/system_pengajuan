<?php 
include 'koneksi.php';
$id_pengajuan = $_POST['id_pengajuan'];
$catatan = $_POST['catatan'];
 
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

$query = "UPDATE pengajuan SET catatan='$catatan', status='selesai', update_pengajuan='$tgl' WHERE id_pengajuan='$id_pengajuan'";
  $result = mysqli_query($link, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }


$query2 = "INSERT INTO riwayat SET kegiatan='Telah Melakukan Menolak Pengajuan', kegiatan2='Pengajuan Ditolak',
            jenis_riwayat='Penolakan', id_pengajuan_kegiatan='$id_pengajuan', tanggal_kegiatan='$tgl'";
  $result2 = mysqli_query($link, $query2);

  if(!$result2){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }

header("location:../pengajuan.php");
?>