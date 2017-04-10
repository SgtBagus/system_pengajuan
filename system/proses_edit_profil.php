<?php 
include 'koneksi.php';
$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$nama_depan = $_POST['nama_depan'];
$nama_belakang = $_POST['nama_belakang'];
$alamat = $_POST['alamat'];
$nohp = $_POST['nohp'];
 
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");

$query = "UPDATE user SET email='$email', password=md5('$password'), nama_depan='$nama_depan', 
            nama_belakang='$nama_belakang', no_hp='$nohp', alamat='$alamat', update_akun='$tgl $jam' WHERE id_user='$id'";
  $result = mysqli_query($con, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }

header("location:../profil.php");
?>