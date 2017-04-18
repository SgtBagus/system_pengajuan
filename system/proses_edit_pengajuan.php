<?php 
include 'koneksi.php';
$id = $_GET['id'];

$pengajuan = $_POST['pengajuan'];
$jenis_pengajuan = $_POST['jenis_pengajuan'];
$biaya = $_POST['biaya'];
$alasan = $_POST['alasan'];
$keterangan = $_POST['keterangan'];
$ubah_foto = $_POST['ubah_foto'];

$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);


		$query = "SELECT * FROM pengajuan WHERE id_pengajuan='".$id."'";
		$sql = mysqli_query($con, $query); 
		$data = mysqli_fetch_array($sql); 


if(isset($_POST['tambah_foto'])){
	$foto = $_FILES['foto']['name'];
	$tmp = $_FILES['foto']['tmp_name'];

	$fotobaru = date('dmYHis').$foto;
	
	$path = "../image/".$fotobaru;

	if(move_uploaded_file($tmp, $path)){ 

		$query = "UPDATE pengajuan SET pengajuan='$pengajuan'
         , jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl'
         , gambar='$fotobaru', biaya='$biaya',alasan='$alasan'
         , keterangan ='$keterangan' WHERE id_pengajuan='".$id."'";
		$sql = mysqli_query($con, $query); 
		if($sql){ 
			header("location: ../detail_pengajuan?id=$id"); 
		}else{
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			echo "<br><a href='../pengajuan'>Kembali Ke Form</a>";
		}
	}else{
		echo "Maaf, Gambar gagal untuk diupload.";
		echo "<br><a href='../pengajuan'>Kembali Ke Form</a>";
	}
}
else if($ubah_foto == "ubah" ){ 
	$foto = $_FILES['foto']['name'];
	$tmp = $_FILES['foto']['tmp_name'];

	$fotobaru = date('dmYHis').$foto;
	
	$path = "../image/".$fotobaru;

	if(move_uploaded_file($tmp, $path)){ 

		if(is_file("../image/".$data['gambar'])) 
			unlink("../image/".$data['gambar']); 
		
		$query = "UPDATE pengajuan SET pengajuan='$pengajuan'
         , jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl'
         , gambar='$fotobaru', biaya='$biaya',alasan='$alasan'
         , keterangan ='$keterangan' WHERE id_pengajuan='".$id."'";
		$sql = mysqli_query($con, $query); 

		if($sql){ 
			
			header("location: ../detail_pengajuan?id=$id"); 
		}else{
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			echo "<br><a href='../pengajuan'>Kembali Ke Form</a>";
		}
	}else{
		echo "Maaf, Gambar gagal untuk diupload.";
		echo "<br><a href='../pengajuan'>Kembali Ke Form</a>";
	}
}
else if ($ubah_foto == "hapus"){
	
if(is_file("../image/".$data['gambar'])) 
			unlink("../image/".$data['gambar']); 

	$query = "UPDATE pengajuan SET pengajuan='$pengajuan'
         , jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl'
         , gambar='', biaya='$biaya',alasan='$alasan', keterangan ='$keterangan' 
         WHERE id_pengajuan='".$id."'";
	$sql = mysqli_query($con, $query); 

if($sql){ 
	header("location:../detail_pengajuan?id=$id"); 

}else{

	echo "Data gagal dihapus. <a href='../pengajuan'>Kembali</a>";
}

}
else{ 

	$query = "UPDATE pengajuan SET pengajuan='$pengajuan'
         , jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl'
         , biaya='$biaya',alasan='$alasan', keterangan ='$keterangan' 
         WHERE id_pengajuan='".$id."'";
	$sql = mysqli_query($con, $query); 

	if($sql){ 
		
			header("location: ../detail_pengajuan?id=$id"); 
	}else{
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			echo "<br><a href='edit_pengajuan'>Kembali Ke Form</a>";
	}
}
?>