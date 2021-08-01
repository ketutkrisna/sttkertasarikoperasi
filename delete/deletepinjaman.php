<?php  

	session_start();
	if(!isset($_SESSION['login'])){
		header("location:../index.php");
	}
	require_once'../functions.php';
	if($_SESSION['login']=='admin'){
		$idpinjaman=htmlspecialchars($_GET['idpinjaman']);
		$data=mysqli_query($conn,"SELECT sum(jumlah_pembayaran)as totalsum from pinjaman join pembayaran using (id_pinjaman) where id_pinjaman=$idpinjaman");
		$fetch=mysqli_fetch_assoc($data);

		$databunga=mysqli_query($conn,"SELECT sum(jumlah_bunga)as totalbunga from pinjaman join bungapinjaman using (id_pinjaman) where id_pinjaman=$idpinjaman");
		$fetchbunga=mysqli_fetch_assoc($databunga);
		// var_dump($fetch);die;

		if($fetch['totalsum'] > 0||$fetchbunga['totalbunga'] > 0){
			echo "<script>
					alert('Hapus terlebih dahulu rincian pembayaran pinjaman/bunga!');
					document.location.href='../detailpinjaman.php?idpinjaman=".$idpinjaman."';
				</script>";	
		}else{
			mysqli_query($conn,"DELETE FROM pinjaman WHERE id_pinjaman=$idpinjaman");
			echo "<script>
					alert('success');
					document.location.href='../pinjaman.php';
				</script>";	
		}
	}else{
		header("location:../index.php");
	}

?>