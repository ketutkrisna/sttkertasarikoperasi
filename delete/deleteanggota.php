<?php  

	session_start();
	if(!isset($_SESSION['login'])){
		header("location:../index.php");
		exit;
	}
	require_once'../functions.php';
	if($_SESSION['login']=='admin'){
		$idanggota=htmlspecialchars($_GET['id_anggota']);
		$confirmasi=mysqli_query($conn,"SELECT id_anggota,sum(jumlah_pinjaman)as confirm FROM anggota join pinjaman USING (id_anggota) WHERE id_anggota='$idanggota'");
		$fetconfirm=mysqli_fetch_assoc($confirmasi)['confirm'];

		$confirmasidenda=mysqli_query($conn,"SELECT id_anggota,sum(jumlah_denda)as confirm FROM anggota join denda USING (id_anggota) WHERE id_anggota='$idanggota'");
		$fetconfirmdenda=mysqli_fetch_assoc($confirmasidenda)['confirm'];
		
		if($fetconfirm>0||$fetconfirmdenda>0){
			// echo"<script>
			// 			alert('Hapus terlebih dahulu data pinjaman/denda dari anggota ini!');
			// 			document.location.href='../detail.php?id_anggota=".$idanggota."';
			// 		</script>";
			$datanotif=['notif'=>'Hapus terlebih dahulu data pinjaman/denda dari anggota ini!'];
			echo json_encode($datanotif);
			return exit;
		}else{

		$data=mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$idanggota'");
		$fetch=mysqli_fetch_assoc($data);

		$result=mysqli_query($conn,"DELETE FROM anggota WHERE id_anggota='$idanggota'");
		$notif=mysqli_affected_rows($conn);
			if($notif>0){
				if($fetch['foto_anggota'] != 'default.jpg'){
					unlink("../img/anggota/".$fetch['foto_anggota']);
				}
				// echo"<script>
				// 		alert('Data berhasil dihapus!');
				// 		document.location.href='../anggota.php';
				// 	</script>";
				// 	exit;
				$datanotif=['notif'=>'Data berhasil dihapus!'];
				echo json_encode($datanotif);
				return exit;
			}else{
				// echo"<script>
				// 		alert('Data gagal dihapus!');
				// 		document.location.href='../detail.php?id_anggota=".$idanggota."';
				// 	</script>";
				$datanotif=['notif'=>'Data gagal dihapus!'];
				echo json_encode($datanotif);
				return exit;
			}
		}
		}else{
			header("location:../index.php");
			exit;
		}

?>