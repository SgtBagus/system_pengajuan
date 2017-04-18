<?php
include '../../system/koneksi.php';

if (isset($_POST['input'])) {

  $jenis_pengajuan           = $_POST['jenis_pengajuan'];
  $deskripsi           = $_POST['deskripsi'];

$cekdulu= "SELECT * FROM jenis_pengajuan WHERE jenis_pengajuan='$jenis_pengajuan'";
$prosescek= mysqli_query($con, $cekdulu);
if (mysqli_num_rows($prosescek)>0) { 
    echo "<script>alert('Jenis Pengajuan Sudah Ada');history.go(-1) </script>";
}
else { 

  $query = "INSERT INTO jenis_pengajuan SET jenis_pengajuan='$jenis_pengajuan', deskripsi='$deskripsi'";
  $result = mysqli_query($con, $query);
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }
header("location:../jenis_pengajuan");
}
}
?>