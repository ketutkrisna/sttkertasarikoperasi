<?php 
	
	session_start();
	require_once __DIR__ . '/vendor/autoload.php';
	
  	require_once 'functions.php';
  	if(!isset($_SESSION['login'])){
      pindahhalaman();
      return exit;
    }
  	// $daftar='Daftar Anggota Aktif & Non aktif';
  	if(isset($_GET['key'])&&isset($_GET['type'])){
  		$key=htmlspecialchars($_GET['key']);
  		$type=htmlspecialchars($_GET['type']);
  		if($type=='all'){
  			$daftar='Daftar Semua Anggota '.$keys=($key=='')? null:'('.ucwords(strtolower($key)).')';
  			$data=mysqli_query($conn,"SELECT * FROM anggota WHERE nama_anggota LIKE '%$key%' ORDER BY status_anggota,nama_anggota");
  		}else if($type=="aktif / non aktif"){
  			$daftar='Daftar Anggota Aktif & Non aktif';
  			$data=anggota("SELECT * FROM anggota WHERE (status_anggota='aktif' or status_anggota='non aktif') and nama_anggota like '%$key%' ORDER BY status_anggota,nama_anggota");
  		}else{
  			$daftar='Daftar Anggota '.ucwords(strtolower($type)).' '.$keys=($key=='')? null:'('.ucwords(strtolower($key)).')';
  			$data=mysqli_query($conn,"SELECT * FROM anggota WHERE nama_anggota LIKE '%$key%' and status_anggota ='$type' ORDER BY nama_anggota");
  		}
      	// $countanggota= mysqli_num_rows($data);
  	}else{
  		
  		return exit;
  		// $countanggota= mysqli_num_rows($data);	
  	}

  	

	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
	$html='
		<!DOCTYPE html>
		<html>
		<head>
			<title></title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
		</head>
		<body>

			<h1 style="text-align:center;">STT KERTASARI</h1>
			<h3 style="text-align:center;">'.$daftar.'</h3>

			<table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin:auto;">
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Jabatan</th>
					<th>Status</th>
				<tr>';
				$i=1;
				foreach($data as $a){
					$html.='
						<tr>
							<td>'.$i++.'</td>
							<td>'.ucwords(strtolower($a['nama_anggota'])).'</td>
							<td>'.ucwords(strtolower($a['kelamin_anggota'])).'</td>
							<td>'.ucwords(strtolower($a['jabatan_anggota'])).'</td>
							<td>'.ucwords(strtolower($a['status_anggota'])).'</td>
						</tr>
					';
				}
		$html.=	'</table>
		</body>
		</html>
		';
	$mpdf->WriteHTML($html);
	$mpdf->Output('STT KERTASARI.pdf',\Mpdf\Output\Destination::INLINE);

?>
