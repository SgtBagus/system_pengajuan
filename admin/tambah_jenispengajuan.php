<?php

  include '../system/koneksi.php';


session_start();
 $logged_in = false;
 if (empty($_SESSION['email'])) {
   echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu'); document.location='../login';</script>";
 }
 else {
   $logged_in = true;
 }
 
    $query = "SELECT max(id_jenis_pengajuan) FROM jenis_pengajuan ";
    $result = mysqli_query($con, $query);
    if(!$result){
      die ("Query Error: ".mysqli_errno($con).
         " - ".mysqli_error($con));
    }
    $data = mysqli_fetch_assoc($result);
    $id = $data["max(id_jenis_pengajuan)"];
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Tambah Jenis Pengajuan</title>
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

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="black" data-image="assets/img/sidebar.jpg">
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
    $username = $data_login["username"];
?>
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( Manajemen ) - <?php echo $username ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index">
                        <i class="pe pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="pengajuan">
                        <i class="pe pe-7s-note2"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
                <li>
                    <a href="riwayat">
                        <i class="pe pe-7s-timer"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
                <li class="active">
                    <a href="master">
                        <i class="pe pe-7s-server"></i>
                        <p>Master</p>
                    </a>
                </li>
                <li>
                    <a href="../logout" onclick = "if (! confirm('Anda yakin ingin keluar ?')) { return false; }">
                        <i class="pe pe-7s-back"></i>
                        <p>Log out</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Tambah Data Jenis Pengajuan</h4>
                            </div>
                            <div class="content">
                                <form id="form_user" method="post" action="system/proses_tambah_jenis_pengajuan">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Pengajuan</label>
                                                <input type="text" name="jenis_pengajuan" id="jenis_pengajuan" class="form-control" placeholder="Jenis Pengajuan" required >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" >
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div align="right">
                                        <a href="jenis_pengajuan">
                                            <button type="button" rel="tooltip" class="btn btn-info btn-fill">
                                                        <i class="fa fa-arrow-left"></i> Kembali
                                            </button>
                                        </a>
                                        <button type="submit" name="input" rel="tooltip" class="btn btn-primary btn-fill">
                                                <i class="fa fa-check"></i> Tambah
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
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
