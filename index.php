<?php  
	 
    session_start();
    // if(isset($_SESSION['login'])){
    //   $session=$_SESSION['login'];
    // }else{echo "";}
    // sleep(2);
    require_once'functions.php';
    $ketua=mysqli_query($conn,"SELECT * FROM anggota where jabatan_anggota='ketua'");
    $fetketua=mysqli_fetch_assoc($ketua);

    $wakil=mysqli_query($conn,"SELECT * FROM anggota where jabatan_anggota='wakil'");
    $fetwakil=mysqli_fetch_assoc($wakil);

    $bendahara=mysqli_query($conn,"SELECT * FROM anggota where jabatan_anggota='bendahara'");
    $fetbendahara=mysqli_fetch_assoc($bendahara);

    $humas=mysqli_query($conn,"SELECT * FROM anggota where jabatan_anggota='humas'");
    $fethumas=mysqli_fetch_assoc($humas);

    $data=anggota("SELECT * FROM anggota ORDER BY nama_anggota");
    $humas=mysqli_query($conn,"SELECT count(jabatan_anggota)as contol FROM anggota where jabatan_anggota='ketua'");

    $kontol=mysqli_fetch_assoc($humas)['contol'];
    // var_dump($kontol);die;

  if(isset($_SESSION['login'])){
  if($_SESSION['login']=="admin"){

    if(isset($_POST['namauud'])){
      $namauud=htmlspecialchars(strtoupper($_POST['namauud']));

      $ceknamauud=mysqli_query($conn,"SELECT * FROM daftaruud WHERE nama_uud='$namauud'");
      $fetnamauud=mysqli_fetch_assoc($ceknamauud);
      if($fetnamauud){
        $datanotif=['notif'=>'UUD sudah ada!'];
        echo json_encode($datanotif);
        return exit;
      }

      $datakosonguud=trim($namauud);
      if(empty($datakosonguud)){
        $datanotif=['notif'=>'Nama UUD tidak boleh kosong!'];
        echo json_encode($datanotif);
        return exit;
      }
      // $namabaruuud=trim($namauud);
      $stringbaruuud = preg_replace('/\s+/', ' ',$datakosonguud);
      // date_default_timezone_set('Asia/Jakarta');
      // $tgluud=date('H-i-s-a','1569059990'); contoh covert time ke waktu
      // $ganti = str_replace(" ", "_", $stringbaruuud);
      $tgluud=time();
   
      

      $queryuud=mysqli_query($conn,"INSERT INTO daftaruud VALUES(null,'$stringbaruuud','$tgluud')");
      $notif=mysqli_affected_rows($conn);
      if($notif>0){
          $datanotif=['notif'=>'Data berhasil ditambah!'];
          echo json_encode($datanotif);
          return exit;
      }else{
          $datanotif=['notif'=>'Data gagal ditambah!'];
          echo json_encode($datanotif);
          return exit;
      }

    }

  }else{}
  }else{}


  if(isset($_SESSION['login'])){
  if($_SESSION['login']=="admin"){

    if(isset($_POST['iduud'])){
      $iduud=htmlspecialchars($_POST['iduud']);
      $isitexta=htmlspecialchars($_POST['isitexta']);

      $datatextarea=trim($isitexta);
      if(empty($datatextarea)){
        $datanotif=['notif'=>'Text tidak boleh kosong!'];
        echo json_encode($datanotif);
        return exit;
      }
      $stringbarutext = preg_replace('/\s+/', ' ',$datatextarea);
      $tglupdate=time();

      $queryisi=mysqli_query($conn,"INSERT INTO daftarisiuud VALUES(null,'$iduud','$stringbarutext','$tglupdate')");
      $notif=mysqli_affected_rows($conn);
      if($notif>0){
          $datanotif=['notif'=>'Data berhasil ditambah!'];
          echo json_encode($datanotif);
          return exit;
      }else{
          $datanotif=['notif'=>'Data gagal ditambah!'];
          echo json_encode($datanotif);
          return exit;
      }

    }

  }else{}
  }else{}


  if(isset($_SESSION['login'])){
  if($_SESSION['login']=="admin"){

    if(isset($_POST['idupdate'])){

      $idupdate=htmlspecialchars($_POST['idupdate']);

      $querydataupdate=mysqli_query($conn,"SELECT * FROM daftaruud WHERE id_uud='$idupdate'");
      $fetdataupdate=mysqli_fetch_assoc($querydataupdate);
      echo json_encode($fetdataupdate);
      return exit;

    }

  }else{}
  }else{}
  

  if(isset($_SESSION['login'])){
  if($_SESSION['login']=="admin"){

    if(isset($_POST['simpanupdateuud'])){

      $hideidupdate=htmlspecialchars($_POST['hideidupdate']);
      $namaupdateuud=htmlspecialchars(strtoupper($_POST['namaupdateuud']));

      $ceknamaupdate=anggota("SELECT * FROM daftaruud WHERE nama_uud='$namaupdateuud' and id_uud='$hideidupdate'");
      $fetupdate=mysqli_fetch_assoc($ceknamaupdate);

      $ceknamatidak=anggota("SELECT * FROM daftaruud WHERE nama_uud='$namaupdateuud' and id_uud!='$hideidupdate'");
      $fetnamatidak=mysqli_fetch_assoc($ceknamatidak);

      if($fetupdate){
      // data kosong
      }else if($fetnamatidak){
        echo "<script>
                alert('Nama ".$namaupdateuud." sudah ada!');
                document.location.href='index.php';
              </script>";
        return exit;
      }

      $datanamakosong=trim($namaupdateuud);
      if(empty($datanamakosong)){
        echo "<script>
                alert('Nama tidak boleh kosong!');
                document.location.href='index.php';
              </script>";
        return exit;
      }else{
        $namabaruupdate=trim($namaupdateuud);
        $stringnamabaru = preg_replace('/\s+/', ' ', $namabaruupdate);
      }
      // var_dump($namaupdateuud);die;
      $sqlupdate=mysqli_query($conn,"UPDATE daftaruud SET nama_uud='$stringnamabaru' WHERE id_uud='$hideidupdate'");

      $notif=mysqli_affected_rows($conn);
      if($notif>0){
          echo "<script>
                alert('Data berhasil diupdate!');
                document.location.href='index.php';
              </script>";
          return exit;
      }else{
          echo "<script>
                alert('Data gagal diupdate!');
                document.location.href='index.php';
              </script>";
          return exit;
      }

    }

  }else{}
  }else{}


  if(isset($_SESSION['login'])){
  if($_SESSION['login']=="admin"){

    if(isset($_POST['valueidisi'])){

      $postidisi=htmlspecialchars($_POST['valueidisi']);
      $posttextupdate=htmlspecialchars($_POST['valuetextupdate']);

      $datatextupdate=trim($posttextupdate);
      if(empty($datatextupdate)){
        $datanotif=['notif'=>'Text tidak boleh kosong!'];
        echo json_encode($datanotif);
        return exit;
      }
      $stringbaruupdate = preg_replace('/\s+/', ' ',$datatextupdate);
      $tglupdateisi=time();

      $updatedaftarisi=mysqli_query($conn,"UPDATE daftarisiuud SET isi='$stringbaruupdate',update_isi='$tglupdateisi' WHERE id_isi='$postidisi'");

      $notif=mysqli_affected_rows($conn);
      if($notif>0){
          $datanotif=['notif'=>'Data berhasil diupdate!'];
          echo json_encode($datanotif);
          return exit;
      }else{
          $datanotif=['notif'=>'Data gagal diupdate!'];
          echo json_encode($datanotif);
          return exit;
      }

    }    

  }else{}
  }else{}
    // var_dump(mysqli_fetch_assoc($datauud));die;


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>halaman home</title>
  
  <script data-ad-client="ca-pub-7792471363511159" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Bevan|Pattaya|Playball|Shojumaru&display=swap" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style type="text/css">
    .carousel-item img{
      height: 240px;
    }
    @media (min-width: 576px) {
      .carousel-item img{
      height: 300px;
      }
    }
    @media (min-width: 768px) {
      .carousel-item img{
      height: 350px;
      }
    }
    @media (min-width: 992px) {
      .carousel-item img{
      height: 500px;
      }
    }
    .ukuran{
      font-size: 20px;
    }
    #exampleModalanggota .list-group-item input{
      width: 100%;
    }
    #exampleModalanggota .list-group-item select{
      width: 100%;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="<?=sidebar(); ?>">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center bg-info" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-fw fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Home</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>


      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link align-items-center justify-content-center" href="anggota.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Anggota</span></a>
      </li>

    <?php if(isset($_SESSION['login'])){ ?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link align-items-center justify-content-center" href="pemasukan.php">
          <i class="fas fa-fw fa-sign-in-alt"></i>
          <span>Pemasukan</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link align-items-center justify-content-center" href="pengeluaran.php">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Pengeluaran</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="pinjaman.php">
          <i class="fas fa-fw fa-funnel-dollar"></i>
          <span>Pinjaman</span></a>
      </li> -->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed align-items-center justify-content-center" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-funnel-dollar"></i>
          <span>Pinjaman</span>
        </a>
        <div id="collapseTwo" style="z-index: 9;" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu pinjaman:</h6>
            <a class="collapse-item" href="pinjaman.php">Belum Lunas <span class="badge badge-danger badge-counter"><?php $counter=counter(); if($counter==0){}else{echo $counter;}?></span></a>
            <a class="collapse-item" href="pinjamanlunas.php">Sudah Lunas</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="denda.php">
          <i class="far fa-fw fa-money-bill-alt"></i>
          <span>Denda</span></a>
      </li> -->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed align-items-center justify-content-center" href="#" data-toggle="collapse" data-target="#collapseDenda" aria-expanded="true" aria-controls="collapseTwo">
          <i class="far fa-fw fa-money-bill-alt"></i>
          <span>Denda</span>
        </a>
        <div id="collapseDenda" style="z-index: 9;" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu denda:</h6>
            <a class="collapse-item" href="denda.php">Belum Lunas <span class="badge badge-danger badge-counter"><?php $counterdenda=counterdenda(); if($counterdenda==0){}else{echo $counterdenda;}?></span></a>
            <a class="collapse-item" href="dendalunas.php">Sudah Lunas</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link align-items-center justify-content-center" href="sumbangan.php">
          <i class="fas fa-fw fa-hand-holding-usd"></i>
          <span>Sumbangan</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link align-items-center justify-content-center" href="rekap.php">
          <i class="fab fa-fw fa-readme"></i>
          <span>Rekap</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link align-items-center justify-content-center" href="saldo.php">
          <i class="fas fa-fw fa-wallet"></i>
          <span>Saldo</span></a>
      </li>
    <?php }else{echo"";} ?>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Divider -->
      <!-- <hr class="sidebar-divider d-none d-md-block"> -->

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow" style="position:relative;">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                  }else{
                    echo'tamu';
                  } ?>
                </span>
                <?php 
                  if(isset($_SESSION['login'])){
                    if($_SESSION['login']=="admin"){
                      $fotol="admin.jpg";
                    }else{
                      $fotol="anggota.png";
                    }
                  }else{
                    $fotol="kosong.jpg";
                  }
                ?>
                <img class="img-profile rounded-circle" src="img/<?=$fotol; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
              <?php if(isset($_SESSION['login'])){ ?>
                <?php if($_SESSION['login']=="admin"){ ?>
                    <a class="dropdown-item" href="setting.php">
                      <i class="fas fa-fw fa-cogs"></i>
                      Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">
                      <i class="fas fa-fw fa-power-off"></i>
                      Logout
                    </a>
                <?php }else{ ?>
                    <a class="dropdown-item" href="logout.php">
                      <i class="fas fa-fw fa-power-off"></i>
                      Logout
                    </a>
                <?php } ?>
              <?php }else{ ?>
                <a class="dropdown-item" href="login.php">
                  <i class="fas fa-fw fa-sign-in-alt"></i>
                  Login
                </a>
              <?php } ?>

              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <?php for($triger=1;$triger<11;$triger++){ ?>
              <li data-target="#carouselExampleIndicators" data-slide-to="<?=$triger; ?>"></li>
              <?php } ?>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img style="" class="d-block w-100" src="img/slide/12.jpg" alt="First slide">
              </div>
              <?php for($slide=1;$slide<11;$slide++){ ?>
              <div class="carousel-item">
                <img style="" class="d-block w-100" src="img/slide/<?=$slide; ?>.jpg" alt="Second slide">
              </div>
              <?php } ?>
              <!-- <div class="carousel-item">
                <img class="d-block w-100" src="img/as.jpg" alt="Third slide">
              </div> -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> -->
            <!-- <h1 class="h3 mb-0 text-gray-800">Anggota</h1> -->
          <!-- </div> -->


      <h5 class="ml-auto text-right mb-4" style="font-size:20px;position: absolute;top: 80px;right: 30px;left: 0;color: red;text-shadow: 2px 2px 1px black">Hello <span style="font-family: bevan;font-size:17px"><?php if(isset($_SESSION['login'])){echo $_SESSION['login'];}else{echo'tamu';} ?>,</span>
      </h5>
      <div style="margin-bottom: 20px;">
        <h5 class="text-center mt-4"><span style="font-family:Shojumaru;font-size:27px;text-shadow:1px 1px 1px black;letter-spacing: 2px">STT KERTASARI</span></h5>
      </div>
		  <div style="border: 1px solid #ccc; width: 150px;right: 0;left: 0; margin: auto;background-color:#eee;border-radius:10px 10px 10px 10px;box-shadow: 3px 3px 3px gray;"><h4 class="text-center mb-2 mt-2">Pengurus</h4></div>

      <div class="viewanggota">

      <?php foreach($data as $d): ?>
        <?php if($d['jabatan_anggota']=='ketua'){ ?>
          <div class="row text-center">
          <div class="col-sm-12">
            
                <i class="fas fa-fw fa-long-arrow-alt-down" style=""></i>
            
            <div class="list-group" style="margin:auto;">
              <span class="list-group-item list-group-item-action active" style="border-radius:20px 20px 0 0;padding:0px;width:130px;margin: auto;">
                Ketua
              </span>
              <div href="detail.php?id_anggota=<?=$d['id_anggota']; ?>" class="list-group-item list-group-item-action detailanggota" data-toggle="modal" data-target="#exampleModalanggota" data-idanggota="<?=$d['id_anggota']; ?>" style="border-radius:10px 10px 10px 10px;background-color:#eee;font-weight:bold;box-shadow: 2px 2px 3px gray;">
                <img class="rounded-circle mr-1" src="img/anggota/<?=$d['foto_anggota']; ?>" width="30" height="30"><?=ucwords(strtolower($d['nama_anggota'])); ?>
              </div>
            </div>

          </div>
        </div>
        <?php }?>
      <?php endforeach; ?>
      <?php foreach($data as $d): ?>
        <?php if($d['jabatan_anggota']=='wakil'){ ?>
          <div class="row text-center">
          <div class="col-sm-12">
              <i class="fas fa-fw fa-long-arrow-alt-down" style=""></i>

            <div class="list-group" style="margin:auto;">
              <span class="list-group-item list-group-item-action active" style="border-radius:20px 20px 0 0;padding:0px;width:130px;margin: auto;">
                Wakil
              </span>
              <div href="detail.php?id_anggota=<?=$d['id_anggota']; ?>" class="list-group-item list-group-item-action detailanggota" data-toggle="modal" data-target="#exampleModalanggota" data-idanggota="<?=$d['id_anggota']; ?>" style="border-radius:10px 10px 10px 10px;background-color:#eee;font-weight:bold;box-shadow: 2px 2px 3px gray;">
                <img class="img-profile rounded-circle mr-1" src="img/anggota/<?=$d['foto_anggota']; ?>" width="30" height="30"><?=ucwords(strtolower($d['nama_anggota'])); ?>
              </div>
            </div>

          </div>
        </div>
        <?php } ?>
      <?php endforeach; ?>
      <?php foreach($data as $d): ?>
        <?php if($d['jabatan_anggota']=='bendahara'){ ?>
          <div class="row text-center">
          <div class="col-sm-12">
            <i class="fas fa-fw fa-long-arrow-alt-down" style=""></i>

            <div class="list-group" style="margin:auto;">
              <span class="list-group-item list-group-item-action active" style="border-radius:20px 20px 0 0;padding:0px;width:130px;margin: auto;">
                Bendahara
              </span>
              <div href="detail.php?id_anggota=<?=$d['id_anggota']; ?>" class="list-group-item list-group-item-action detailanggota" data-toggle="modal" data-target="#exampleModalanggota" data-idanggota="<?=$d['id_anggota']; ?>" style="border-radius:10px 10px 10px 10px;background-color:#eee;font-weight:bold;box-shadow: 2px 2px 3px gray;">
                <img class="img-profile rounded-circle mr-1" src="img/anggota/<?=$d['foto_anggota']; ?>" width="30" height="30"><?=ucwords(strtolower($d['nama_anggota'])); ?>
              </div>
            </div>
                
          </div>
        </div>
        <?php } ?>
      <?php endforeach; ?>
      <?php foreach($data as $d): ?>
        <?php if($d['jabatan_anggota']=='humas'){ ?>
          <div class="row text-center">
          <div class="col-sm-12">
            <i class="fas fa-fw fa-long-arrow-alt-down" style=""></i>

            <div class="list-group" style="margin:auto;">
              <span class="list-group-item list-group-item-action active" style="border-radius:20px 20px 0 0;padding:0px;width:130px;margin: auto;">
                Humas
              </span>
              <div href="detail.php?id_anggota=<?=$d['id_anggota']; ?>" class="list-group-item list-group-item-action detailanggota" data-toggle="modal" data-target="#exampleModalanggota" data-idanggota="<?=$d['id_anggota']; ?>" style="border-radius:10px 10px 10px 10px;background-color:#eee;font-weight:bold;box-shadow: 2px 2px 3px gray;">
                <img class="img-profile rounded-circle mr-1" src="img/anggota/<?=$d['foto_anggota']; ?>" width="30" height="30"><?=ucwords(strtolower($d['nama_anggota'])); ?>
              </div>
            </div>

          </div>
        </div>
        <?php } ?>
      <?php endforeach; ?>

    </div>

      <!-- Project Card Example -->
       <!--  <div class="row text-center">
          <div class="col-sm-12">
            <div class="list-group" style="margin:auto;">
              <span class="list-group-item list-group-item-action active" style="border-radius:20px 20px 0 0;padding:0px;width:130px;margin: auto;">
                Ketua
              </span>
              <a href="detail.php?id_anggota=<?=$fetketua['id_anggota']; ?>" class="list-group-item list-group-item-action" style="border-radius:10px 10px 10px 10px;background-color:#eee;font-weight:bold;"><img class="rounded-circle mr-1" src="img/anggota/<?=$fetketua['foto_anggota']; ?>" width="30" height="30"><?=$fetketua['nama_anggota']; ?></a>
            </div><i class="fas fa-fw fa-long-arrow-alt-down"></i>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-sm-12">
            <div class="list-group" style="margin:auto;">
              <span class="list-group-item list-group-item-action active" style="border-radius:20px 20px 0 0;padding:0px;width:130px;margin: auto;">
                Wakil
              </span>
              <a href="detail.php?id_anggota=<?=$fetwakil['id_anggota']; ?>" class="list-group-item list-group-item-action" style="border-radius:10px 10px 10px 10px;background-color:#eee;font-weight:bold;"><img class="img-profile rounded-circle mr-1" src="img/anggota/<?=$fetwakil['foto_anggota']; ?>" width="30" height="30"><?=$fetwakil['nama_anggota']; ?></a>
            </div>
                <i class="fas fa-fw fa-long-arrow-alt-down" style=""></i>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-sm-12">
            <div class="list-group" style="margin:auto;">
              <span class="list-group-item list-group-item-action active" style="border-radius:20px 20px 0 0;padding:0px;width:130px;margin: auto;">
                Bendahara
              </span>
              <a href="detail.php?id_anggota=<?=$fetbendahara['id_anggota']; ?>" class="list-group-item list-group-item-action" style="border-radius:10px 10px 10px 10px;background-color:#eee;font-weight:bold;"><img class="img-profile rounded-circle mr-1" src="img/anggota/<?=$fetbendahara['foto_anggota']; ?>" width="30" height="30"><?=$fetbendahara['nama_anggota']; ?></a>
            </div>
                <i class="fas fa-fw fa-long-arrow-alt-down"></i>
          </div>
          <div class="col-sm-12">
            <div class="list-group" style="margin:auto;">
              <span class="list-group-item list-group-item-action active" style="border-radius:20px 20px 0 0;padding:0px;width:130px;margin: auto;">
                Humas
              </span>
              <a href="detail.php?id_anggota=<?=$fethumas['id_anggota']; ?>" class="list-group-item list-group-item-action" style="border-radius:10px 10px 10px 10px;background-color:#eee;font-weight:bold;"><img class="img-profile rounded-circle mr-1" src="img/anggota/<?=$fethumas['foto_anggota']; ?>" width="30" height="30"><?=$fethumas['nama_anggota']; ?></a>
            </div>
          </div>
        </div> -->

      <?php if(isset($_SESSION['login'])){ ?>

        <div id="accordion" class="" style="margin-top: 70px">
        <?php if(isset($_SESSION['login'])){ ?>
        <?php if($_SESSION['login']=="admin"){ ?>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModaluud">
            Tambah UUD
          </button>

        <?php }else{} ?>
        <?php }else{} ?>

          <div class="card-header text-dark" style="background-color:#ccc;">
            <h3 class="text-center">Peraturan</h3>
          </div>
        <?php  
          $querydaftar=mysqli_query($conn,"SELECT * FROM daftaruud");
          foreach($querydaftar as $daftar):
            $iduu=$daftar['id_uud'];
        ?>
          <div class="card">
          <?php if(isset($_SESSION['login'])){ ?>
          <?php if($_SESSION['login']=="admin"){ ?>

            <div tabindex="0" class="menuuud badge" data-idupdateuud="<?=$iduu; ?>" style="position: absolute;right: 0;margin-top:20px;" data-toggle="popover" title="<?=$daftar['nama_uud']; ?>" data-content='<div class="text-center"><a href=""><div class="btn edituud"><i class="fas fa-fw fa-edit text-success ukuran"></i></div></a>||<a href=""><div class="btn hapusuud"><i class="fas fa-fw fa-trash-alt text-danger ukuran"></i></div></a></div>'>
              <i class="fas fa-fw fa-ellipsis-v text-secondary" style="font-size: 14px"></i>
            </div>

          <?php }else{} ?>
          <?php }else{} ?>
            <div class="card-header cobalah" id="headingOne" style="background-color: #ddd">
              <h5 class="mb-0 text-center">
                <button style="width:100%;height:100%;top:0;bottom:0;left:0;right:0;" class="btn btn-link" data-toggle="collapse" data-target="#nama<?=$daftar['id_uud']; ?>" aria-expanded="true" aria-controls="collapseOne">
                  <span style="font-size:;font-weight:bold;"><?=$daftar['nama_uud']; ?></span>
                </button>
              </h5>
            </div>

            <div id="nama<?=$daftar['id_uud']; ?>" class="collapse cobaa" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body cobalah1" style="background-color: #eee">

              <?php 
                $datauud=mysqli_query($conn,"SELECT id_uud,id_isi,nama_uud,isi from daftaruud JOIN daftarisiuud USING (id_uud) WHERE id_uud='$iduu'");
                $no=1; 
              ?>

              <div class="viewisi<?=$daftar['id_uud']; ?>">
              <?php foreach($datauud as $uu): ?>
                <div class="row">
                  <div class="col-1">
                    <?=$no++; ?>
                  </div>
                  <div class="col-11">
                    <?=$uu['isi']; ?>

                <?php if(isset($_SESSION['login'])){ ?>
                <?php if($_SESSION['login']=="admin"){ ?>    
                    <span class="editisiuud mr-3" data-idisi="<?=$uu['id_isi']; ?>" data-isiuud="<?=$uu['isi']; ?>" data-iduud="<?=$uu['id_uud']; ?>"><i class="fas fa-fw fa-edit text-success ukuran"></i></span>
                    <span class="deleteisiuud" data-idisi="<?=$uu['id_isi']; ?>" data-iduud="<?=$uu['id_uud']; ?>"><i class="fas fa-fw fa-trash-alt text-danger ukuran"></i></span>
                <?php }else{} ?>
                <?php }else{} ?>

                  </div>
                </div>
              <?php endforeach; ?>
              </div>

          <?php if(isset($_SESSION['login'])){ ?>
          <?php if($_SESSION['login']=="admin"){ ?>

                <div class="input-group mt-3">
                  <textarea class="form-control isitexta<?=$daftar['id_uud']; ?>" aria-label="With textarea" placeholder="Ketik untuk menabah isi baru..."></textarea>
                  <div class="input-group-prepend">
                    <span class="input-group-text btn btn-primary bg-primary text-white tambahisi" data-iduud="<?=$daftar['id_uud']; ?>">OK</span>
                  </div>
                </div>

          <?php }else{} ?>
          <?php }else{} ?>
            
              </div>
            </div>
          </div>
        <?php endforeach; ?>


        </div>

      <?php }else{} ?>

        
        <!-- <div class="card mt-5">
          <div class="card-header bg-info text-dark" style="color:orange;">
            <h3 class="text-center">Peraturan</h3>
          </div>
          <div class="card-body" style="background-color:#ddd;">
            <h5>UUD Perkawinan:</h5>
            <div class="row">
              <div class="col-1">
                1
              </div>
              <div class="col-11">
                Perkawinan harus didasarkan atas persetujuan kedua calon mempelai.
              </div>
            </div>
            <div class="row">
              <div class="col-1">
                2
              </div>
              <div class="col-11">
                Untuk melangsungkan perkawinan seorang yang belum mencapai umur 21 (dua puluh satu) tahun harus
                mendapat izin kedua orang tua.
              </div>
            </div>
            <div class="row">
              <div class="col-1">
                3
              </div>
              <div class="col-11">
                Dalam hal salah seorang dari kedua orang tua telah meninggal dunia atau dalam keadaan tidak mampu
                menyatakan kehendaknya, maka izin dimaksud ayat (2) pasal ini cukup diperoleh dari orang tua yang
                masih hidup atau dari orang tua yang mampu menyatakan kehendaknya.
              </div>
            </div>
            <div class="row">
              <div class="col-1">
                4
              </div>
              <div class="col-11">
                Dalam hal kedua orang tua telah meninggal dunia atau dalam keadaan tidak mampu untuk
                menyatakan kehendaknya maka izin diperoleh dari wali, orang yang memelihara atau keluarga yang
                mempunyai hubungan darah dalam garis keturunan, lurus ke atas selama mereka masih hidup dan dalam
                keadaan dapat menyatakan kehendaknya.
              </div>
            </div>
            <div class="row">
              <div class="col-1">
                5
              </div>
              <div class="col-11">
                Dalam hal ada perbedaan pendapat antara orang-orang yang dalam ayat (2), (3) dan (4), pasal ini atau salah
                seorang atau. di antara mereka tidak menyatakan pendapatnya, maka Pengadilan dalam daerah hukum
                tempat tinggal orang yang melangsungkan perkawinan atas permintaan orang tersebut memberikan izin
                setelah lebih dahulu mendengar orang-orang tersebut dalam ayat (2), (3) dan (4) pasal ini.
              </div>
            </div>
            <div class="row">
              <div class="col-1">
                6
              </div>
              <div class="col-11">
                Ketentuan tersebut ayat (1) sampai dengan ayat (5) pasal berlaku sepanjang hukum masing-masing
                agamanya dan kepercayaannya itu dari yang bersangkutan tidak menentukan lain.
              </div>
            </div>
          </div>
        </div> -->

        <!-- <button id="coba" class="btn btn-lg btn-danger" data-html="true" data-placement="top" data-toggle="popover" title="detail" data-content='<div class="btn btn-primary" style="width:100px;">asu</div>'>nama</button> -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


      <!-- Footer -->
      <footer class="sticky-footer bg-white" style="margin-top: 50px;">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span> <?=tahun(); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <?=downbar(); ?>
  
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top" style="<?=uptop(); ?>">
    <i class="fas fa-angle-up"></i>
  </a>

    
    <?php if(isset($_SESSION['login'])){ ?>
    <?php if($_SESSION['login']=="admin"){ ?>
      <!-- Modal -->
      <div class="modal fade" id="exampleModaluud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah UUD <span class="loadertambahuud"><img src="img/loader.gif" width="22"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="hidetambahuud">
            <div class="modal-body">

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" style="width:100px;">Nama UUD</span>
                </div>
                <input type="text" class="form-control namauud" placeholder="masukan nama UUD" aria-label="Username" aria-describedby="basic-addon1" name="namauud" autocomplete="off" required>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary simpanuud">Simpan</button>
            </div>
            </div>

          </div>
        </div>
      </div>
    <?php }else{} ?>
    <?php }else{} ?>


    <?php if(isset($_SESSION['login'])){ ?>
    <?php if($_SESSION['login']=="admin"){ ?>
      <!-- Modal -->
      <div class="modal fade" id="Modalupdateuud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update UUD <span class="loaderupdate"><img src="img/loader.gif" width="22"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="hideupdatebody">
            <form action="" method="post">
            <div class="modal-body">

              <input type="hidden" name="hideidupdate" class="hideidupdate">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" style="width:100px;">Nama UUD</span>
                </div>
                <input type="text" class="form-control namaupdateuud" placeholder="masukan nama UUD baru" aria-label="Username" aria-describedby="basic-addon1" name="namaupdateuud" autocomplete="off" required>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="submit" name="simpanupdateuud" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          </div>

          </div>
        </div>
      </div>
    <?php }else{} ?>
    <?php }else{} ?>


    <?php if(isset($_SESSION['login'])){ ?>
    <?php if($_SESSION['login']=="admin"){ ?>
      <!-- Modal -->
      <div class="modal fade" id="Modalupdateisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update isi <span class="loaderupdateisi"><img src="img/loader.gif" width="22"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="hideupdateisi">
            <div class="modal-body">

                <input type="hidden" name="" class="validisi">
                <input type="hidden" name="" class="validuud">
              <div class="input-group mt-3">
                <textarea class="form-control isitextupdate" aria-label="With textarea" placeholder="Ketik isi baru..." style=""></textarea>
                <div class="input-group-prepend">
                  <span class="input-group-text btn btn-primary bg-primary text-white updateisi">OK</span>
                </div>
              </div>
              
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-primary simpanuud">Simpan</button> -->
            </div>
            </div>

          </div>
        </div>
      </div>
    <?php }else{} ?>
    <?php }else{} ?>


  <!-- Modal -->
      <div class="modal fade showmodal" id="exampleModalanggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 90%;left:0;right:0;margin:auto;z-index: 99999999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><span class="gantitext">Detail Anggota</span> <span class="loader"><img src="img/loader.gif" width="22"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- <div class="modal-body"> -->
              <div class="datahide">
              <div class="fotopost"></div>
              <li class="list-group-item">
                <!-- <div class="container"> -->
                <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="" class="idanggotahide">
                  <input type="hidden" name="" class="fotolamapost">

                  <table style="left: 0;right: 0; margin: auto;">
                  <?php if(isset($_SESSION['login'])){ ?>
                    <?php if($_SESSION['login']=="admin"){ ?>
                    <tr>
                      <td colspan="2"><span style="font-weight:bold;"><input type="file" name="" class="showform" id="fotoa"></span></td>
                    </tr>
                    <?php }else{echo "";} ?>
                  <?php }else{echo "";} ?>
                    <tr>
                      <td width="95"><i class="far fa-fw fa-id-card"></i> Nama <span class="float-right">:</span></td>
                      <td>
                        <?php if(isset($_SESSION['login'])){ ?>
                          <?php if($_SESSION['login']=="admin"){ ?>
                            <input type="text" name="" class="showform form-control namaa">
                          <?php }else{echo "";} ?>
                        <?php }else{echo "";} ?>
                        <span style="font-weight:bold;" class="namaanggota hideform"></span>
                      </td>
                    </tr>
                  <?php if(isset($_SESSION['login'])){ ?>
                    <tr>
                      <td width="95"><i class="fas fa-fw fa-phone"></i> Tlp <span class="float-right">:</span></td>
                      <td>
                        <?php if(isset($_SESSION['login'])){ ?>
                          <?php if($_SESSION['login']=="admin"){ ?>
                            <input type="number" name="" class="showform form-control telepona">
                          <?php }else{echo "";} ?>
                        <?php }else{echo "";} ?>
                        <span style="font-weight:bold;" class="teleponanggota hideform"></span>
                      </td>
                    </tr>
                  <?php }else{echo'';} ?>
                    <tr>
                      <td width="95"><i class="fas fa-fw fa-venus-mars"></i></i> Kelamin <span class="float-right">:</span></td>
                      <td>
                        <?php if(isset($_SESSION['login'])){ ?>
                          <?php if($_SESSION['login']=="admin"){ ?>
                              <select class="showform form-control kelamina" name="" style="">
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                              </select>
                          <?php }else{echo "";} ?>
                        <?php }else{echo "";} ?>
                        <span style="font-weight:bold;" class="kelaminanggota hideform"></span>
                      </td>
                    </tr>
                    <tr>
                      <td width="95"><i class="fas fa-fw fa-suitcase"></i> Jabatan <span class="float-right">:</span></td>
                      <td>
                        <?php if(isset($_SESSION['login'])){ ?>
                          <?php if($_SESSION['login']=="admin"){ ?>
                            <select class="showform form-control jabatana" name="">
                              <option value="anggota">Anggota</option>
                              <option value="humas">Humas</option>
                              <option value="bendahara">Bendahara</option>
                              <option value="wakil">Wakil</option>
                              <option value="ketua">Ketua</option>
                            </select>
                          <?php }else{echo "";} ?>
                        <?php }else{echo "";} ?>
                        <span style="font-weight:bold;" class="jabatananggota hideform"></span>
                      </td>
                    </tr>
                    <tr>
                      <td width="95"><i class="fas fa-fw fa-hourglass-half"></i> Status <span class="float-right">:</span></td>
                      <td>
                        <?php if(isset($_SESSION['login'])){ ?>
                          <?php if($_SESSION['login']=="admin"){ ?>
                            <select class="showform form-control statusa" name="">
                              <option value="aktif">Aktif</option>
                              <option value="non aktif">Non aktif</option>
                              <option value="menikah">Menikah</option>
                              <option value="drop out">Drop out</option>
                            </select>
                          <?php }else{echo "";} ?>
                        <?php }else{echo "";} ?>
                        <span style="font-weight:bold;" class="statusanggota hideform"></span>
                      </td>
                    </tr>
                  </table>
                
                <!-- </div> -->
              </li>
            <!-- </div> -->
            <?php if(isset($_SESSION['login'])){ ?>
              <?php if($_SESSION['login']=='admin'){ ?>
            <div class="modal-footer" style="padding: 5px;">
              <!-- <button type="button" class="btn btn-danger editanggota">Edit</button> -->
              <button type="button" class="btn hapusanggota float-left mr-auto tradehapus"><i class="fas fa-fw fa-trash-alt text-danger" style="font-size: 30px;"></i></button>
              <button type="button" class="btn okbatal float-left mr-auto tradibatal"><i class="fas fa-fw fa-window-close text-danger" style="font-size: 30px;"></i></button>

              <button type="button" class="btn text-primary trade"><i class="fas fa-fw fa-user-cog" style="font-size: 30px;"></i></button>
              <button type="button" class="btn oksimpan text-primary tradi"><i class="fas fa-fw fa-check" style="font-size: 30px;"></i></button>
            </div>
              <?php }else{echo"";} ?>
            <?php }else{echo'';} ?>
            </div>
            </form>
          </div>
        </div>
      </div>


  <!-- Logout Modal-->
  <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Logout" untuk keluar dari session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <script type="text/javascript">

    var uril='https://sttkertasari.000webhostapp.com/';

    function UpperCaseFirstLetter(str){
     return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    }

    $('.carousel').carousel({
      interval: 4000,
      pause:"hover"
    });

    $('body').on('click','.detailanggota',function(){
      $('.tradibatal').hide();
      $('.tradi').hide();
      $('.showform').hide();

      $('.gantitext').text('Detail Anggota');

      $('#fotoa').val("");

      $('.trade').show();
      $('.tradehapus').show();
      $('.hideform').show();
      var idanggota=$(this).data('idanggota');
      $('.datahide').hide();
      $('.loader').show();
      $.ajax({
          url: uril+'anggota.php',
          method: "POST",
          data: 'idpost=' + idanggota,
          dataType: "json",
          success:function(data){
            $('.fotopost').html('<img class="card-img-top" height="150px" src="img/anggota/'+data.foto_anggota+'">');
            $('.idanggotahide').val(data.id_anggota);
            $('.namaanggota').text(UpperCaseFirstLetter(data.nama_anggota));
            $('.teleponanggota').text(data.tlp_anggota);
            $('.kelaminanggota').text(UpperCaseFirstLetter(data.kelamin_anggota));
            $('.jabatananggota').text(UpperCaseFirstLetter(data.jabatan_anggota));
            $('.statusanggota').text(UpperCaseFirstLetter(data.status_anggota));

            
            $('.fotolamapost').val(data.foto_anggota);
            $('.namaa').val(UpperCaseFirstLetter(data.nama_anggota));
            $('.telepona').val(data.tlp_anggota);
            $('.kelamina').val(data.kelamin_anggota);
            $('.jabatana').val(data.jabatan_anggota);
            $('.statusa').val(data.status_anggota);
            $('.datahide').show();
            $('.loader').hide();
            
          }
        });
    });


    $('.loadere').hide();
    $('.optiontipe').on('change',function(){
      var optiontipe=$('.optiontipe').val();
      var keywordcari=$('.keywordcari').val();

      $('.loadere').show();
      $.post( uril+"viewajax/viewanggota.php", { optiontipe: optiontipe,keywordcari:keywordcari})
        .done(function( data ) {
          $('.valuecari').html($('.optiontipe').val());
          $('.loadere').hide();
          $('.viewanggota').html(data);
      });
    });


    $('.buttoncari').hide();
    $('.keywordcari').on('keyup',function(){
      var keywordcari=$('.keywordcari').val();
      var optiontipe=$('.optiontipe').val();
      $('.loadere').show();

      $.post( uril+"viewajax/viewanggota.php", { optiontipe: optiontipe,keywordcari:keywordcari})
        .done(function( data ) {
          $('.loadere').hide();
          $('.viewanggota').html(data);
      }); 
    });


    // $('body').on('focusin','.cobalah',function(){
    //   $('.cobalah').css('background-color','#fff');
    //   $(this).css('background-color','#ddd');
    //   $('.cobalah1').show('toggle');
    // });
    // $('body').on('focusout','.cobalah',function(){
    //   $('.cobalah1').hide('toggle');
    //   // $(this).css('background-color','#ddd');
    // });
    // $('body').on('focusout','.cobalah',function(){
    //   $('.cobalah').css('background-color','#fff');
    //   $('.cobaa').hide();
    //   // $(this).css('background-color','#ddd');
    // });

  </script>


