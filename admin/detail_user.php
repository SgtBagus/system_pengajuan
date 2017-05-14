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

    function tanggal_indo($tanggal){
        $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
        );
        $split = explode('-', $tanggal);
        return $split[2] . ' - ' . $bulan[ (int)$split[1] ] . ' - ' . $split[0];
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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <link href="../assets/css/demo.css" rel="stylesheet" />
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
        $email_login = $data_login["email"];
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
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Profile <br> <small>Pembuatan Akun : <?php echo tanggal_indo($pembuatan_akun) ?> / Perubahan Terakhir : <?php echo tanggal_indo($update_akun) ?></small></h4>
                                </div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <input type="text" name="username" id="username" class="form-control" placeholder="username" value="<?php echo $username ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="Email">Email address</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="email" value="<?php echo $email ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="Email">Role</label>
                                                <input type="email" name="text" id="email" class="form-control" placeholder="email" value="<?php echo $role ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Depan</label>
                                                <input type="text" name="nama_depan" id="nama_depan" class="form-control" placeholder="Nama Depan" value="<?php echo $namadepan ?>" disabled>
                                            </div>
                                            </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Belakang</label>
                                                <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" placeholder="Nama Belakang" value="<?php echo $namabelakang ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" value="<?php echo $alamat ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>No. Hp</label>
                                                <input type="number" name="nohp" id="no_hp" class="form-control" placeholder="No Hp" value="<?php echo $nohp ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div align="right">
                                        <a href="user">
                                            <button type="button" class="btn btn-info  btn-fill">
                                                <i class="pe pe-7s-note2"></i> Data User 
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Pengaturan</h4>
                                </div>
                                <div class="content">
<?php
    if($email == $email_login){
?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" align="center">
                                                <label for="Username">Bio Data</label>
                                                <br>
                                                <a href="ubah_bio?id=<?php echo$id?>">
                                                    <button type="button" class="btn btn-primary col-md-12 btn-fill">
                                                        <i class="fa fa-info"></i> Ubah Bio Data
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"  align="center">
                                                <label for="Email">Email</label><br>
                                                <a href="ubah_email?id=<?php echo$id?>">
                                                    <button type="button" class="btn btn-primary col-md-12 btn-fill">
                                                        <i class="fa fa-info"></i> Ubah Email
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"  align="center">
                                                <label for="Password">Password</label><br>
                                                <a href="ubah_password?id=<?php echo$id?>">
                                                    <button type="button" class="btn btn-primary col-md-12 btn-fill">
                                                        <i class="fa fa-info"></i> Ubah Password
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                    <?php
                    }
                    else {
                        ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" align="center">
                                                <label for="Username">Ubah Role</label>
                                                <br>
                    <?php
                        if($role == "tim"){
                                                echo '<button onclick="ubahrole_manajemen('.$id.')" type="button" class="btn btn-primary col-md-12 btn-fill">
                                                    <i class="fa fa-arrow-up"></i> Ubah Role Menjadi Manajemen
                                                </button>';
                        }else if ($role == "manajemen"){
                                                echo '<button onclick="ubahrole_tim('.$id.')" type="button" class="btn btn-primary col-md-12 btn-fill">
                                                    <i class="fa fa-arrow-down"></i> Ubah Role Menjadi tim
                                                </button>';
                        }
                    ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"  align="center">
                                                <label for="Email">Hapus</label><br>
                    <?php
                                                echo '<button onclick="hapususer('.$id.')" type="button" class="btn btn-danger col-md-12 btn-fill">
                                                    <i class="fa fa-trash"></i> Hapus Pengguna
                                                </button>';
                    ?>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                    }
                    ?>
                                </div>
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
<?php
if (isset($_GET['proses'])) {
    echo '<script type="text/javascript">';
    $proses = ($_GET["proses"]);
    if($proses == "edit"){
            echo'swal({
                title: "Terubah!",
                text: "Profil telah diubah.",
                type: "success",
                showConfirmButton: true,
                confirmButtonColor: "#00ff00"
            })';
    }
    echo '</script>'; 
}
?>
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

        function ubahrole_manajemen(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin merubah role pengguna",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00ff00",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="system/ubahrole_manajemen?id="+id;
            })
        }

        function ubahrole_tim(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin merubah role pengguna",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00ff00",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="system/ubahrole_tim?id="+id;
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
