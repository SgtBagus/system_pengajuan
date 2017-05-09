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
	<link rel="icon" type="image/png" href="../assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Pengajuan</title>
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
                    <li class="active">
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
                    <li>
                        <a data-toggle="collapse" href="#componentsExamples">
                            <i class="pe-7s-server"></i>
                            <p>Master</p>
                        </a>
                        <div class="collapse" id="componentsExamples">
                            <ul class="nav">
                                <li><a href="user">User</a></li>
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
    <?php
        $judul = ($_GET["judul"]);
        $tanggal_awal = ($_GET["tanggal_awal"]);
        $tanggal_akhir = ($_GET["tanggal_akhir"]);
        $first = date_create(($_GET["tanggal_awal"]));
        $lass = date_create(($_GET["tanggal_akhir"]));
        $awal = date_format($first,"Y-m-d");
        $akhir = date_format($lass,"Y-m-d");
        $status = ($_GET["status"]);
        
        $query = "SELECT a.id_pengajuan, a.pengajuan, a.id_user,  b.username, a.jenis_pengajuan, DATE_FORMAT(a.tanggal_pengajuan, '%d - %m - %Y') as tanggal_pengajuan, 
                a.biaya, a.status FROM pengajuan AS a INNER JOIN user AS b WHERE a.id_user = b.id_user 
                AND a.pengajuan LIKE '%".$judul."%' AND (a.tanggal_pengajuan BETWEEN '$awal' AND '$akhir')
                AND a.status like '%".$status."%' ORDER BY a.id_pengajuan DESC " ;
        $result = mysqli_query($con, $query);
        $no = 1;
        $cek = count($result);
        $banyakdata = $result->num_rows;

    if ($status == ""){
        $tampil = "semua";
    }else{
        $tampil = $status;
    }
    ?>
                            <div class="card">
                                <div class="header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="title">Pencarian Data Pengguna<br>
                                            <small>Judul : <b><?php echo '"'.$judul.'"' ?></b> - <small> Tgl <b><?php echo '"'.$tanggal_awal.'"' ?></b> s/d <b><?php echo '"'.$tanggal_akhir.'"' ?></b> - Status : <b><?php echo $tampil?></b></small></small></h4>
                                            <a href="pengajuan">
                                                <button type="button" class="btn btn-info btn-fill btn-sm btn-wd">
                                                    <i class="fa fa-refresh"></i> Reset Pencarian
                                                </button>
                                            </a>
                                        </div>  
                                    </div>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>Pengajuan</th>
                                            <th>Pengaju</th>
                                            <th>Jenis</th>
                                            <th>tanggal</th>
                                            <th>biaya</th>
                                            <th>status</th>
                                            <th>Tindak Lanjut</th>
                                        </thead>
                                        <tbody>

    <?php
        if($result->num_rows == 0){
                echo "<tr>
                    <td colspan='8' align='center'>Data Tidak Di temukan</td>
                </tr>";
        }
        else {
            while($data = mysqli_fetch_assoc($result))  
        {    
                
                                            echo '<tr>
                                                <td>'.$no.'</td>
                                                <td>'.$data['pengajuan'].'</td>
                                                <td>'.$data['username'].'</td>
                                                <td>'.$data['jenis_pengajuan'].'</td>
                                                <td>'.$data['tanggal_pengajuan'].'</td>
                                                <td>'.$data['biaya'].'</td>
                                                <td>'.$data['status'].'</td>
                                                <td>';
    if( $data['status'] == "menunggu" ){
                                            echo '<button onclick="pengajuanditerima('.$data['id_pengajuan'].')" type="button" class="btn btn-primary btn-fill btn-sm">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button onclick="pengajuanditolak('.$data['id_pengajuan'].')" type="button" class="btn btn-danger  btn-fill btn-sm">
                                                <i class="fa fa-close"></i>
                                            </button>';
    }
    else if ($data['status'] == "proses"){
                                            echo '<button onclick="pengajuandiubah('.$data['id_pengajuan'].')" type="button" class="btn btn-primary  btn-fill btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button onclick="pengajuandiselesaikan('.$data['id_pengajuan'].')" type="button" name="input" class="btn btn-primary  btn-fill btn-sm">
                                                <i class="fa fa-check"></i>
                                            </button>';
    }
                                            echo '<a href="detail_pengajuan?id='.$data['id_pengajuan'].'">
                                                <button type="button" class="btn btn-info btn-fill btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>';
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

        function pengajuanditerima(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin menerima pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00ff00",
                confirmButtonText: "Terima",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="pengajuan_diterima?id="+id;
            })
        }

        function pengajuanditolak(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin menolak pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00cc00",
                confirmButtonText: "Tolak",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="pengajuan_ditolak?id="+id;
            })
        }

        function pengajuandiubah(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin mengubah jadwal pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00ff00",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="pengajuan_diubah?id="+id;
            })
        }

        function pengajuandiselesaikan(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin menyelesaikan pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00ff00",
                confirmButtonText: "Selesaikan",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="system/proses_pengajuan_diselesaikan?id="+id;
            })
        }
	</script>
</html>
