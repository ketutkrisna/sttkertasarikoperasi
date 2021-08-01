<?php 

	session_start();
	if(!isset($_SESSION['login'])){
		header("location:../index.php");
		exit;
	}
	require_once'../functions.php';
	if($_SESSION['login']=='admin'){
		
		$iduud=htmlspecialchars($_GET['iduud']);
		$idisiuud=mysqli_query($conn,"SELECT count(*)as count FROM daftarisiuud WHERE id_uud='$iduud'");
		$fetidisiuud=mysqli_fetch_assoc($idisiuud)['count'];

		// var_dump($fetidisiuud==0);die;

		if($fetidisiuud>0){

			$result=mysqli_query($conn,"DELETE FROM daftaruud WHERE id_uud=$iduud");
			$resultisi=mysqli_query($conn,"DELETE FROM daftarisiuud WHERE id_uud=$iduud");
			$notif=mysqli_affected_rows($conn);
			if($notif>0){
				echo"<script>
						alert('Data berhasil dihapus!!!');
						document.location.href='../index.php';
					</script>";
					exit;
			}else{
				echo"<script>
						alert('Data gagal dihapus!!!');
						document.location.href='../index.php';
					</script>";
					exit;
			}

		}else{

			$result=mysqli_query($conn,"DELETE FROM daftaruud WHERE id_uud=$iduud");
			$notif=mysqli_affected_rows($conn);
			if($notif>0){
				echo"<script>
						alert('Data berhasil dihapus!!!');
						document.location.href='../index.php';
					</script>";
					exit;
			}else{
				echo"<script>
						alert('Data gagal dihapus!!!');
						document.location.href='../index.php';
					</script>";
					exit;
			}

		}
	}else{
		header("location:../index.php");
		exit;
	}

?>