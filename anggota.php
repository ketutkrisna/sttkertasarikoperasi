<?php  
  
  session_start();
  // sleep(2);
  require_once 'functions.php';
  $data=anggota("SELECT * FROM anggota WHERE (status_anggota='aktif' or status_anggota='non aktif') ORDER BY status_anggota,nama_anggota");
  $countanggota= mysqli_num_rows($data);
  // $tambahanggota=tambahanggota($_POST);
if(isset($_SESSION['login'])){
if($_SESSION['login']=='admin'){

  if(isset($_POST['namaanggota'])){
    $namaanggota=htmlspecialchars(strtolower($_POST['namaanggota']));
    $tlpanggota=htmlspecialchars($_POST['tlpanggota']);
    $kelaminanggota=htmlspecialchars($_POST['kelaminanggota']);
    $jabatananggota=htmlspecialchars($_POST['jabatananggota']);
    $statusanggota=htmlspecialchars($_POST['statusanggota']);

    $ceknama=anggota("SELECT * FROM anggota WHERE nama_anggota='$namaanggota'");
    $fetasu=mysqli_fetch_assoc($ceknama);
    if($fetasu){
      $datanotif=['notif'=>'Nama sudah ada!'];
      echo json_encode($datanotif);
      return false;
    }

    $datakosonga=trim($namaanggota);
    if(empty($datakosonga)){
      $datanotif=['notif'=>'Nama tidak boleh kosong!'];
      echo json_encode($datanotif);
      return false;
    }

    if(!$_FILES){
      $foto='default.jpg';
    }else{
      $foto=uploadfotoanggota();
    }

    // var_dump($foto);die;
      
    $query="INSERT INTO anggota VALUES(null,'$foto','$namaanggota','$tlpanggota','$kelaminanggota','$jabatananggota','$statusanggota')
      ";
    $mysqli=mysqli_query($conn,$query);
    $notif=mysqli_affected_rows($conn);
    if($notif>0){
      // echo"<script>
      //     alert('Data berhasil ditambah!');
      //     document.location.href='anggota.php';
      //   </script>";
        $datanotif=['notif'=>'Data berhasil ditambah!'];
        echo json_encode($datanotif);
        return exit;
    }else{
      // echo"<script>
      //     alert('Data gagal ditambah!');
      //     document.location.href='anggota.php';
      //   </script>";
        $datanotif=['notif'=>'Data gagal ditambah!'];
        echo json_encode($datanotif);
        return exit;
      }
    
  }

}else{echo "";}
}else{echo "";}

  // $blank=0;
  // if(isset($_POST['carianggota'])){
  //   $pilihtipe=htmlspecialchars($_POST['pilihtipe']);
  //   $keywordcari=htmlspecialchars($_POST['keywordcari']);
  //   $blank=1;
  //   if($pilihtipe==='all'){
  //     $data=mysqli_query($conn,"SELECT * FROM anggota WHERE nama_anggota LIKE '%$keywordcari%' ORDER BY nama_anggota");
  //     $countanggota= mysqli_num_rows($data);
  //   }else{
  //   $data=mysqli_query($conn,"SELECT * FROM anggota WHERE nama_anggota LIKE '%$keywordcari%' and status_anggota ='$pilihtipe' ORDER BY nama_anggota");
  //     $countanggota= mysqli_num_rows($data);
  //   }
  // }

  if(isset($_POST['idpost'])){
      $datapostid=htmlspecialchars($_POST['idpost']);

      $querypost=mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$datapostid'");
      $fetquerypost=mysqli_fetch_assoc($querypost);
      echo json_encode($fetquerypost);
      return false;
      exit;
    }

