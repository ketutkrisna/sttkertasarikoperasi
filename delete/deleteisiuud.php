<?php 

	session_start();
	if(!isset($_SESSION['login'])){
		header("location:../index.php");
		exit;
	}
	require_once'../functions.php';
	if($_SESSION['login']=='admin'){

		if(isset($_POST['delidisi'])){

			$delidisi=htmlspecialchars($_POST['delidisi']);

			// $result=mysqli_query($conn,"DELETE FROM daftaruud WHERE id_uud=$iduud");
			$resultisi=mysqli_query($conn,"DELETE FROM daftarisiuud WHERE id_isi='$delidisi'");
			$notif=mysqli_affected_rows($conn);
			if($notif>0){
				$datanotif=['notif'=>'Data berhasil dihapus!'];
				echo json_encode($datanotif);
				return exit;
			}else{
				$datanotif=['notif'=>'Data gagal dihapus!'];
				echo json_encode($datanotif);
				return exit;
			}
			
		}else{
			header("location:../index.php");
			exit;
		}

	}else{
		header('location:../index.php');
		exit;
	}

?>