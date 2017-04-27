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
 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Master</title>
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

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
<?php
    $pencarian = ($_GET["cari"]);
    $query = "SELECT * FROM user WHERE username LIKE '%".$pencarian."%'";
    $result = mysqli_query($con, $query);

      $query_tim = "SELECT * FROM user WHERE ROLE = 'tim'" ;
      $result_tim = mysqli_query($con, $query_tim);

      $no = 1;
      $cek = count($result);
      $banyakdata = $result->num_rows;
?>
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Data Pengguna</h4>
                                        <small>Pencarian Username = <b>"<?php echo $pencarian ?>"</b> || data sebanyak <b>[ '<?php echo $banyakdata ?>' ]</b></small>
                                        <a href="user"><p class="category"><i class="fa fa-refresh"></i> Reset Data Pengguna</p></a>
                                    </div>  
                                </div>
                                <br>
                                <div class="row">
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                        <th>Username</th>
                                    	<th>Email</th>
                                        <th>Role</th>
                                    	<th>Action</th>
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
                                        	echo "<td>$data[username]</td>";
                                            echo "<td>$data[email]</td>";
                                            echo "<td>$data[role]</td>";
                                            echo '<td>
                                                <a href="detail_user?id='.$data['id_user'].'">
                                                    <button type="button" rel="tooltip" title="Lihat Detail" class="btn btn-info btn-sm btn-fill">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="edit_user?id='.$data['id_user'].'">
                                                    <button type="button" rel="tooltip" title="Ubah Data" class="btn btn-primary btn-sm btn-fill">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>';
    if( $data['id_user'] == $data_login['id_user'] ){
                                            echo'<button type="button" rel="tooltip" title="Hapus Data" class="btn btn-danger btn-sm btn-fill" disabled>
                                                        <i class="fa fa-trash"></i>
                                                    </button>';
    }
    else{
        if ($result_tim->num_rows == 1){
                                            echo'<button type="button" rel="tooltip" title="Hapus Data" class="btn btn-danger btn-sm btn-fill" disabled>
                                                    <i class="fa fa-trash"></i>
                                                </button>';
        }else{
                                            echo '<button onclick="hapususer()" type="button" rel="tooltip" title="Hapus Data" class="btn btn-danger btn-sm btn-fill">
                                                     <i class="fa fa-trash"></i>
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
                    document.location="system/hapus_user?id='.$data['id_user'].'";
                })
            }
        </script>';
        }
    }
                                            echo"</td>";
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
