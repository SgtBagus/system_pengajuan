<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// mengecek apakah tombol input dari form telah diklik
if (isset($_POST['input'])) {

	// membuat variabel untuk menampung data dari form
  $jenis_pengajuan           = $_POST['jenis_pengajuan'];
  $deskripsi           = $_POST['deskripsi'];

  // jalankan query INSERT untuk menambah data ke database
  $query = "INSERT INTO jenis_pengajuan SET jenis_pengajuan='$jenis_pengajuan', deskripsi='$deskripsi'";
  $result = mysqli_query($link, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
}

header("location:../jenis_pengajuan.php");
?>