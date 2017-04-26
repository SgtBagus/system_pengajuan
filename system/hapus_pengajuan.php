<?php

include "koneksi.php"; 

$id = $_GET['id'];

$query = "SELECT * FROM pengajuan WHERE id_pengajuan='".$id."'";
$sql = mysqli_query($con, $query); 
$data = mysqli_fetch_array($sql); 

if(is_file("../image/".$data['gambar'])) 
			unlink("../image/".$data['gambar']); 

$query2 = "DELETE FROM pengajuan WHERE id_pengajuan='".$id."'";
$sql2 = mysqli_query($con, $query2);

if($sql2){ 
	header("location:../pengajuan?proses=delete"); 
}else{

	header("location:../pengajuan?proses=error"); 
}
?>
  