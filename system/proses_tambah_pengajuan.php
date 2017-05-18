<?php
  include 'koneksi.php';
    $tanggal= mktime(date("m"),date("d"),date("Y"));
    $tgl = date("Y-m-d", $tanggal);
    $pengajuan         = $_POST['pengajuan'];
    $id_pengaju        = $_POST['id_pengaju'];
    $id_jenis_pengajuan   = $_POST['id_jenis_pengajuan'];
    $gambar            = $_FILES['gambar']['name'];
    $tmp               = $_FILES['gambar']['tmp_name'];
    $size              = $_FILES['gambar']['size'];
    $explode	          = explode('.',$gambar);
    $extensi	          = $explode[count($explode)-1];
    $biaya             = $_POST['biaya'];
    $alasan            = $_POST['alasan'];
    $ket        = $_POST['keterangan'];
    if($ket == ""){
      $keterangan = "-";
    }else {
      $keterangan = $ket;
    }

    echo $id_jenis_pengajuan;
  if($gambar == NULL){
    $query = "INSERT INTO pengajuan SET pengajuan='$pengajuan',id_user='$id_pengaju'
               , id_jenis_pengajuan='$id_jenis_pengajuan', tanggal_pengajuan='$tgl'
               , biaya='$biaya', alasan='$alasan',keterangan='$keterangan'
               , status='menunggu', update_pengajuan='$tgl' ";
      $result = mysqli_query($con, $query);

    if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($con).
                  " - ".mysqli_error($con)); 
    }
      if($result){ 
        header("location: ../pengajuan?proses=tambah"); 
      }else{
        header("location: ../tambah_pengajuan?proses=error"); 
      }
  }
  else{
    $file_type	= array('jpg','jpeg','png' );
    $fotobaru = date('dmYHis').$gambar;
    $path = "../image/".$fotobaru; 
      
      if(!in_array($extensi,$file_type)){
          $eror   = "format";
      }

      if($size > 1000000){
          $eror   = "size";
      }

        if($eror == "format"){
          header("location: ../tambah_pengajuan?proses=format"); 
        }
        else if ($eror == "size"){
          header("location: ../tambah_pengajuan?proses=size"); 
        }
        else{
          if(move_uploaded_file($tmp, $path)){ 
            $query = "INSERT INTO pengajuan SET pengajuan='$pengajuan',id_user='$id_pengaju'
                     , id_jenis_pengajuan='$id_jenis_pengajuan', tanggal_pengajuan='$tgl', gambar='$fotobaru'
                     , biaya='$biaya', alasan='$alasan',keterangan='$keterangan'
                     , status='menunggu', update_pengajuan='$tgl' ";
            $result = mysqli_query($con, $query);

            if(!$result){
                die ("Query gagal dijalankan: ".mysqli_errno($con).
                    " - ".mysqli_error($con));
            }
            if($result){ 
              header("location: ../pengajuan?proses=tambah"); 
            }
            else{
              header("location: ../tambah_pengajuan?proses=error"); 
            }
          }
          else{
              header("location: ../tambah_pengajuan?proses=error"); 
          }
        }
  }
?>