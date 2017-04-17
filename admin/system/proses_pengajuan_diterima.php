<?php 
include '../../system/koneksi.php';
$id_pengajuan = $_POST['id_pengajuan']; 
$jadwal_pelaksanaan = $_POST['jadwal_pelaksanaan'];
$catatan = $_POST['catatan'];
 
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

$query = "UPDATE pengajuan SET jadwal_pelaksanaan='$jadwal_pelaksanaan', catatan='$catatan', status='proses', update_pengajuan='$tgl' WHERE id_pengajuan='$id_pengajuan'";
  $result = mysqli_query($con, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }
 
$query2 = "INSERT INTO riwayat SET kegiatan='Telah Melakukan Menerima Pengajuan', kegiatan2='Pengajuan diterima',
          kegiatan3='Pengajuan Anda Telah DiTerima Oleh Pihak Manajemen', jenis_riwayat='Penerimaan', 
          id_pengajuan='$id_pengajuan', tanggal_kegiatan='$tgl', notifikasi='1' ";
  $result2 = mysqli_query($con, $query2);

  if(!$result2){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }
  
header("location:../pengajuan");
?>