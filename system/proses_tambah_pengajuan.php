<?php
include 'koneksi.php';
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

    $pengajuan         = $_POST['pengajuan'];
    $id_pengaju        = $_POST['id_pengaju'];
    $jenis_pengajuan   = $_POST['jenis_pengajuan'];
    $gambar            = $_FILES['gambar']['name'];
    $tmp               = $_FILES['gambar']['tmp_name'];
    $size              = $_FILES['gambar']['size'];
    $explode	          = explode('.',$gambar);
    $extensi	          = $explode[count($explode)-1];
    $biaya             = $_POST['biaya'];
    $alasan            = $_POST['alasan'];
    $keterangan        = $_POST['keterangan'];
if($gambar == NULL){
        $query = "INSERT INTO pengajuan SET pengajuan='$pengajuan',id_user='$id_pengaju'
               , jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl'
               , biaya='$biaya', alasan='$alasan',keterangan='$keterangan'
               , status='menunggu', update_pengajuan='$tgl' ";
        $result = mysqli_query($con, $query);

        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($con).
                " - ".mysqli_error($con));
        }
        if($result){ 
          echo "<script>alert('Berhasil Menyimpan Data');</script>";
          header("location:../pengajuan"); 
        }else{
          echo "<script>alert('Terjadi Kesalahan Saat Menyimpan Data !');history.go(-1) </script>";
        }
}else{
  $file_type	= array('jpg','jpeg','png' );
  $fotobaru = date('dmYHis').$gambar;
  $path = "../image/".$fotobaru;

  if(!in_array($extensi,$file_type)){
      $eror   = true;
      $pesan  = '- Format Gambar Tidak Benar ';
    }
    if($size > 1000000){
      $eror   = true;
      $pesan  = '- Ukuran Gambar Terlalu Besar ';
    }
    if($eror == true){
      echo "<script>alert('$pesan');history.go(-1) </script>";
    }

    else{
      if(move_uploaded_file($tmp, $path)){ 
        $query = "INSERT INTO pengajuan SET pengajuan='$pengajuan',id_user='$id_pengaju'
               , jenis_pengajuan='$jenis_pengajuan', tanggal_pengajuan='$tgl', gambar='$fotobaru'
               , biaya='$biaya', alasan='$alasan',keterangan='$keterangan'
               , status='menunggu', update_pengajuan='$tgl' ";
        $result = mysqli_query($con, $query);

        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($con).
                " - ".mysqli_error($con));
        }
        if($result){ 
          header("location:../pengajuan"); 
        }else{
          echo "<script>alert('Terjadi Kesalahan Saat Menyimpan Data !');history.go(-1) </script>";
        }
      }else{
          echo "<script>alert('Gambar Gagal Disimpan !');history.go(-1) </script>";
      }
    }
}
?>