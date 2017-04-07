<?php 
include 'koneksi.php';
$id_pengajuan = $_POST['id_pengajuan']; 
$jadwal_pelaksanaan = $_POST['jadwal_pelaksanaan'];
$catatan = $_POST['catatan'];
 
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

$query = "UPDATE pengajuan SET jadwal_pelaksanaan='$jadwal_pelaksanaan', catatan='$catatan', status='proses', update_pengajuan='$tgl' WHERE id_pengajuan='$id_pengajuan'";
  $result = mysqli_query($link, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }

$query2 = "INSERT INTO riwayat SET kegiatan='Telah Melakukan Perubahan Pengajuan', kegiatan2='Pengajuan Diubah',
            jenis_riwayat='Pengubahan', id_pengajuan_kegiatan='$id_pengajuan', tanggal_kegiatan='$tgl'";
  $result2 = mysqli_query($link, $query2);

  if(!$result2){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }

header("location:../pengajuan.php");
?>