if(isset($_SESSION['login'])){
if($_SESSION['login']=='admin'){

  if(isset($_POST['namaa'])||isset($_FILES['fotoa'])){
    $idanggotahide=htmlspecialchars($_POST['idanggotahide']);
    $fotolamapost=htmlspecialchars($_POST['fotolamapost']);
    $namaa=htmlspecialchars(strtolower($_POST['namaa']));
    $telepona=htmlspecialchars($_POST['telepona']);
    $kelamina=htmlspecialchars($_POST['kelamina']);
    $jabatana=htmlspecialchars($_POST['jabatana']);
    $statusa=htmlspecialchars($_POST['statusa']);

    $ceknamaup=anggota("SELECT * FROM anggota WHERE nama_anggota='$namaa' and id_anggota='$idanggotahide'");
    $fetasuup=mysqli_fetch_assoc($ceknamaup);

    $ceknamaupa=anggota("SELECT * FROM anggota WHERE nama_anggota='$namaa' and id_anggota!='$idanggotahide'");
    $fetasuupa=mysqli_fetch_assoc($ceknamaupa);

    if($fetasuup){
      // data kosong
    }else if($fetasuupa){
      $datanotif=['notif'=>'Nama sudah ada!'];
      echo json_encode($datanotif);
      return exit;
    }

    $datakosong=trim($namaa);
    if(empty($datakosong)){
      $datanotif=['notif'=>'Nama tidak boleh kosong!'];
      echo json_encode($datanotif);
      return exit;
    }else{
      $namabaru=trim($namaa);
      $stringbaru = preg_replace('/\s+/', ' ', $namabaru);
    }

    if(!$_FILES){
      $foto=$fotolamapost;
    }else{
      $foto =updatefoto($idanggotahide);
      $get_anggota=get_anggota($idanggotahide);
      if($get_anggota['foto_anggota'] != 'default.jpg'){
        unlink("img/anggota/".$get_anggota['foto_anggota']);
      }
    }

      $query="UPDATE anggota SET
          foto_anggota='$foto',
          nama_anggota='$stringbaru',
          tlp_anggota='$telepona',
          kelamin_anggota='$kelamina',
          jabatan_anggota='$jabatana',
          status_anggota='$statusa'
          WHERE id_anggota='$idanggotahide'
        ";
      $mysqli=mysqli_query($conn,$query);
      $notif=mysqli_affected_rows($conn);
      // var_dump($notif);die;
      if($notif>0){
        $querypostupdate=mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$idanggotahide'");
        $fetquerypostupdate=mysqli_fetch_assoc($querypostupdate);
        echo json_encode($fetquerypostupdate);
        return false;
        // exit;
        // echo'success';
      }else{
        // $querypostupdate=mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$idanggotahide'");
        // $fetquerypostupdate=mysqli_fetch_assoc($querypostupdate);
        // echo json_encode($fetquerypostupdate);

        $datanotif=['notif'=>'Data gagal diupdate!'];
        echo json_encode($datanotif);
        return false;
        // exit;
      }
      // return false;
      // exit;
  }

}else{echo "";}
}else{echo "";}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>halaman anggota</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <style type="text/css">
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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
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
        <a class="nav-link bg-info" href="anggota.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Anggota</span></a>
      </li>

    <?php if(isset($_SESSION['login'])){ ?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="pemasukan.php">
          <i class="fas fa-fw fa-sign-in-alt"></i>
          <span>Pemasukan</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="pengeluaran.php">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDenda" aria-expanded="true" aria-controls="collapseTwo">
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
        <a class="nav-link" href="sumbangan.php">
          <i class="fas fa-fw fa-hand-holding-usd"></i>
          <span>Sumbangan</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="rekap.php">
          <i class="fab fa-fw fa-readme"></i>
          <span>Rekap</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="saldo.php">
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">

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
        <nav class="navbar topbar scrl" style="top:0;width: 100%;">
          <!-- <div class="container"> -->
            <div class="row">
              <div class="col-12">
              <h4 class="text-left">Anggota</h4>
              </div>
            </div>
          <!-- </div> -->
        </nav>

        <nav class="navbar topbar aspal" style="">
          <!-- <div class="container"> -->
            <div class="row">
              <h4 class=""></h4>
            </div>
          <!-- </div> -->
        </nav>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <!-- <h1 class="h3 mb-0 text-gray-800">Anggota</h1> -->
          </div>

      <!-- Button trigger modal -->
      <?php if(isset($_SESSION['login'])){ ?>
        <?php if($_SESSION['login']=='admin'){ ?>
        <button type="button" class="btn btn-primary buttontambah" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-fw fa-plus"></i> Add
        </button>
        <?php }else{echo'';} ?>
      <?php }else{echo"";} ?>

      
      <?php if(isset($_SESSION['login'])){ ?>
      <!-- <?php if($blank==0){ ?> -->
          <a href="cetak.php" class="printajax" target="_blank"><div class="btn float-right"><span class="mr-1">Print</span><img src="img/printer.png" width="25"></div></a><br><br>
      <!-- <?php }else{ ?> -->
          <!-- <a href="cetak.php?key=<?=$keywordcari; ?>&type=<?=$pilihtipe; ?>" class="printajax"><div class="btn float-right"><span class="mr-1">Print</span><img src="img/printer.png" width="25"></div></a><br><br> -->
      <!-- <?php } ?> -->
      <?php } ?>

      <form class="form-inline mb-2" action="" method="post">
        <div class="input-group">
          <div class="input-group-prepend">
          </div>
          <input type="text" class="form-control keywordcari" placeholder="Ketik nama..." aria-label="Username" aria-describedby="basic-addon1" style="border-radius:5px;" name="keywordcari" autocomplete="off" value="<?php if(isset($_POST['carianggota'])){echo $_POST['keywordcari'];} ?>">

            <select class="custom-select optiontipe" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtipe">
              <option value="aktif / non aktif" class="opo">--Pilih--</option>
              <option value="all">All</option>
              <option value="aktif">Aktif</option>
              <option value="non aktif">Non aktif</option>
              <option value="menikah">Menikah</option>
              <option value="drop out">Drop out</option>
            </select>

        <!-- <?php if(isset($_POST['carianggota'])){ ?>
          <?php if($_POST['pilihtipe']==='all'){ ?>
          <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtipe">
            <option selected value="all">All</option>
            <option value="aktif">Aktif</option>
            <option value="non aktif">Non aktif</option>
            <option value="menikah">Menikah</option>
            <option value="drop out">Drop out</option>
          </select>
          <?php }else if($_POST['pilihtipe']=='aktif'){ ?>
          <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtipe">
            <option value="all">All</option>
            <option selected value="aktif">Aktif</option>
            <option value="non aktif">Non aktif</option>
            <option value="menikah">Menikah</option>
            <option value="drop out">Drop out</option>
          </select>
          <?php }else if($_POST['pilihtipe']=='non aktif'){ ?>
          <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtipe">
            <option value="all">All</option>
            <option value="aktif">Aktif</option>
            <option selected value="non aktif">Non aktif</option>
            <option value="menikah">Menikah</option>
            <option value="drop out">Drop out</option>
          </select>
          <?php }else if($_POST['pilihtipe']=='menikah'){ ?>
          <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtipe">
            <option value="all">All</option>
            <option value="aktif">Aktif</option>
            <option value="non aktif">Non aktif</option>
            <option selected value="menikah">Menikah</option>
            <option value="drop out">Drop out</option>
          </select>
          <?php }else{ ?>
            <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtipe">
            <option value="all">All</option>
            <option value="aktif">Aktif</option>
            <option value="non aktif">Non aktif</option>
            <option value="menikah">Menikah</option>
            <option selected value="drop out">Drop out</option>
          </select>
          <?php } ?>
        <?php }else{ ?>
          <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtipe">
            <option value="all">All</option>
            <option value="aktif">Aktif</option>
            <option value="non aktif">Non aktif</option>
            <option value="menikah">Menikah</option>
            <option value="drop out">Drop out</option>
          </select>
        <?php } ?> -->
          <!-- <?php if(isset($_SESSION['login'])){ ?>
          <?php if($_SESSION['login']=='admin'){ ?> -->
            <!-- <button class="btn btn-info buttoncari" id="basic-addon1" name="carianggota"><i class="fas fa-fw fa-search"></i></button> -->
          <!-- <?php }else{} ?>
          <?php }else{} ?> -->
        </div>
      </form>

      <?php if($countanggota==0){ ?>
        <h1 class="mt-5 text-center">Tidak ada data!</h1>
      <?php }else{ ?>

      <div class="list-group">
        <li class="list-group-item list-group-item-action text-center" style="background-color:#ccc;">
        <!-- <?php if(isset($_POST['carianggota'])){ echo $_POST['pilihtipe'];}else{echo'all';} ?> -->
          <span class="valuecari">aktif / non aktif</span><span class="loadere ml-3"><img src="img/loader.gif" width="22"></span>
        </li>

        <div class="viewanggota">
          <?php $no=1; ?>
          <?php foreach($data as $a): ?>
            
            <div class="list-group-item list-group-item-action detailanggota" data-toggle="modal" data-target="#exampleModalanggota" data-idanggota="<?=$a['id_anggota']; ?>" style="border-radius:10px; color: 
            <?php if($a['status_anggota']=='drop out'){
              echo'red';
            }else if($a['status_anggota']=='menikah'){
              echo'orange';
            }else if($a['status_anggota']=='non aktif'){
              echo 'green';
            }else{
              echo 'blue';
            }
            ?>
            ;">
              <img class="img-profile rounded-circle" src="img/anggota/<?=$a['foto_anggota']; ?>" width="30" height="30">
              <?=ucwords(strtolower($a['nama_anggota'])); ?> 
              <?php
                 if($a['jabatan_anggota']=='ketua'){
                  echo '<i><span style="color:red;font-size:13px;">(ketua)</span></i>';
                 }else if($a['jabatan_anggota']=='wakil'){
                  echo '<i><span style="color:red;font-size:13px;">(wakil)</span></i>';
                 }else if($a['jabatan_anggota']=='bendahara'){
                  echo '<i><span style="color:red;font-size:13px;">(bendahara)</span></i>';
                 }else if($a['jabatan_anggota']=='humas'){
                  echo '<i><span style="color:red;font-size:13px;">(humas)</span></i>';
                 }
              ?> 
              <span class="float-right"><?=$no; ?></span> 
            </div>

          <?php $no++; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <?php } ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- modal tambah anggota -->

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

      <!-- Modal -->
      <?php if(isset($_SESSION['login'])){ ?>
        <?php if($_SESSION['login']=='admin'){ ?>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah data anggota <span class="loaderes"><img src="img/loader.gif" width="22"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          <div class="datahides">
            <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:100px;">Nama</span>
                  </div>
                  <input type="text" class="form-control tambahnama" placeholder="masukan nama anggota baru" aria-label="Username" aria-describedby="basic-addon1" name="namaanggota" autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:100px;">Tlp</span>
                  </div>
                  <input type="number" class="form-control tambahtelepon" placeholder="masukan no tlp" aria-label="Username" aria-describedby="basic-addon1" name="tlpanggota" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:100px;">Kelamin</label>
                  </div>
                  <select class="custom-select tambahkelamin" id="inputGroupSelect01" name="kelaminanggota" required>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:100px;">Jabatan</label>
                  </div>
                  <select class="custom-select tambahjabatan" id="inputGroupSelect01" name="jabatananggota" required>
                    <option value="anggota">Anggota</option>
                    <option value="humas">Humas</option>
                    <option value="bendahara">Bendahara</option>
                    <option value="wakil">Wakil</option>
                    <option value="ketua">Ketua</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:100px;">Status</label>
                  </div>
                  <select class="custom-select tambahstatus" id="inputGroupSelect01" name="statusanggota" required>
                    <option value="aktif">Aktif</option>
                    <option value="non aktif">Non aktif</option>
                    <option value="menikah">Menikah</option>
                    <option value="drop out">Drop out</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:100px;">foto</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" name="foto" class="tambahfoto">
                  </div>
                </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary tambahanggota" name="tambahanggota">Confirm <i class="far fa-fw fa-arrow-alt-circle-right"></i></button>
            </div>
            </form>
          </div>

          </div>
        </div>
      </div>
      <?php }else{echo"";} ?>
      <?php }else{echo'';} ?>

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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  </div>

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


    $('.aspal').hide();
    $(window).scroll(function(){
      var wScroll=$(this).scrollTop();
      // console.log(wScroll);
      if(wScroll>70){
        $('.aspal').show();
        $('.scrl').css('z-index','9');
        $('.scrl').css('position','fixed');
        $('.scrl').addClass('navbar-light');
        $('.scrl').addClass('bg-white');
        $('.scrl').addClass('shadow');
        // $('.scrl').css('transition','.4s');
      }else{
        $('.scrl').css('z-index','9');
        $('.scrl').css('position','static');
        $('.aspal').hide();
        $('.scrl').removeClass('navbar-light');
        $('.scrl').removeClass('bg-white');
        $('.scrl').removeClass('shadow');
        $('.scrl').css('transition','.4s');
      }
    });

  </script>

<?php if(isset($_SESSION['login'])){ ?>

  <script type="text/javascript">

      $('.printajax').on('click',function(e){
      e.preventDefault();
      window.open('cetak.php?key='+$(".keywordcari").val()+'&type='+$(".optiontipe").val(),'_blank');
    });

  </script>

<?php }else{} ?>


<?php if(isset($_SESSION['login'])){ ?>
<?php if($_SESSION['login']=='admin'){ ?>

  <script type="text/javascript">
      // $('.buttoncari').hide();
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


    $('.buttontambah').on('click',function(){
      $('.tambahnama').val('');
      $('.tambahtelepon').val('');
      $('.tambahfoto').val('');
    });


      $('.loaderes').hide();
    $('.tambahanggota').on('click',function(e){

      e.preventDefault();
      $('.loaderes').show();
      // $('.datahides').hide();
      var optiontipe=$('.optiontipe').val();
      var keywordcari=$('.keywordcari').val();

      var formTambah = new FormData();
      var tambahfoto = $('.tambahfoto')[0].files[0];

      formTambah.append('namaanggota', $('.tambahnama').val());
      formTambah.append('tlpanggota', $('.tambahtelepon').val());
      formTambah.append('kelaminanggota', $('.tambahkelamin').val());
      formTambah.append('jabatananggota', $('.tambahjabatan').val());
      formTambah.append('statusanggota', $('.tambahstatus').val());
      formTambah.append('foto', tambahfoto);

      $('.loaderes').show();
      $('.datahides').hide();
      $.ajax({
          url: uril+'anggota.php',
          type: 'POST',
          data: formTambah,
          contentType: false,
          processData: false,
          enctype: 'multipart/form-data',
          cache:false,
          dataType:"json",
          success: function(data){

            $('.loaderes').hide();
            $('.datahides').show();
            if(data.notif=='Yang anda upload bukan gambar!'){
              alert(data.notif);
              return false;
            }else if(data.notif=='Ukuran gambar terlalu besar max ukuran 1.5 mb'){
              alert(data.notif);
              return false;
            }else if(data.notif=='Nama tidak boleh kosong!'){
              alert(data.notif);
              return false;
            }else if(data.notif=='Data gagal ditambah!'){
              alert(data.notif);
              return false;
            }else if(data.notif=='Nama sudah ada!'){
              alert('Nama ('+$('.tambahnama').val()+') sudah ada dalam daftar');
              return false;
            }else{
              $('#exampleModal').modal('hide');
              $.post( uril+"viewajax/viewanggota.php", { optiontipe: optiontipe,keywordcari:keywordcari})
                .done(function( data ) {
                  $('.viewanggota').html(data);
              });
              alert(data.notif);
            }

          }
      });

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

              $.post( uril+"viewajax/viewanggota.php", { optiontipe: optiontipe,keywordcari:keywordcari})
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
              $.post( uril+"viewajax/viewanggota.php", { optiontipe: optiontipe,keywordcari:keywordcari})
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

  </script>

<?php }else{} ?>
<?php }else{} ?>

</body>

</html>
