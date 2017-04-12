<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil data NIS yang dikirim oleh index.php melalui URL
$id = $_GET['id'];

$query = "SELECT * FROM pengajuan WHERE id_pengajuan='".$id."'";
$sql = mysqli_query($con, $query); 
$data = mysqli_fetch_array($sql); 

if(is_file("../image/".$data['gambar'])) 
			unlink("../image/".$data['gambar']); 

$query2 = "DELETE FROM pengajuan WHERE id_pengajuan='".$id."'";
$sql2 = mysqli_query($con, $query2);

if($sql2){ 
	header("location:../pengajuan.php"); 
}else{

	echo "Data gagal dihapus. <a href='../pengajuan.php'>Kembali</a>";
}
?>
