<?php  

	session_start();
	if(!isset($_SESSION['login'])){
		header("location:../index.php");
	}
	require_once'../functions.php';
	if($_SESSION['login']=='admin'){
	$idsumbangan=$_GET['idsumbangan'];
	// $data=mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$idanggota'");
	// $fetch=mysqli_fetch_assoc($data);

	$result=mysqli_query($conn,"DELETE FROM sumbangan WHERE id_sumbangan=$idsumbangan");
	$notif=mysqli_affected_rows($conn);
		if($notif>0){
			echo"<script>
					alert('Data berhasil dihapus!!!');
					document.location.href='../sumbangan.php';
				</script>";
		}else{
			echo"<script>
					alert('Data gagal dihapus!!!');
					document.location.href='../sumbangan.php';
				</script>";
		}
	}else{
		header("location:../index.php");
	}

?>