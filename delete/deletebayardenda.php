<?php  

	session_start();
	if(!isset($_SESSION['login'])){
		header("location:../index.php");
	}
	require_once'../functions.php';
	if($_SESSION['login']=='admin'){
		$idbayardenda=$_GET['idbayardenda'];
		$iddenda=$_GET['iddenda'];
		
		$result=mysqli_query($conn,"DELETE FROM bayardenda WHERE id_bayardenda=$idbayardenda");
		$notif=mysqli_affected_rows($conn);
			if($notif>0){
				mysqli_query($conn,"UPDATE denda SET status_denda='belum bayar' WHERE id_denda='$iddenda'");
				echo"<script>
						alert('Data berhasil dihapus!!!');
						document.location.href='../detaildenda.php?iddenda=".$iddenda."';
					</script>";
			}else{
				echo"<script>
						alert('Data gagal dihapus!!!');
						document.location.href='../detaildenda.php?iddenda=".$iddenda."';
					</script>";
			}
	}else{
		header("location:../index.php");
	}

?>