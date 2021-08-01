<?php  

	$conn=mysqli_connect('localhost','root','','sttkertasarikoperasi');

	function tahun(){
		$tahun=date("Y");
		return "<b>Copyright &copy;: stt kertasari ".$tahun."</b>";
	}

	function pindahhalaman(){
		echo"<script>
	          alert('Silahkan login dahulu!');
	          document.location.href='login.php';
	        </script>";
		exit;
	}

	function sidebar(){
		return "z-index: 9999999999;";
	}

	function downbar(){
		return '<div class="online bg-white" style="position: fixed;bottom: 0;right:0;z-index: 999999999;width: 100%;height: 29px;margin-right:;border-radius:3px;">
        	<span></span>
  		</div>';
	}

	function uptop(){
		return 'z-index: 9999999999999999999;';
	}

	function counter(){
		global $conn;
	    $counter=mysqli_query($conn,"SELECT count(id_pinjaman)as counter FROM pinjaman WHERE status_pinjaman='belum lunas'");
	    $fetcounter=mysqli_fetch_assoc($counter)['counter'];
	    return $fetcounter;
	}

	function counterdenda(){
		global $conn;
	    $counter=mysqli_query($conn,"SELECT count(id_denda)as counter FROM denda WHERE status_denda='belum bayar'");
	    $fetcounter=mysqli_fetch_assoc($counter)['counter'];
	    return $fetcounter;
	}

	function anggota($data){
		global $conn;
		$result=mysqli_query($conn,$data);
		return $result;
	}

	function get_anggota($data){
		global $conn;
		$result=mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota=$data");
		$fetch=mysqli_fetch_assoc($result);
		return $fetch;
	}

	function get_denda($data){
		global $conn;
		$result=mysqli_query($conn,"SELECT * FROM denda WHERE id_denda=$data");
		$fetch=mysqli_fetch_assoc($result);
		return $fetch;
	}

	function getpemasukan($data){
		global $conn;
		$result=mysqli_query($conn,$data);
		return $result;
	}

	function tambahdatapemasukan($data){
		global $conn;
		$keteranganpemasukan=htmlspecialchars($data['keteranganpemasukan']);
		$tanggalpemasukan=htmlspecialchars($data['tanggalpemasukan']);
		$jumlahpemasukan=htmlspecialchars($data['jumlahpemasukan']);

		$result=mysqli_query($conn,"INSERT INTO pemasukan VALUES(NULL,'$keteranganpemasukan','$tanggalpemasukan','$jumlahpemasukan')");

		$notif=mysqli_affected_rows($conn);
	    if($notif>0){
	      echo"<script>
	          alert('Data berhasil ditambah!!!');
	          document.location.href='pemasukan.php';
	        </script>";
	    }else{
	      echo"<script>
	          alert('Data gagal ditambah!!!');
	          document.location.href='pemasukan.php';
	        </script>";
	    }
	}

	function getpengeluaran($data){
		global $conn;
		$result=mysqli_query($conn,$data);
		return $result;
	}

	function tambahdatapengeluaran($data){
		global $conn;
		// global saldo();
		$keteranganpengeluaran=htmlspecialchars($data['keteranganpengeluaran']);
		$tanggalpengeluaran=htmlspecialchars($data['tanggalpengeluaran']);
		$jumlahpengeluaran=htmlspecialchars($data['jumlahpengeluaran']);
		$saldo=saldo();

		if($jumlahpengeluaran>$saldo){
			echo"<script>
	          alert('Saldo kurang!!!');
	          document.location.href='pengeluaran.php';
	        </script>";
		}else{
			$result=mysqli_query($conn,"INSERT INTO pengeluaran VALUES(NULL,'$keteranganpengeluaran','$tanggalpengeluaran','$jumlahpengeluaran')");

			$notif=mysqli_affected_rows($conn);
		    if($notif>0){
		      echo"<script>
		          alert('Data berhasil ditambah!!!');
		          document.location.href='pengeluaran.php';
		        </script>";
		    }else{
		      echo"<script>
		          alert('Data gagal ditambah!!!');
		          document.location.href='pengeluaran.php';
		        </script>";
		    }
		}
	}

	function tambahdatapinjaman($data){
		global $conn;
		$namapinjaman=htmlspecialchars($data['namapinjaman']);
		$tanggalpinjaman=htmlspecialchars($data['tanggalpinjaman']);
		$jumlahpinjaman=htmlspecialchars($data['jumlahpinjaman']);
		$saldo=saldo();

		if($jumlahpinjaman>$saldo){
			echo"<script>
		          alert('Saldo kurang!!!');
		          document.location.href='pinjaman.php';
		        </script>";
		}else{
			$result=mysqli_query($conn,"INSERT INTO pinjaman VALUES(NULL,'$namapinjaman','$tanggalpinjaman','$jumlahpinjaman','belum lunas')");

			$notif=mysqli_affected_rows($conn);
		    if($notif>0){
		      echo"<script>
		          alert('Data berhasil ditambah!!!');
		          document.location.href='pinjaman.php';
		        </script>";
		    }else{
		      echo"<script>
		          alert('Data gagal ditambah!!!');
		          document.location.href='pinjaman.php';
		        </script>";
		    }
		}
	}

	function tambahdatabayar($data,$jumlahp=0,$jumlaht=0){
		global $conn;
		$idpinjam=htmlspecialchars($data['idpinjam']);
		$tanggalbayar=htmlspecialchars($data['tanggalbayar']);
		$jumlahbayar=htmlspecialchars($data['jumlahbayar']);
		// $statusbayar=htmlspecialchars($data['statusbayar']);

		
		if($jumlaht+$jumlahbayar > $jumlahp){
			echo"<script>
	          alert('Jumlah bayar terlalu besar');
	          document.location.href='detailpinjaman.php?idpinjaman=".$idpinjam."';
	        </script>";
			return false;
		}else if($jumlahp==$jumlaht+$jumlahbayar){
			$status='lunas';
		}else{
			$status='belum lunas';
		}
		$result=mysqli_query($conn,"INSERT INTO pembayaran VALUES(NULL,'$idpinjam','$tanggalbayar','$jumlahbayar')");

		$notif=mysqli_affected_rows($conn);
	    if($notif>0){
	    	$resultpinjam=mysqli_query($conn,"UPDATE pinjaman SET status_pinjaman='$status' WHERE id_pinjaman=$idpinjam");
	      echo"<script>
	          alert('Data berhasil ditambah!!!');
	          document.location.href='detailpinjaman.php?idpinjaman=".$idpinjam."';
	        </script>";
	    }else{
	      echo"<script>
	          alert('Data gagal ditambah!!!');
	          document.location.href='detailpinjaman.php?idpinjaman=".$idpinjam."';
	        </script>";
	    }
	}

	function tambahdatabunga($data){
		global $conn;
		$idpinjamanbunga=htmlspecialchars($data['idpinjamanbunga']);
		$tanggalbunga=htmlspecialchars($data['tanggalbunga']);
		$jumlahbunga=htmlspecialchars($data['jumlahbunga']);

		$result=mysqli_query($conn,"INSERT INTO bungapinjaman VALUES(NULL,'$idpinjamanbunga','$tanggalbunga','$jumlahbunga')");

		$notif=mysqli_affected_rows($conn);
	    if($notif>0){
	      echo"<script>
	          alert('success!');
	          document.location.href='detailpinjaman.php?idpinjaman=".$idpinjamanbunga."';
	        </script>";
	    }else{
	      echo"<script>
	          alert('failed!');
	          document.location.href='detailpinjaman.php?idpinjaman=".$idpinjamanbunga."';
	        </script>";
	    }
	}

	function tambahdatabayardenda($data,$jumlahdenda,$jumlahterbayar){
		global $conn;
		$iddenda=htmlspecialchars($data['iddenda']);
		$tanggalbayardenda=htmlspecialchars($data['tanggalbayardenda']);
		$jumlahbayardenda=htmlspecialchars($data['jumlahbayardenda']);
		// $statusbayar=htmlspecialchars($data['statusbayar']);

		
		if($jumlahterbayar+$jumlahbayardenda > $jumlahdenda){
			echo"<script>
	          alert('Jumlah bayar terlalu besar');
	          document.location.href='detaildenda.php?iddenda=".$iddenda."';
	        </script>";
			return false;
		}else if($jumlahdenda==$jumlahterbayar+$jumlahbayardenda){
			$status='lunas';
		}else{
			$status='belum bayar';
		}
		$result=mysqli_query($conn,"INSERT INTO bayardenda VALUES(NULL,'$iddenda','$tanggalbayardenda','$jumlahbayardenda')");

		$notif=mysqli_affected_rows($conn);
	    if($notif>0){
	    	$resultpinjam=mysqli_query($conn,"UPDATE denda SET status_denda='$status' WHERE id_denda=$iddenda");
	      echo"<script>
	          alert('Data berhasil ditambah!!!');
	          document.location.href='detaildenda.php?iddenda=".$iddenda."';
	        </script>";
	    }else{
	      echo"<script>
	          alert('Data gagal ditambah!!!');
	          document.location.href='detaildenda.php?iddenda=".$iddenda."';
	        </script>";
	    }
	}

	function tambahdatadenda($data){
		global $conn;
		$idanggotadenda=htmlspecialchars($data['idanggotadenda']);
		$keterangandenda=htmlspecialchars($data['keterangandenda']);
		$tanggaldenda=htmlspecialchars($data['tanggaldenda']);
		$jumlahdenda=htmlspecialchars($data['jumlahdenda']);

		$result=mysqli_query($conn,"INSERT INTO denda VALUES(NULL,'$idanggotadenda','$keterangandenda','$tanggaldenda','$jumlahdenda','belum bayar')");

		$notif=mysqli_affected_rows($conn);
	    if($notif>0){
	      echo"<script>
	          alert('Data berhasil ditambah!!!');
	          document.location.href='denda.php';
	        </script>";
	    }else{
	      echo"<script>
	          alert('Data gagal ditambah!!!');
	          document.location.href='denda.php';
	        </script>";
	    }
	}

	function getdatasumbangan($data){
		global $conn;
		$result=mysqli_query($conn,$data);
		return $result;
	}

	function tambahdatasumbangan($data){
		global $conn;
		$namasumbang=htmlspecialchars($data['namasumbang']);
		$tanggalsumbang=htmlspecialchars($data['tanggalsumbang']);
		$jumlahsumbang=htmlspecialchars($data['jumlahsumbang']);

		$result=mysqli_query($conn,"INSERT INTO sumbangan VALUES(NULL,'$namasumbang','$tanggalsumbang','$jumlahsumbang')");

		$notif=mysqli_affected_rows($conn);
	    if($notif>0){
	      echo"<script>
	          alert('Data berhasil ditambah!!!');
	          document.location.href='sumbangan.php';
	        </script>";
	    }else{
	      echo"<script>
	          alert('Data gagal ditambah!!!');
	          document.location.href='sumbangan.php';
	        </script>";
	    }
	}

	function saldo(){
		global $conn;
		// pemasukan
		$pemasukan=mysqli_query($conn,"SELECT SUM(jumlah_pemasukan) AS total FROM pemasukan");
    	$totalpemasukan=mysqli_fetch_assoc($pemasukan)['total'];
    	// pengeluaran
    	$pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran");
    	$totalpengeluaran=mysqli_fetch_assoc($pengeluaran)['total'];
    	// pinjaman
    	$pinjaman=mysqli_query($conn,"SELECT SUM(jumlah_pinjaman) AS total FROM pinjaman WHERE status_pinjaman='belum lunas'");
	    $totalpinjaman=mysqli_fetch_assoc($pinjaman);
	    $pinjamanlunas=mysqli_query($conn,"SELECT SUM(jumlah_pinjaman) AS total FROM pinjaman WHERE status_pinjaman='lunas'");
	    $totalpinjamanlunas=mysqli_fetch_assoc($pinjamanlunas);

	    $querybelumlunas="SELECT sum(jumlah_pinjaman)as totalpinjam,sum(jumlah_pembayaran)as totalbayar FROM pinjaman left JOIN pembayaran USING (id_pinjaman) where status_pinjaman='belum lunas'";
	    $getdatabelumlunas=mysqli_query($conn,$querybelumlunas);
	    $fetchbelumlunas=mysqli_fetch_assoc($getdatabelumlunas);
	    // denda
	    $dendabelum=mysqli_query($conn,"SELECT SUM(jumlah_denda) AS total FROM denda WHERE status_denda='belum bayar'");
	    $totaldendabelum=mysqli_fetch_assoc($dendabelum)['total'];
	    $dendalunas=mysqli_query($conn,"SELECT SUM(jumlah_denda) AS total FROM denda WHERE status_denda='lunas'");
	    $totaldendalunas=mysqli_fetch_assoc($dendalunas)['total'];
	    // sumbangan
	    $resultsumbangan=mysqli_query($conn,"SELECT SUM(jumlah_sumbangan) AS total FROM sumbangan");
    	$totalsumbangan=mysqli_fetch_assoc($resultsumbangan)['total'];
    	// data bunga
	    $queryterbayarbunga=mysqli_query($conn,"SELECT SUM(jumlah_bunga)as total FROM bungapinjaman");
	    $fetchterbayarbunga=mysqli_fetch_assoc($queryterbayarbunga);
	    $jumlahte=$fetchterbayarbunga['total'];
    	// saldo
    	$querysaldo=mysqli_query($conn,"SELECT * FROM saldo");
    	$fetchsaldo=mysqli_fetch_assoc($querysaldo)['jumlah_saldo'];

    	$datasimpan=$totalpinjaman['total']-$fetchbelumlunas['totalbayar'];

    	$saldo=$fetchsaldo+$totalpemasukan+$totalsumbangan+$totaldendalunas+$jumlahte-$totalpengeluaran-$datasimpan;
    	// $saldo=$fetchsaldo+$totalpemasukan+$totalsumbangan-$totalpengeluaran;

    	return $saldo;
	}

	function uploadfotoanggota(){
		$namaFile= $_FILES['foto']['name'];
		$ukuranFile= $_FILES['foto']['size'];
		$error= $_FILES['foto']['error'];
		$tmpname= $_FILES['foto']['tmp_name'];

		// if(!$_FILES){
		// 	// $file='default.jpg';
		// 	// return $file;
		// 	$datanotif=['notif'=>'default'];
		// 	echo json_encode($datanotif);
		// 	return exit;
		// }else{
			$exgamval=['jpg','jpeg','png','gif'];
			$exgam=explode('.', $namaFile);
			$exgam=strtolower(end($exgam));
			if(!in_array($exgam, $exgamval)){
				// echo"<script>
				// 		alert('Yang anda upload bukan gambar!');
				// 		document.location.href='anggota.php';
				// 	</script>";
				$datanotif=['notif'=>'Yang anda upload bukan gambar!'];
				echo json_encode($datanotif);
				return exit;
			}
			if($ukuranFile > 1700000 || $ukuranFile==""){
				// echo"<script>
				// 		alert('Ukuran gambar terlalu besar max ukuran 1.5 mb');
				// 		document.location.href='anggota.php';
				// 	</script>";
				$datanotif=['notif'=>'Ukuran gambar terlalu besar max ukuran 1.5 mb'];
				echo json_encode($datanotif);
				return exit;
			}

			$namaFileBaru=uniqid();
			$namaFileBaru.='.';
			$namaFileBaru.=$exgam;


			move_uploaded_file($tmpname, 'img/anggota/' . $namaFileBaru);
			
			return $namaFileBaru;
		// }
	}

	function updatefoto($data){
		$namaFile= $_FILES['fotoa']['name'];
		$ukuranFile= $_FILES['fotoa']['size'];
		$error= $_FILES['fotoa']['error'];
		$tmpname= $_FILES['fotoa']['tmp_name'];

			$exgamval=['jpg','jpeg','png','gif'];
			$exgam=explode('.', $namaFile);
			$exgam=strtolower(end($exgam));
			if(!in_array($exgam, $exgamval)){
				$datanotif=['notif'=>'Yang anda upload bukan gambar!'];
				echo json_encode($datanotif);
				return exit;
				// exit;
			}
			if($ukuranFile > 1700000 || $ukuranFile==""){
				$datanotif=['notif'=>'Ukuran gambar terlalu besar!'];
				echo json_encode($datanotif);
				return exit;
				// exit;
			}

			$namaFileBaru=uniqid();
			$namaFileBaru.='.';
			$namaFileBaru.=$exgam;


			move_uploaded_file($tmpname, 'img/anggota/' . $namaFileBaru);
			
			return $namaFileBaru;
		// }

	}

?>