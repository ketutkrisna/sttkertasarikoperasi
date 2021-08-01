<?php  

	session_start();
	if(!isset($_SESSION['login'])){
		header("location:../index.php");
	}
	require_once'../functions.php';
	if($_SESSION['login']=='admin'){
	$idpembayaran=$_GET['idpembayaran'];
	$idpinjaman=$_GET['idpinjaman'];
	
	mysqli_query($conn,"UPDATE pinjaman SET status_pinjaman='belum lunas' WHERE id_pinjaman='$idpinjaman'");
	$result=mysqli_query($conn,"DELETE FROM pembayaran WHERE id_pembayaran=$idpembayaran");
	$notif=mysqli_affected_rows($conn);
		if($notif>0){
			echo"<script>
					alert('Data berhasil dihapus!!!');
					document.location.href='../detailpinjaman.php?idpinjaman=".$idpinjaman."';
				</script>";
		}else{
			echo"<script>
					alert('Data gagal dihapus!!!');
					document.location.href='../detailpinjaman.php?idpinjaman=".$idpinjaman."';
				</script>";
		}
	}else{
		header("location:../index.php");
	}

?>