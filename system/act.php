<?php
session_start();
include "koneksi.php";
$email=$_POST['email'];
$password=$_POST['password'];
$hash=md5($password);
$op=$_GET['op'];
if($op=="in"){
	$sql=mysqli_query( $con, "SELECT * FROM user WHERE email='$email' AND password = '$hash'");
	if(mysqli_num_rows($sql)==1){
		$qry = mysqli_fetch_array($sql);
		$_SESSION['email'] = $qry['email'];
		$_SESSION['role'] = $qry['role'];
		if($qry['role']=="manajemen"){
			header("location:../admin/index.php");
		}
		else if($qry['role']=="tim"){
			header("location:../index.php");
		}
	}else{
		?>
		<script lenguage="JavaScript">
		alert(Email atau Password Salah silahkan di ulang);
		document.location='../login.php';
		</script>
		<?php
	}

}else if($op=="out"){
	unset($_SESSION['email']);
	unset($_SESSION['role']);
	header("location:../login.php");

}	
    echo "<script type='text/javascript'>alert('Email atau Password Salah'); document.location='../login.php';</script>";
?>