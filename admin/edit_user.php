<?php
  include 'system/koneksi.php';
  

session_start();
 $logged_in = false;
 if (empty($_SESSION['email'])) {
   echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu'); document.location='../login.php';</script>";
 }
 else {
   $logged_in = true;
 }
  if (isset($_GET['id'])) {
    $id = ($_GET["id"]);
    $query = "SELECT * FROM user WHERE id_user ='$id'";
    $result = mysqli_query($link, $query);
    if(!$result){
      die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
    }
    $data = mysqli_fetch_assoc($result);
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

  } 

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Edit User</title>
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
    $result_login = mysqli_query($link, $query_login);
    if(!$result_login){
      die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
    }
    $data_login = mysqli_fetch_assoc($result_login);
    $username_login = $data_login["username"];
?>
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( Manajemen ) - <?php echo $username_login ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index.php">
                        <i class="pe pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="pengajuan.php">
                        <i class="pe pe-7s-note2"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
                <li>
                    <a href="riwayat.php">
                        <i class="pe pe-7s-timer"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
                <li class="active">
                    <a href="master.php">
                        <i class="pe pe-7s-server"></i>
                        <p>Master</p>
                    </a>
                </li>
                <li>
                    <a href="../logout.php">
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
                                <h4 class="title">Edit Profile <b> (<?php echo $username ?> ) </b> - <small> <?php echo $role ?></small></h4>
                            </div>
                            <div class="content">
                                <form id="form_edit_user" method="post" action="system/proses_edit_user.php">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <input type="text" name="username" id="username" class="form-control" placeholder="username" value="<?php echo $username ?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Email">Email address</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="email" value="<?php echo $email ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo $password ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Depan</label>
                                                <input type="text" name="nama_depan" id="nama_depan" class="form-control" placeholder="Nama Depan" value="<?php echo $namadepan ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Belakang</label>
                                                <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" placeholder="Nama Belakang" value="<?php echo $namabelakang ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" value="<?php echo $alamat ?>" >
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>No. Hp</label>
                                                <input type="number" name="nohp" id="no_hp" class="form-control" placeholder="No Hp" value="<?php echo $nohp ?>" >
                                            </div>
                                        </div>
                                    </div>

                                    <div align="right">
                                        <a href="user.php">
                                            <button type="button" rel="tooltip" class="btn btn-info btn-fill">
                                                        <i class="fa fa-arrow-left"></i> Lihat Data Penguna
                                            </button>
                                        </a>
                                        
<?php
    if( $role == "manajemen" ){
        echo '<a href="system/ubahrole_tim.php?id='.$data['id_user'].'" onclick="return confirm(\'Anda yakin akan merubah role menjadi tim ?\')">
                                            <button type="button" name="input" rel="tooltip" class="btn btn-primary btn-fill">
                                                <i class="fa fa-arrow-down"></i> Ubah Role Menjadi Tim
                                            </button>
                                        </a>';
    }
    else {
        echo '<a href="system/ubahrole_manajemen.php?id='.$data['id_user'].'" onclick="return confirm(\'Anda yakin akan merubah role menjadi Manajemen ?\')">
                                            <button type="button" name="input" rel="tooltip" class="btn btn-primary btn-fill">
                                                <i class="fa fa-arrow-up"></i> Ubah Role Menjadi Manajemen
                                            </button>
                                        </a>';
    }
                                    echo'
                                        <a href="" onclick="return confirm(\'Anda yakin akan merubah data?\')">
                                            <button type="submit" name="input" rel="tooltip" title="Konfirmasi" class="btn btn-primary btn-fill">
                                                <i class="fa fa-edit"></i> Konfirmasi
                                            </button>
                                        </a>';
    if( $email == $_SESSION['email'] ){
                                            echo'<button type="button" rel="tooltip" class="btn btn-danger btn-fill" disabled>
                                                <i class="fa fa-trash"></i> Hapus Profile
                                            </button>';
    }
    else{
                                            echo '<a href="system/hapus_user.php?id='.$data['id_user'].'" onclick="return confirm(\'Anda yakin akan menghapus data?\')">
                                                <button type="button" rel="tooltip" class="btn btn-danger btn-fill">
                                                    <i class="fa fa-trash"></i> Hapus Profile
                                                </button>
                                            </a>';
    }
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
