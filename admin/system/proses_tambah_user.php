<?php

include '../../system/koneksi.php';
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");

if (isset($_POST['input'])) {
  $username           = $_POST['username'];
  $email           = $_POST['email'];
  $password           = $_POST['password'];
  $nama_depan        = $_POST['nama_depan'];
  $nama_belakang        = $_POST['nama_belakang'];
  $jk     = $_POST['jeniskelamin'];
  $nohp        = $_POST['nohp'];
  $alamat        = $_POST['alamat'];
  $role        = $_POST['role'];

  $query = "INSERT INTO user SET username='$username',email='$email'
        ,password=md5('$password'),nama_depan='$nama_depan',nama_belakang='$nama_belakang',jk='$jk'
        ,no_hp='$nohp',alamat='$alamat',role='$role', pembuatan_akun='$tgl $jam', update_akun='$tgl $jam'";
  $result = mysqli_query($con, $query);

  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }
}

header("location:../user");
?>