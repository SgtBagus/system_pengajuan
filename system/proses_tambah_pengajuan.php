<?php

include 'koneksi.php';
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

if (isset($_POST['input'])) {
  $pengajuan           = $_POST['pengajuan'];
  $id_pengaju           = $_POST['id_pengaju'];
  $jenis_pengajuan           = $_POST['jenis_pengajuan'];
  $biaya     = $_POST['biaya'];
  $alasan        = $_POST['alasan'];
  $keterangan        = $_POST['keterangan'];

  $query = "INSERT INTO pengajuan SET pengajuan='$pengajuan',id_user='$id_pengaju'
        ,jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl', biaya='$biaya'
        , alasan='$alasan',keterangan='$keterangan', status='menunggu', update_pengajuan='$tgl' ";
  $result = mysqli_query($con, $query);

  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }
  
}

header("location:../pengajuan.php");
?>