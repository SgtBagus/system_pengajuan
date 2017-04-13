<?php

include 'koneksi.php';
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

  $pengajuan        = $_POST['pengajuan'];
  $id_pengaju       = $_POST['id_pengaju'];
  $jenis_pengajuan  = $_POST['jenis_pengajuan'];
  $gambar           = $_FILES['gambar']['name'];
  $tmp              = $_FILES['gambar']['tmp_name'];
  $biaya            = $_POST['biaya'];
  $alasan           = $_POST['alasan'];
  $keterangan       = $_POST['keterangan'];

$fotobaru = date('dmYHis').$gambar;
$path = "../image/".$fotobaru;
if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
	// Proses simpan ke Database
	
  $query = "INSERT INTO pengajuan SET pengajuan='$pengajuan',id_user='$id_pengaju'
        , jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl', gambar='$fotobaru'
        , biaya='$biaya', alasan='$alasan',keterangan='$keterangan'
        , status='menunggu', update_pengajuan='$tgl' ";
  echo $query;
  $result = mysqli_query($con, $query);

  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
           " - ".mysqli_error($con));
  }

	if($result){ 
		header("location:../pengajuan"); 
	}else{
		// Jika Gagal, Lakukan :
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		echo "<br><a href='../ajukan_pengajuan'>Kembali Ke Form</a>";
	}
}else{

	echo "Maaf, Gambar gagal untuk diupload.";
	echo "<br><a href='../ajukan_pengajuan'>Kembali Ke Form</a>";
}

?>