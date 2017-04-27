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
 
  if (isset($_GET['id'])) {
    $id = ($_GET["id"]);
    $query = "SELECT * FROM user WHERE id_user ='$id'";
    $result = mysqli_query($con, $query);
    if(!$result){
      die ("Query Error: ".mysqli_errno($con).
         " - ".mysqli_error($con));
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
    $pembuatan_akun = $data["pembuatan_akun"];
    $update_akun = $data["update_akun"];
  } 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Detail User</title>
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
    <div class="sidebar" data-color="green" data-image="assets/img/1.jpg">
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
    $username_login = $data_login["username"];
?>
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( Manajemen ) - <?php echo $username_login ?></small></small>
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
                            document.location="../logout";
                        }) 
                    }
                </script>

            </ul>
    	</div>
    </div>

<?php
if (isset($_GET['proses'])) {
    $proses = ($_GET["proses"]);
    if($proses == "edit"){
        echo'<script>
            swal("Terubah!", "Data User telah diubah !", "success")
        </script>';
  } 
}
?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Detail Profile <b>( <?php echo $username ?>)</b> </h4>
                                <small class="title">
                                    Pembuatan Akun : <b>( <?php echo $pembuatan_akun ?>)</b> 
                                    ||
                                    Update Terakhir Akun : <b>( <?php echo $update_akun ?>)</b> 
                                </small>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" disabled placeholder="Username" value="<?php echo $username ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" disabled placeholder="Email" value="<?php echo $email ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input type="password" name="password" class="form-control" disabled placeholder="password" value="<?php echo$password ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Pertama</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="<?php echo $namadepan ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Terakhir</label>
                                                <input type="text" class="form-control" disabled placeholder="Last Name" value="<?php echo $namabelakang ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <br>
                                    <?php 
                                     if( $jk == "laki-laki" )
                                        echo '<button disabled type="button" rel="tooltip" class="btn btn-info">
                                                    <i class="fa fa-male"></i> Laki laki 
                                                </button>';
                                     else 
                                        echo '<button disabled type="button" rel="tooltip" class="btn btn-info">
                                                    <i class="fa fa-female"></i> Perempuan
                                                </button>';
                                    ?>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" class="form-control"  disabled placeholder="Home Address" value="<?php echo $alamat?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <br>
                                    <?php 
                                     if( $role == "manajemen" )
                                        echo '<button disabled type="button" rel="tooltip" class="btn btn-primary">
                                                    <i class="fa fa-user"></i> Manajemen
                                                </button>';
                                     else 
                                        echo '<button disabled type="button" rel="tooltip" class="btn btn-primary">
                                                    <i class="fa fa-users"></i> Tim
                                                </button>';
                                    ?>        
                                            </div>
                                        </div>
                                    </div>
                                    <div align="right">
                                    <a href="user">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-fill">
                                                    <i class="fa fa-arrow-left"></i> Lihat Data Pengguna
                                        </button>
                                    </a>
<?php
                                    echo '<a href="edit_user?id='.$data['id_user'].'">
                                            <button type="button" rel="tooltip" class="btn btn-primary btn-fill">
                                                <i class="fa fa-edit"></i> Edit Profile
                                            </button>
                                        </a>';
if( $email == $_SESSION['email'] ){
                                            echo'<button type="button" rel="tooltip" class="btn btn-danger btn-fill" disabled>
                                                <i class="fa fa-trash"></i> Hapus Profile
                                            </button>';
    }
    else{
                                            echo' <button onclick="hapususer()"  type="button" rel="tooltip" class="btn btn-danger btn-fill ">
                                                <i class="fa fa-trash"></i> Hapus Profile
                                            </button>';
    echo '<script type="text/javascript">
            function hapususer() {
                swal({
                    title: "Konfirmasi ?",
                    text: "Apakah anda ingin menghapus pengguna",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF4A55",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                },
                function(){
                    document.location="system/hapus_user?id='.$id.'";
                })
            }
        </script>';
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
