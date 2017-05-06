<?php
  include 'system/koneksi.php';


session_start();
 $logged_in = false;
 if (empty($_SESSION['email'])) {
    echo "<script type='text/javascript'>document.location='login?proses=error ';</script>";
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

  <link rel="stylesheet" href="assets/dist/sweetalert.css">
  <script src="assets/dist/sweetalert-dev.js"></script>
</head>
<body>

<?php
if (isset($_GET['proses'])) {
    $proses = ($_GET["proses"]);
    if($proses == "edit"){
        echo'<script>
            swal("Terubah!", "Profil anda telah diubah !", "success")
        </script>';
  } 
}
?>
<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar.jpg">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index" class="simple-text">
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( TIM ) - <?php echo $username ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index">
                        <i class="pe pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li>
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
               AND b.id_user = '$id' AND a.notifikasi= '1' ";
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
                <li class="active">
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
                            confirmButtonColor: "#00cc00", 
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
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Profile</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <input type="hidden" name="id_pengajuan" value="<?php echo $id_pengajuan ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="content table-responsive table-full-width">
                                                    <table>
                                                        <thead>
                                                            <th width="150px"></th>
                                                            <th width="25px"></th>
                                                            <th></th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><h5><b>Username</h5></b></td>
                                                                <td><h5><b>:</h5></b></td>
                                                                <td><h5><?php echo $username ?></h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h5><b>Email</h5></b></td>
                                                                <td><h5><b>:</h5></b></td>
                                                                <td><h5><?php echo $email ?></h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h5><b>Nama depan</h5></b></td>
                                                                <td><h5><b>:</h5></b></td>
                                                                <td><h5><?php echo $namadepan ?></h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h5><b>Nama belakang</h5></b></td>
                                                                <td><h5><b>:</h5></b></td>
                                                                <td><h5><?php echo $namabelakang ?></h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h5><b>Jenis Kelamin</h5></b></td>
                                                                <td><h5><b>:</h5></b></td>
                                                                <td><h5><?php echo $jk ?></h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h5><b>Alamat</h5></b></td>
                                                                <td><h5><b>:</h5></b></td>
                                                                <td><h5><?php echo $alamat ?></h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h5><b>No HP</h5></b></td>
                                                                <td><h5><b>:</h5></b></td>
                                                                <td><h5><?php echo $nohp ?></h5></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h5><b>Role</h5></b></td>
                                                                <td><h5><b>:</h5></b></td>
                                                                <td><h5><?php echo $role ?></h5></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div align="right">
                                                    <a href="user">
                                                        <button type="button" rel="tooltip" class="btn btn-info btn-fill">
                                                                    <i class="fa fa-arrow-left"></i> Lihat Data Pengguna
                                                        </button>
                                                    </a>
                                                        <button onclick="editprofil()" type="button" rel="tooltip" class="btn btn-primary btn-fill">
                                                            <i class="fa fa-edit"></i> Edit Profile
                                                        </button>
                                                <script type="text/javascript">
                                                    function editprofil() {
                                                        swal({
                                                            title: "Konfirmasi ?",
                                                            text: "Apakah anda ingin menghapus pengguna",
                                                            type: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#00ff00",
                                                            confirmButtonText: "Iya",
                                                            cancelButtonText: "Batal",
                                                            closeOnConfirm: false
                                                        },
                                                        function(){
                                                            document.location="edit_profil";
                                                        })
                                                    }       
                                                </script>
                                            </div>
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
