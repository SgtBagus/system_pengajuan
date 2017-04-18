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
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Master - User</title>
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
                
                <li  class="active">
                    <a data-toggle="collapse" href="#componentsExamples">
                        <i class="pe pe-7s-server"></i>
                        <p>Master </p>
                    </a>
                    <div class="collapse in" id="componentsExamples">
                        <ul class="nav">
                            <li  class="active"><a href="user"> User </a></li>
                            <li><a href="jenis_pengajuan"> Jenis Pengajuan </a></li>
                        </ul>
                    </div>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Data Pengguna</h4>
                                        <a href="master"><p class="category"><i class="fa fa-arrow-left"></i> Klik di sini untuk kembali ke menu Master</p></a>
                                    </div>  
                                    <div class="col-md-6" align="right">
                                        <a href="tambah_user">
                                            <button type="button" rel="tooltip" class="btn btn-info">
                                                <i class="fa fa-plus"></i> Tambah Pengguna
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <form id="form_pencarian"  action="pencarian_user" method="get">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" name="cari" id="cari" class="form-control" placeholder="Pencarian..." >
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <button type="submit" rel="tooltip" class="btn btn-primary btn-fill">
                                                    <i class="fa fa-search"></i> Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>Username</th>
                                    	<th>Email</th>
                                        <th>Role</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>

<?php
      $query = "SELECT * FROM user ORDER BY id_user" ;
      $result = mysqli_query($con, $query);
      if(!$result){
        die ("Query Error: ".mysqli_errno($con).
           " - ".mysqli_error($con));
      }
      $no = 1;
      while($data = mysqli_fetch_assoc($result))
      {
                                        echo "<tr>";
                                            echo "<td>$no</td>";
                                        	echo "<td>$data[username]</td>";
                                            echo "<td>$data[email]</td>";
                                            echo "<td>$data[role]</td>";
                                            echo '<td>
                                                <a href="detail_user?id='.$data['id_user'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="edit_user?id='.$data['id_user'].'">
                                                    <button type="button" rel="tooltip" title="Ubah Pengguna" class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>';
    if( $data['email'] == $_SESSION['email'] ){
                                            echo'<button type="button" title="Hapus Data" class="btn btn-danger" disabled>
                                                        <i class="fa fa-trash"></i>
                                                    </button>';
    }
    else{
                                            echo '<a href="system/hapus_user?id='.$data['id_user'].'" onclick="return confirm(\'Anda yakin akan menghapus data pengguna?\')">
                                                    <button type="button" rel="tooltip" title="Hapus Data" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </a>';
    }
                                            echo '</td>';
                                        echo "</tr>";
                                        $no++;
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
