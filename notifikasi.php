<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include 'system/koneksi.php';



session_start();
 $logged_in = false;
 if (empty($_SESSION['email'])) {
   echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu'); document.location='login.php';</script>";
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
	<title>Notifikasi</title>
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
                <a href="index.php" class="simple-text">
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
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( TIM ) - <?php echo $username_login ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index.php">
                        <i class="pe pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li>
                    <a href="pengajuan.php">
                        <i class="pe pe-7s-note2"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
                <li class="active">
                    <a href="notifikasi.php">
                        <i class="pe pe-7s-bell"></i>
                        <p>Notifikasi</p>
                    </a>
                </li>
                <li>
                    <a href="profil.php">
                        <i class="pe pe-7s-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li>
                    <a href="login.php">
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
                    <div class="header">
                        <h4>Notifikasi</h4>
                    </div>
<?php
    $query2 = "SELECT a.id_riwayat, a.kegiatan, a.id_pengajuan, a.jenis_riwayat, a.kegiatan3, 
               a.tanggal_kegiatan, b.id_user, a.notifikasi FROM riwayat 
               AS a INNER JOIN pengajuan AS b WHERE a.id_pengajuan = b.id_pengajuan
               AND b.id_user = '$id_login' ORDER BY id_riwayat DESC " ;
      $result2 = mysqli_query($con, $query2);
      if(!$result2){
        die ("Query Error: ".mysqli_errno($con).
           " - ".mysqli_error($con));
      }
      while($data2 = mysqli_fetch_assoc($result2)){ 
                    echo '<a href="system/notifikasi_pengajuan.php?id='.$data2['id_riwayat'].'" style="color:black">';
                        echo '<div class="card">';
                            echo '<div class="content">';
                                echo '<input type="hidden" name="id_pengajuan" value="'.$data2['id_pengajuan'].'">';
                                echo '<h5><b>'.$data2['jenis_riwayat'].'</b> - <small>'.$data2['kegiatan3'].'</small></h5>';
                                echo '<h5>Tanggal kegiatan = '.$data2['tanggal_kegiatan'].'</h5>';
    if ($data2['notifikasi'] == "1"){
                                echo '<div align="right">';
                                    echo '<i class="fa fa-check"></i>';
                                echo '</div>';
    }
    else{

    }
                            echo '</div>';
                        echo '</div>';
                    echo '</a>';
      }
?>                          
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
