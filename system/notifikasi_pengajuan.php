<?php 
include 'koneksi.php';
$id = ($_GET["id"]);
$query2 = "SELECT id_pengajuan FROM riwayat WHERE id_riwayat = '$id' " ;
      $result2 = mysqli_query($con, $query2);
    $data2 = mysqli_fetch_assoc($result2);
    $id_pengajuan = $data2["id_pengajuan"];
    echo $id_pengajuan;
    $query = "UPDATE riwayat SET notifikasi='0' WHERE id_riwayat='$id'";
    $result = mysqli_query($con, $query);
header("location:../detail_pengajuan.php?id=$id_pengajuan");
?>