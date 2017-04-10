<?php

include 'koneksi.php';
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

if (isset($_POST['input'])) {
  $pengajuan           = $_POST['pengajuan'];
  $username_pengaju           = $_POST['username_pengaju'];
  $jenis_pengajuan           = $_POST['jenis_pengajuan'];
  $biaya     = $_POST['biaya'];
  $alasan        = $_POST['alasan'];
  $keterangan        = $_POST['keterangan'];

  $query = "INSERT INTO pengajuan SET pengajuan='$pengajuan',username_pengaju='$username_pengaju'
        ,jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl', biaya='$biaya'
        , alasan='$alasan',keterangan='$keterangan', jadwal_pelaksanaan='NULL', catatan='', status='menunggu', update_pengajuan='$tgl' ";
  $result = mysqli_query($con, $query);

  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }

move_uploaded_file($_FILES['gambar']['tmp_name'], "gambar/".$_FILES['gambar']['name']);
echo"<script>alert('Gambar Berhasil diupload !');history.go(-1);</script>";
}

header("location:../pengajuan.php");
?>