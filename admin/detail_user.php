<?php
    include '../system/koneksi.php';
    session_start();
    $logged_in = false;
    if (empty($_SESSION['email'])) {
        echo "<script type='text/javascript'>document.location='../login?proses=error ';</script>";
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
        $pembuatan_akun = date('d-m-Y', strtotime ($data["pembuatan_akun"]));
        $update_akun = date('d-m-Y', strtotime ($data["update_akun"]));
    } 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>User</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/dist/sweetalert.css">
</head>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="../assets/img/sidebar.jpg">
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
                    <a data-toggle="collapse" href="#componentsExamples" aria-expanded="true">
                        <i class="pe-7s-server"></i>
                        <p>Master</p>
                    </a>
                    <div class="collapse in" id="componentsExamples">
                        <ul class="nav">
                            <li class="active"><a href="user">User</a></li>
                            <li><a href="jenis_pengajuan">Jenis Pengajuan</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" onclick = "logout()">
                        <i class="pe pe-7s-back"></i>
                        <p>Log out</p>
                    </a>
                </li>
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
                                    Pembuatan Akun : <b>( <?php echo $pembuatan_akun ?> )</b> 
                                    ||
                                    Update Terakhir Akun : <b>( <?php echo $update_akun ?> )</b> 
                                </small>
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
<?php
                                    echo '<a>
                                            <button onclick="editprofil('.$id.')" type="button" rel="tooltip" class="btn btn-primary btn-fill">
                                                <i class="fa fa-edit"></i> Edit Profile
                                            </button>
                                    </a>';
if( $email == $_SESSION['email'] ){
                                            echo'<button type="button" rel="tooltip" class="btn btn-danger btn-fill" disabled>
                                                <i class="fa fa-trash"></i> Hapus Profile
                                            </button>';
    }
    else{
                                            echo' <button onclick="hapususer('.$id.')"  type="button" rel="tooltip" class="btn btn-danger btn-fill ">
                                                <i class="fa fa-trash"></i> Hapus Profile
                                            </button>';
    }
                                        
?>
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
    <script src="../assets/dist/sweetalert-dev.js"></script>
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>
	<script src="../assets/js/chartist.min.js"></script>
    <script src="../assets/js/bootstrap-notify.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="../assets/js/light-bootstrap-dashboard.js"></script>
	<script src="../assets/js/demo.js"></script>
	<script type="text/javascript">
    	$(document).ready(function(){
        	demo.initChartist();
    	});
        
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
                document.location="../logout";
            }) 
        }

        function editprofil(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin mengubah pengguna",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00ff00",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="edit_user?id="+id;
            })
        }   

        function hapususer(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin menghapus pengguna",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00cc00",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="system/hapus_user?id="+id;
            })
        }
	</script>
</html>
