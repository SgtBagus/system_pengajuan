<?php 
include 'koneksi.php';
$id = $_GET['id'];

		$query = "SELECT * FROM pengajuan WHERE id_pengajuan='".$id."'";
		$sql = mysqli_query($con, $query); 
		$data = mysqli_fetch_array($sql); 


	$fotobaru = date('dmYHis').$foto;
	
			if(is_file("../image/".$data['gambar'])) 
						unlink("../image/".$data['gambar']); 

				$query = "UPDATE pengajuan SET gambar=''
                          WHERE id_pengajuan='".$id."'";

				$sql = mysqli_query($con, $query); 

			if($sql){ 
					header("location: ../detail_pengajuan?id=$id&proses=edit"); 

			}else{
				header("location:../edit_pengajuan?proses=error"); 
			}
?>