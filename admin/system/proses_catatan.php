<?php 
include 'koneksi.php';
$id= $_POST['id_catatan'];
$catatan = $_POST['catatan'];
 
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);

$query = "UPDATE catatan SET catatan='$catatan', update_catatan='$tgl' WHERE id_catatan ='$id'";
echo $query;
  $result = mysqli_query($link, $query);
  // periska query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  
header("location:../index.php");
?>