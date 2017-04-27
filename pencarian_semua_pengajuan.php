<?php
  include 'system/koneksi.php';
session_start();
 $logged_in = false;
 if (empty($_SESSION['email'])) {
   echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu'); document.location='login';</script>";
 }
 else {
   $logged_in = true;
 }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Pengajuan</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

  <link rel="stylesheet" href="assets/dist/sweetalert.css">
  <script src="assets/dist/sweetalert-dev.js"></script>
  
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar.jpg">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="index" class="simple-text">
<?php
 $query_login = "SELECT * FROM user WHERE email ='$_SESSION[email]'";
    $result_login = mysqli_query($con, $query_login);
    if(!$result_login){
      die ("Query Error: ".mysqli_errno($con).
         " - ".mysqli_error($con));
    }
    $data_login = mysqli_fetch_assoc($result_login);
    $id_login = $data_login["id_user"];
    $username_login = $data_login["username"];
?>
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( Manajemen ) - <?php echo $username_login ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li >
                    <a href="index">
                        <i class="pe pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="active">
                    <a href="pengajuan">
                        <i class="pe pe-7s-note2"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
                
                <li>
                    <a href="notifikasi">
                        <i class="pe pe-7s-bell"></i>

<?php
    $query_notifikasi = " SELECT a.id_riwayat FROM riwayat 
               AS a INNER JOIN pengajuan AS b WHERE a.id_pengajuan = b.id_pengajuan
               AND b.id_user = '$id_login' AND a.notifikasi= '1' ";
    $result_notifikasi = mysqli_query($con, $query_notifikasi);
      $banyakdata_notifikasi = $result_notifikasi->num_rows;
?>


                        <p>Notifikasi 
<?php
    if ($banyakdata_notifikasi > 0){
        if( $banyakdata_notifikasi <= 10 ){
            $hasil = $banyakdata_notifikasi;
            echo "<span class='new badge'>$hasil</span>";
        }else{
            $hasil = "10 +";
            echo "<span class='new badge'>$hasil</span>";
        }
    }else{

    }
?>
                        </p>
                    </a>
                </li>
                <li>
                    <a href="profil">
                        <i class="pe pe-7s-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li>
                    <a href="#" onclick = "logout()">
                        <i class="pe pe-7s-back"></i>
                        <p>Log out</p>
                    </a>
                </li>

                <script type="text/javascript">
                    function logout() {
                        swal({
                            title: "Konfirmasi ?",
                            text: "Apakah anda ingin keluar ",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#FF4A55",
                            confirmButtonText: "Logout",
                            cancelButtonText: "Batal",
                            closeOnConfirm: false
                        },
                        function(){
                            document.location="logout";
                        })
                    }
                </script>

            </ul>
        </div>
    </div>

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
<?php
    $judul = ($_GET["pengajuan"]);
    $username = ($_GET["pengaju"]);
    $tanggal = ($_GET["tanggal"]);
    $status = ($_GET["status"]);
    $query = "SELECT a.id_pengajuan, a.pengajuan, a.id_user,  b.username, a.jenis_pengajuan, a.tanggal_pengajuan, 
            a.biaya, a.status FROM pengajuan AS a INNER JOIN user AS b WHERE a.id_user = b.id_user 
            AND a.pengajuan LIKE '%".$judul."%' AND b.username LIKE '%".$username."%' 
            AND a.tanggal_pengajuan like '%".$tanggal."%' AND a.status like '%".$status."%' ORDER BY a.pengajuan ASC " ;
    $result = mysqli_query($con, $query);
      $no = 1;
      $cek = count($result);
      $banyakdata = $result->num_rows;


if ($status == ""){
    $semua = "semua";
}else{
    $semua = $status;
}
?>
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Data Pengguna</h4>
                                        <small>Pencarian Judul = <b>"<?php echo $judul ?>"</b> Pengaju = <b>"<?php echo $username ?>"</b> Tanggal = <b>"<?php echo $tanggal ?>"</b> Status = <b>"<?php echo $semua ?>"</b>
                                        <br> Data sebanyak <b>[ '<?php echo $banyakdata ?>' ]</b></small>
                                        <a href="semua_pengajuan"><p class="category"><i class="fa fa-refresh"></i> Reset Data Pengguna</p></a>
                                    </div>  
                                </div>
                                <br>
                                <div class="row">
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>Pengajuan</th>
                                        <th>Pengaju</th>
                                        <th>Jenis</th>
                                        <th>tanggal</th>
                                        <th>biaya</th>
                                        <th>status</th>
                                        <th>Tindak Lanjut</th>
                                    </thead>
                                    <tbody>

<?php
      if($result->num_rows == 0){
            echo "<tr>";
                echo "<td>Data Tidak Di temukan</td>";
            echo "</tr>";
      }
      else {
        while($data = mysqli_fetch_array($result))
      {
                                        echo "<tr>";
                                            echo "<td>$no</td>";
                                            echo "<td>$data[pengajuan]</td>";
                                            echo "<td>$data[username]</td>";
                                            echo "<td>$data[jenis_pengajuan]</td>";
                                            echo "<td>$data[tanggal_pengajuan]</td>";
                                            echo "<td>$data[biaya]</td>";
                                            echo "<td>$data[status]</td>";
                                            echo '<td align="center">';
    if($data['id_user']== $id_login ){
        if($data['status'] == "menunggu" ){
                                            echo '
                                                <a href="detail_pengajuan?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-fill btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                <button onclick="editpengajuan()"type="button" rel="tooltip" title="Ubah Pengajuan" class="btn btn-primary btn-fill btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button onclick="batalpengajuan()" type="button" rel="tooltip" title="Batalkan Pengajuan" class="btn btn-danger btn-fill btn-sm">
                                                    <i class="fa fa-close"></i>
                                                </button>';                                            
    echo '<script type="text/javascript">
            function editpengajuan() {
                swal({
                    title: "Konfirmasi ?",
                    text: "Apakah anda ingin mengubah pengajuan",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3472F7",
                    confirmButtonText: "Iya",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                },
                function(){
                    document.location="edit_pengajuan?id='.$data['id_pengajuan'].'";
                })
            }
            function batalpengajuan() {
                swal({
                    title: "Konfirmasi ?",
                    text: "Apakah anda ingin membatalkan pengajuan",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF4A55",
                    confirmButtonText: "Iya",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                },
                function(){
                    document.location="system/hapus_pengajuan?id='.$data['id_pengajuan'].'";
                })
            }
        </script>';

        }
        else if ($data['status'] == "proses" ){
                                            echo '
                                                <a href="detail_pengajuan?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-fill btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>';
        }
        else{
                                            echo '
                                                <a href="detail_pengajuan?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-fill btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                <button onclick="hapuspengajuan()" type="button" rel="tooltip" title="Hapus Pengajuan" class="btn btn-danger btn-fill btn-sm">
                                                    <i class="fa fa-close"></i>
                                                </button>';                                            
    echo '<script type="text/javascript">
            function hapuspengajuan() {
                swal({
                    title: "Konfirmasi ?",
                    text: "Apakah anda ingin menghapus pengajuan",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF4A55",
                    confirmButtonText: "Iya",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                },
                function(){
                    document.location="system/hapus_pengajuan?id='.$data['id_pengajuan'].'";
                })
            }
        </script>';
        }
    }
    else {
        echo '
                                                <a href="detail_pengajuan?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-fill btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>';

    }
                                            echo '</td>';
                                        echo "</tr>";
                                        $no++;
    }
}
?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            demo.initChartist();
        });
    </script>

</html>
