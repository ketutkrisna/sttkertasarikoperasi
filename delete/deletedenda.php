<?php  

	session_start();
	if(!isset($_SESSION['login'])){
		header("location:../index.php");
	}
	require_once'../functions.php';
	if($_SESSION['login']=='admin'){
		$iddenda=$_GET['iddenda'];
		$data=mysqli_query($conn,"SELECT sum(jumlah_bayardenda)as totalsum from denda join bayardenda using (id_denda) where id_denda=$iddenda");
		$fetch=mysqli_fetch_assoc($data);
		// var_dump($fetch);die;

		if($fetch['totalsum'] > 0){
			echo "<script>
					alert('Hapus terlebih dahulu detail pembayaran!!!');
					document.location.href='../detaildenda.php?iddenda=".$iddenda."';
				</script>";	
		}else{
			mysqli_query($conn,"DELETE FROM denda WHERE id_denda=$iddenda");
			echo "<script>
					alert('success');
					document.location.href='../denda.php';
				</script>";	
		}
	}else{
		header("location:../index.php");
	}

?>