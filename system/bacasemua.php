<?php 
include 'koneksi.php';
$id = ($_GET["id_user"]);
echo $id;

    $query = "UPDATE riwayat AS a INNER JOIN pengajuan AS b 
             SET a.notifikasi='0' WHERE a.id_pengajuan = b.id_pengajuan AND b.id_user = '$id'";

    $result = mysqli_query($con, $query);
header("location:../notifikasi");
?>