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
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Pengajuan</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <link href="assets/css/demo.css" rel="stylesheet" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/dist/sweetalert.css">
</head>
<body>
    <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="assets/img/sidebar.jpg">
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
        $id_login = $data_login["id_user"];
        $username_login = $data_login["username"];
    ?>
                        Pengajuan Pengadaaan <small>Barang & Training <br> <small>( TIM ) - <?php echo $username_login ?></small></small>
                    </a>
                </div>

                <ul class="nav">
                    <li >
                        <a href="index">
                            <i class="pe pe-7s-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="active">
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
                AND b.id_user = '$id_login' AND a.notifikasi= '1' ";
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
                    <li>
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
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
    <?php
        $judul = ($_GET["pengajuan"]);
        $tanggal = ($_GET["tanggal"]);
            if ($tanggal == ""){
                $tgl = $tanggal;
            }else{
                $date = date_create(($_GET["tanggal"]));
                $tgl = date_format($date,"Y-m-d");        
            }
        $status = ($_GET["status"]);
        $query = "SELECT a.id_pengajuan, a.pengajuan, a.id_user,  b.username, a.jenis_pengajuan, DATE_FORMAT(a.tanggal_pengajuan, '%d - %m - %Y') as tanggal_pengajuan,
                a.biaya, a.status FROM pengajuan AS a INNER JOIN user AS b WHERE a.id_user = b.id_user 
                AND b.username like '$username_login' AND a.pengajuan LIKE '%".$judul."%' AND a.tanggal_pengajuan like '%".$tgl."%' 
                AND a.status like '%".$status."%' ORDER BY a.pengajuan ASC " ;  
        $result = mysqli_query($con, $query);
        $no = 1;
        $cek = count($result);
        $banyakdata = $result->num_rows;
    if ($status == ""){
        $semua = "semua";
    }else{
        $semua = $status;
    }
    ?>
                            <div class="card">
                                <div class="header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="title">Data Pengguna</h4>
                                            <br>
                                            <div class="card">
                                                <div class="content">
                                                    <h4 class="title">Pencarian</h4>
                                                    <h5>Judul pengajuan : 
                                                    <?php 
                                                        if ($judul == ""){
                                                            echo "<small>*semua judul pengajuan</small>";
                                                        }else{
                                                            echo "<b> $judul </b>";
                                                        }
                                                        ?><br></h5>
                                                        <small> Tanggal : 
                                                        <?php 
                                                        if ($tanggal == ""){
                                                            echo "<b>*semua tanggal pengajuan</b>";
                                                        }else{
                                                            echo "<b> $tanggal </b>";
                                                        }
                                                    ?>
                                                    </b> - Status : <b><?php echo $semua ?></b></small><br>
                                                    <div align="right">
                                                        <a href="pengajuan">
                                                            <button type="button" class="btn btn-info btn-fill btn-sm btn-wd">
                                                                <i class="fa fa-refresh"></i> Reset Pencarian
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <br>
                                    <div class="row">
                                </div>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>Pengajuan</th>
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
                    <td>Data Tidak Di temukan</td>
                </tr>";
        }
        else {
            while($data = mysqli_fetch_array($result)){
                                            echo '<tr>
                                                <td>'.$no.'</td>
                                                <td>'.$data['pengajuan'].'</td>
                                                <td>'.$data['jenis_pengajuan'].'</td>
                                                <td>'.$data['tanggal_pengajuan'].'</td>
                                                <td>'.$data['biaya'].'</td>

                                                <td align = "center">';
    if( $data['status'] == "proses" ){
                                                echo '<span class="badge proses upper">'.$data['status'].'</span>';
    }else{
                                                echo '<span class="badge  upper">'.$data['status'].'</span>';
    }
                                                echo '</td>
                                                <td align="center">';
    if( $data['status'] == "menunggu" ){
                                            echo '<button onclick="edit('.$data['id_pengajuan'].')" type="button" class="btn btn-primary btn-fill btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="detail_pengajuan?id='.$data['id_pengajuan'].'">
                                                <button type="button" class="btn btn-info btn-fill btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            <button onclick="batal('.$data['id_pengajuan'].')" type="button" class="btn btn-danger  btn-fill btn-sm">
                                                <i class="fa fa-close"></i>
                                            </button>';
    }
    else if ($data['status'] == "proses"){
                                            echo '<a href="detail_pengajuan?id='.$data['id_pengajuan'].'">
                                                <button type="button" class="btn btn-info btn-fill btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>';
    }
    else if ($data['status'] == "selesai"){
                                            echo '<a href="detail_pengajuan?id='.$data['id_pengajuan'].'">
                                                <button type="button" class="btn btn-info btn-fill btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            <button onclick="hapus('.$data['id_pengajuan'].')" type="button" class="btn btn-danger  btn-fill btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>';
    }
                                       echo '</td>
                                    </tr>';
    $no++;
        }
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
    <script src="assets/dist/sweetalert-dev.js"></script>
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>
	<script src="assets/js/chartist.min.js"></script>
    <script src="assets/js/bootstrap-notify.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
	<script src="assets/js/demo.js"></script>
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
                document.location="logout";
            })
        }

        function edit(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin mengubah pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00ff00",
                confirmButtonText: "Terima",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="edit_pengajuan?id="+id;
            })
        }

        function batal(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin membatalkan pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00cc00",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="system/hapus_pengajuan?id="+id;
            })
        }

        function hapus(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin menghapus pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00cc00",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="system/hapus_pengajuan?id="+id;
            })
        }
	</script>

</html>
