<?php 
include '../../system/koneksi.php';
$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$nama_depan = $_POST['nama_depan'];
$nama_belakang = $_POST['nama_belakang'];
$alamat = $_POST['alamat']; 
$nohp = $_POST['nohp'];
 
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tgl = date("Y-m-d", $tanggal);
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");

$cekdulu= "SELECT * FROM user WHERE email='$email'";
$prosescek= mysqli_query($con, $cekdulu);
    $cek_data = mysqli_fetch_assoc($prosescek);
    $cekemail = $cek_data["email"];

if ($cekemail == $email) { 
    if($password == ""){
        $query = "UPDATE user SET username='$username', nama_depan='$nama_depan', 
                    nama_belakang='$nama_belakang', no_hp='$nohp', alamat='$alamat', update_akun='$tgl $jam' WHERE id_user='$id'";
        $result = mysqli_query($con, $query);
    }else{
        $query = "UPDATE user SET username='$username',password=md5('$password'), nama_depan='$nama_depan', 
                    nama_belakang='$nama_belakang', no_hp='$nohp', alamat='$alamat', update_akun='$tgl $jam' WHERE id_user='$id'";
        $result = mysqli_query($con, $query);
    }
        header('location:../detail_user?id='.$id.' & proses=edit'); 
}else if ($cek_data == $email){

}
else {
    if($password == ""){ 
        $query = "UPDATE user SET username='$username', email='$email', nama_depan='$nama_depan', 
                    nama_belakang='$nama_belakang', no_hp='$nohp', alamat='$alamat', update_akun='$tgl $jam' WHERE id_user='$id'";
        $result = mysqli_query($con, $query);
    }else{
        $query = "UPDATE user SET username='$username', email='$email',password=md5('$password'), nama_depan='$nama_depan', 
                    nama_belakang='$nama_belakang', no_hp='$nohp', alamat='$alamat', update_akun='$tgl $jam' WHERE id_user='$id'";
        $result = mysqli_query($con, $query);
    }
        header('location:../detail_user?id='.$id.'&proses=edit'); 
}

        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($con).
                " - ".mysqli_error($con));
        }
?>