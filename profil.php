<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
  include 'system/koneksi.php';


session_start();
 $logged_in = false;
 if (empty($_SESSION['email'])) {
   echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu'); document.location='../login.php';</script>";
 }
 else {
   $logged_in = true;
 }

 $query_login = "SELECT * FROM user WHERE email ='$_SESSION[email]'";
    $result_login = mysqli_query($con, $query_login);
    if(!$result_login){
      die ("Query Error: ".mysqli_errno($con).
         " - ".mysqli_error($con));
    }
    $data = mysqli_fetch_assoc($result_login);
    $id = $data["id_user"];
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];
    $namadepan = $data["nama_depan"];
    $namabelakang = $data["nama_belakang"];
    $jk = $data["jk"];
    $nohp = $data["no_hp"];
    $alamat = $data["alamat"];
    $role = $data["role"];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Profil</title>
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
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( TIM ) - <?php echo $username ?></small></small>
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
                <li>
                    <a href="notifikasi.php">
                        <i class="pe pe-7s-bell"></i>
                        <p>Notifikasi</p>
                    </a>
                </li>
                <li class="active">
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
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile <b> (<?php echo $username ?> ) </b></h4>
                            </div>
                            <div class="content">
                                <form id="form_edit_user" method="post" action="system/proses_edit_profil.php">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <label for="Email">Username</label>
                                                <input type="text" name="username" id="form_edit_user" class="form-control" placeholder="email" value="<?php echo $username ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Email">Email address</label>
                                                <input type="email" name="email" id="form_edit_user" class="form-control" placeholder="email" value="<?php echo $email ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input type="password" name="password" id="form_edit_user" class="form-control" placeholder="Password" value="<?php echo $password ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Depan</label>
                                                <input type="text" name="nama_depan" id="form_edit_user" class="form-control" placeholder="Nama Depan" value="<?php echo $namadepan ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Belakang</label>
                                                <input type="text" name="nama_belakang" id="form_edit_user" class="form-control" placeholder="Nama Belakang" value="<?php echo $namabelakang ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" id="form_edit_user" class="form-control" placeholder="Alamat" value="<?php echo $alamat ?>" >
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>No. Hp</label>
                                                <input type="number" name="nohp" id="form_edit_user" class="form-control" placeholder="No Hp" value="<?php echo $nohp ?>" >
                                            </div>
                                        </div>
                                    </div>

                                    <div align="right">
                                        
<?php
                                    echo'
                                        <a href="" onclick="return confirm(\'Anda yakin akan merubah data?\')">
                                            <button type="submit" name="input" rel="tooltip" title="Konfirmasi" class="btn btn-primary btn-fill">
                                                <i class="fa fa-edit"></i> Konfirmasi
                                            </button>
                                        </a>';
?>
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