<?php if(isset($_SESSION['login'])){ ?>
<?php if($_SESSION['login']=='admin'){ ?>

  <script type="text/javascript">
     $('.tradibatal').hide();
      $('.tradi').hide();
      $('.showform').hide();

    $('.trade').on('click',function(){
      $('.tradibatal').show('toggle');
      $('.tradi').show('toggle');

      $('.trade').hide();
      $('.tradehapus').hide();

      $('.showform').show();
      $('.hideform').hide(); 

      $('.gantitext').text('Update Anggota'); 

      $('#fotoa').val("");
    });


    $('.tradibatal').on('click',function(){
      $('.trade').show('toggle');
      $('.tradehapus').show('toggle');

      $('.tradibatal').hide();
      $('.tradi').hide();

      $('.showform').hide();
      $('.hideform').show();

      $('.gantitext').text('Detail Anggota');

      $('#fotoa').val("");
    });


     $('.tradi').on('click',function(){
      var optiontipe=$('.optiontipe').val();
      var keywordcari=$('.keywordcari').val();
      var formUpdate = new FormData();
      var fotoas = $('#fotoa')[0].files[0];
      $('#fotoa').empty();
      $('.loader').show();
      $('.datahide').hide();
      formUpdate.append('idanggotahide', $('.idanggotahide').val());
      formUpdate.append('namaa', $('.namaa').val());
      formUpdate.append('telepona', $('.telepona').val());
      formUpdate.append('kelamina', $('.kelamina').val());
      formUpdate.append('jabatana', $('.jabatana').val());
      formUpdate.append('statusa', $('.statusa').val());
      formUpdate.append('fotolamapost', $('.fotolamapost').val());
      formUpdate.append('fotoa', fotoas);

      $.ajax({
          url: uril+'anggota.php',
          type: 'POST',
          data: formUpdate,
          contentType: false,
          processData: false,
          enctype: 'multipart/form-data',
          cache:false,
          dataType:"json",
          success: function(datas){
            $('.loader').hide();
            $('.datahide').show();
            $('.gantitext').text('Detail Anggota');
            if(datas.notif=='Yang anda upload bukan gambar!'){
              alert('Yang anda upload bukan gambar!');
              return false;
            }else if(datas.notif=='Nama tidak boleh kosong!'){
              alert(datas.notif);
              return false;
            }else if(datas.notif=='Nama sudah ada!'){
              alert('Nama ('+$('.namaa').val()+') sudah ada dalam daftar!');
              return false;
            }else if(datas.notif=='Ukuran gambar terlalu besar!'){
              alert('Ukuran gambar terlalu besar!');
              return false;
            }else if(datas.notif=='Data gagal diupdate!'){
              alert('Data gagal diupdate!');
              $('#exampleModalanggota').modal('hide');
              return false;
            }else{
              $('.tradibatal').hide();
              $('.tradi').hide();
              $('.showform').hide();

              $('.trade').show();
              $('.tradehapus').show();
              $('.hideform').show();

              $('.fotopost').html('<img class="card-img-top" height="150px" src="img/anggota/'+datas.foto_anggota+'">');
              $('.idanggotahide').val(datas.id_anggota);
              $('.namaanggota').text(UpperCaseFirstLetter(datas.nama_anggota));
              $('.teleponanggota').text(datas.tlp_anggota);
              $('.kelaminanggota').text(UpperCaseFirstLetter(datas.kelamin_anggota));
              $('.jabatananggota').text(UpperCaseFirstLetter(datas.jabatan_anggota));
              $('.statusanggota').text(UpperCaseFirstLetter(datas.status_anggota));

              $.post( uril+"viewajax/viewanggotaindex.php", { kirimdata: "datakirim"})
                .done(function( data ) {
                  $('.viewanggota').html(data);
              });

            }
          }
      });

    });


    $('.hapusanggota').on('click',function(e){
      e.preventDefault();
      var idasu=$('.idanggotahide').val();
      var onclicks=confirm('yakin akan hapus?');

      var optiontipe=$('.optiontipe').val();
      var keywordcari=$('.keywordcari').val();

      if(onclicks==true){
        $.ajax({
          url: uril+'delete/deleteanggota.php',
          type: 'GET',
          data: { id_anggota : idasu },
          dataType:'json',
          success:function(data){

            if(data.notif=='Hapus terlebih dahulu data pinjaman/denda dari anggota ini!'){
              alert(data.notif);
              return false;
            }else if(data.notif=='Data gagal dihapus!'){
              alert(data.notif);
              return false;
            }else{
              $('#exampleModalanggota').modal('hide');
              $.post( uril+"viewajax/viewanggotaindex.php", { kirimdata: "datakirim" })
                .done(function( data ) {
                  $('.viewanggota').html(data);
              });
              alert(data.notif);
            }

          }
        });
      }else{
        return false;
      }
    });


    $('.loadertambahuud').hide();
    $('.simpanuud').on('click',function(){
      var namauud=$('.namauud').val();
      $('.loadertambahuud').show();
      $('.hidetambahuud').hide();

      $.ajax({
        url: uril+'index.php',
        method: "POST",
        data: {namauud : namauud},
        dataType: "json",
        success:function(data){

          $('.loadertambahuud').hide();
          $('.hidetambahuud').show();
          if(data.notif=='UUD sudah ada!'){
            alert('('+namauud+') sudah ada dalam daftar!');
            return false;
          }else if(data.notif=='Nama UUD tidak boleh kosong!'){
            alert(data.notif);
            return false;
          }else{
            alert(data.notif);
            // $('#exampleModaluud').modal('hide');
            document.location.href='index.php';

          }

        }
      });

    });

    $('body').on('click','.tambahisi',function(){
      var iduud=$(this).data('iduud');
      var isitexta=$('.isitexta'+iduud).val();

      $.ajax({
        url: uril+'index.php',
        method: "POST",
        data: {iduud : iduud,isitexta : isitexta},
        dataType: "json",
        success:function(data){
          if(data.notif=='Text tidak boleh kosong!'){
            alert(data.notif);
            return false;
          }else if(data.notif=='Data gagal ditambah!'){
              alert(data.notif);
              return false;
          }else{
            $.post( uril+"viewajax/viewisiuud.php", { kirimisi: iduud })
                .done(function( data ) {
                  $('.viewisi'+iduud).html(data);
              });
            $('.isitexta'+iduud).val('');
          }

        }
      });

    });

    $('.menuuud').popover({
      html: true,
      trigger: 'hover focus'
    });

    $('body').on('click','.menuuud',function(e){
      e.preventDefault();
      $('.loaderupdate').show();
      $('.hideupdatebody').hide();
      var idupdate=$(this).data('idupdateuud');

      $.ajax({
          url: uril+'index.php',
          method: "POST",
          data: {idupdate : idupdate},
          dataType: "json",
          success:function(data){

            $('.hideupdatebody').show();
            $('.loaderupdate').hide();
            $('.hideidupdate').val(data.id_uud);
            $('.namaupdateuud').val(data.nama_uud);

          }
        });

    });


    $('body').on('click','.edituud',function(e){
      e.preventDefault();
      $('#Modalupdateuud').modal('show');
    });

    $('body').on('click','.hapusuud',function(e){
      e.preventDefault();
      var idhapusuud=$('.hideidupdate').val();
      var valupdatenama=$('.namaupdateuud').val();
      var confirmasi=confirm('Yakin ingin dihapus ('+valupdatenama+'), semua isinya juga akan dihapus!');
      if(confirmasi==false){
        return false;
      }else{
        document.location.href='delete/deleteuud.php?iduud='+idhapusuud;
      }
    });

    $('body').on('click','.editisiuud',function(){
      var idisi=$(this).data('idisi');
      var isiuud=$(this).data('isiuud');
      var iduuddata=$(this).data('iduud');
      $('#Modalupdateisi').modal('show');
      $('.validisi').val(idisi);
      $('.isitextupdate').val(isiuud);
      $('.validuud').val(iduuddata);

      // console.log(iduuddata);
    });


    $('.loaderupdateisi').hide();
    $('body').on('click','.updateisi',function(){
      var valueidisi=$('.validisi').val();
      var valuetextupdate=$('.isitextupdate').val();
      var valueiduud=$('.validuud').val();
      $('.loaderupdateisi').show();
      $('.hideupdateisi').hide();

      $.ajax({
        url: uril+'index.php',
        method: "POST",
        data: {valueidisi : valueidisi, valuetextupdate : valuetextupdate},
        dataType: "json",
        success:function(data){

          $('.loaderupdateisi').hide();
          $('.hideupdateisi').show();
          if(data.notif=='Text tidak boleh kosong!'){
            alert(data.notif);
            return false;
          }else if(data.notif=='Data gagal ditambah!'){
              alert(data.notif);
              $('#Modalupdateisi').modal('hide');
              return false;
          }else{
            $('#Modalupdateisi').modal('hide');
            $.post( uril+"viewajax/viewisiuud.php", { kirimisi: valueiduud })
                .done(function( data ) {
                  $('.viewisi'+valueiduud).html(data);
              });
            $('.isitexta'+valueiduud).val('');
          }

        }
      });

    });


    $('body').on('click','.deleteisiuud',function(){
      var deliduud=$(this).data('iduud');
      var delidisi=$(this).data('idisi');
      var confirmalert=confirm('Yakin ingin dihapus?');
      if(confirmalert===false){
        return false;
      }else{
        $.ajax({
        url: uril+'delete/deleteisiuud.php',
        method: "POST",
        data: {delidisi : delidisi},
        dataType: "json",
        success:function(data){

          // console.log(data);
          if(data.notif=='Data gagal dihapus!'){
            alert(data.notif);
            return false;
          }else{
            $.post( uril+"viewajax/viewisiuud.php", { kirimisi: deliduud })
                .done(function( data ) {
                  $('.viewisi'+deliduud).html(data);
              });
          }

        }
      });

      }

    });

  </script>

<?php }else{} ?>
<?php }else{} ?>

</body>

</html>
