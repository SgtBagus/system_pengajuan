<?php 
include 'koneksi.php';
$id = $_GET['id'];

$pengajuan = $_POST['pengajuan'];
$jenis_pengajuan = $_POST['jenis_pengajuan'];
$biaya = $_POST['biaya'];
$als = $_POST['alasan'];

	if($als == ""){
      $alasan = "-";
    }else {
      $alasan = $als;
    }

$ket        = $_POST['keterangan'];
    if($ket == ""){
      $keterangan = "-";
    }else {
      $keterangan = $ket;
    }

$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

	$foto 				= $_FILES['foto']['name'];
	$tmp 				= $_FILES['foto']['tmp_name'];
    $size              	= $_FILES['foto']['size'];
    $explode	        = explode('.',$foto);
    $extensi	        = $explode[count($explode)-1];

	$fotobaru = date('dmYHis').$foto;
	
	$path = "../image/".$fotobaru;
	$file_type	= array('jpg','jpeg','png' );
  	$fotobaru = date('dmYHis').$foto;
  	$path = "../image/".$fotobaru;
if ($foto == "") {
	$query = "UPDATE pengajuan SET pengajuan='$pengajuan'
			 , jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl'
			 , biaya='$biaya',alasan='$alasan', keterangan ='$keterangan' 
			 WHERE id_pengajuan='".$id."'";
}
else {
  if(!in_array($extensi,$file_type)){
          $eror   = "format";
    }
    if($size > 1000000){
          $eror   = "size";
    }
        if($eror == "format"){
          header("location: ../edit_pengajuan?id=$id&proses=format"); 
        }
        else if ($eror == "size"){
          header("location: ../edit_pengajuan?id=$id&proses=size"); 
        }

    else{
		if(move_uploaded_file($tmp, $path)){ 
			$query = "UPDATE pengajuan SET pengajuan='$pengajuan'
				, jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl'
				, gambar='$fotobaru', biaya='$biaya',alasan='$alasan'
				, keterangan ='$keterangan' WHERE id_pengajuan='".$id."'";
		}
	}
}


		$sql = mysqli_query($con, $query); 
		if($sql){ 
				header("location: ../detail_pengajuan?id=$id&proses=edit"); 
		}else{
				header("location:../edit_pengajuan?proses=error"); 
		}
?>