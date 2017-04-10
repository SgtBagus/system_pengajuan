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
    $query = "SELECT a.id_pengajuan, a.pengajuan, a.id_user, b.username, a.jenis_pengajuan, 
              a.tanggal_pengajuan, a.gambar, a.biaya, a.alasan, a.status, a.catatan, a.keterangan, 
              a.update_pengajuan, a.jadwal_pelaksanaan FROM pengajuan AS a 
              INNER JOIN user AS b WHERE  a.id_pengajuan ='$id' AND a.id_user = b.id_user ";
    $result = mysqli_query($link, $query);
    if(!$result){
      die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
    }
    $data = mysqli_fetch_assoc($result);
    $id_pengajuan = $data["id_pengajuan"];
    $pengajuan = $data["pengajuan"];
    $id_pengaju = $data["id_user"];
    $pengaju = $data["username"];
    $jenis_pengajuan = $data["jenis_pengajuan"];
    $taggal_pengajuan = $data["tanggal_pengajuan"];
    $gambar = $data["gambar"];
    $biaya = $data["biaya"];
    $alasan = $data["alasan"];
    $status = $data["status"];
    $keterangan = $data["keterangan"];
    $update = $data["update_pengajuan"];
    $pelaksanaan = $data["jadwal_pelaksanaan"];
  } 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Detail Pengajuan</title>
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
    $username = $data_login["username"];
?>
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( Manajemen ) - <?php echo $username ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index.php">
                        <i class="pe pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
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
                <li>
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
                                <h4 class="title"><b><?php echo $pengajuan ?></b> ( <?php echo $status ?> ) <small> Pengaju 
                                <?php
                                echo '<a href="detail_user.php?id='.$id_pengaju.'">
                                    <b>( '.$pengaju.' )</b> 
                                </a>';
                                ?>
                                </small></h4>
                            </div>
                            <div class="content">
                                <form id="form_pengajuan_diterima" method="post" action="system/pengajuan_diselesaikan.php">
                                    <input type="hidden" name="id_pengajuan" value="<?php echo $id_pengajuan ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <table>
                                                    <tr>
                                                        <td><h5><b>Pengajuan </h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5> <?php echo $pengajuan ?> </h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h5><b>Jenis Pengajuan </h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5> <?php echo $jenis_pengajuan ?> </h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h5><b>Tanggal Pengajuan </h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5> <?php echo date("d - m - Y", strtotime ($taggal_pengajuan ) )?> </h5></td>
                                                    </tr>
<?php
    if( $data['gambar'] == "" ){

    }
    else{
        echo '
                                                    <tr>
                                                        <td><h5><b>Gambar</h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5>';
?>
                                                         <img src='../image/<?php echo $gambar ?>' width='320' height='180'></h5>
<?php                                                        
                                                        echo '</td>
                                                    </tr>';
    }

?>                                                    
                                                    <tr>
                                                        <td><h5><b>Biaya</h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5>  Rp. <?php echo $biaya ?>,00,-</h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h5><b>Alasan</h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5>  <?php echo $alasan ?></h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h5><b>Keterangan</h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5> <?php echo $keterangan ?></h5></td>
                                                    </tr>
<?php
    if( $data['status'] == "menunggu" ){

    }
    else if ($data['status'] == "proses"){
        echo '
                                                    <tr>
                                                        <td><h5><b>Jadwal Pelaksanaan</h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5>'.$data['jadwal_pelaksanaan'].'</h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h5><b>Catatan</h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5>'.$data['catatan'].'</h5></td>
                                                    </tr>
        ';
    }else{
        echo '
                                                    <tr>
                                                        <td><h5><b>Catatan</h5></b></td>
                                                        <td><h5><b> : </h5></b></td>
                                                        <td><h5>'.$data['catatan'].'</h5></td>
                                                    </tr>
        ';
        
    }

?>
                                                    <tr>
                                                        <td><h5><b>Riwayat</h5></b></td>
                                                    </tr>
                                                </table>
                                                <table>
<?php
    $query2 = "SELECT * FROM riwayat WHERE id_pengajuan_kegiatan ='$id' ORDER BY kegiatan ASC" ;
      $result2 = mysqli_query($link, $query2);
      if(!$result2){
        die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
      }
      $no = 1;
      while($data2 = mysqli_fetch_assoc($result2)){
                                                    echo "<tr>";
                                                        echo "<td><b>$no </b></td>";
                                                        echo "<td> - </td>";
                                                        echo "<td> <b>$data2[kegiatan2] </b> </td>";
                                                        echo "<td> - </td>";
                                                        echo "<td><small> <b>$data2[tanggal_kegiatan]</b></small></td>";
                                                    echo "</tr>";
                                        $no++;
      }                                                      
?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div align="right">
                                    <a href="pengajuan.php">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-fill" title="kembali">
                                                    <i class="fa fa-arrow-left"></i> Kembali 
                                        </button>
                                    </a>
<?php
if( $data['status'] == "menunggu" ){
        echo '
                                                <a href="pengajuan_diterima.php?id='.$data['id_pengajuan'].'" onclick="return confirm(\'Anda yakin menerima pengajuan ?\')">
                                                    <button type="button" rel="tooltip" title="Terima Pengajuan" class="btn btn-primary btn-fill" >
                                                        <i class="fa fa-check"></i> Terima
                                                    </button>
                                                </a>
                                                <a href="pengajuan_ditolak.php?id='.$data['id_pengajuan'].'" onclick="return confirm(\'Anda yakin menolak pengajuan ?\')">
                                                    <button type="button" rel="tooltip" title="Tolak Pengajuan" class="btn btn-danger btn-fill">
                                                        <i class="fa fa-close"></i> Tolak
                                                    </button>
                                                </a>';
    }
    else if ($data['status'] == "proses"){
        echo '
                                                <a href="pengajuan_diubah.php?id='.$data['id_pengajuan'].'">
                                                    <button type="button" rel="tooltip" title="Ubah Jadwal" class="btn btn-primary btn-fill"  onclick="return confirm(\'Anda yakin merubah jadwal pengajuan ?\')">
                                                        <i class="fa fa-edit"></i> Ubah Jadwal Pelaksanaan
                                                    </button>
                                                </a>
                                                <a href="" onclick="return confirm(\'Anda yakin menyelesaikan pengajuan ?\')">
                                                    <button type="submit" name="input" rel="tooltip" title="Selesaikan Pengajuan" class="btn btn-primary btn-fill">
                                                        <i class="fa fa-check"></i> Selesaikan Pengajuan
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
