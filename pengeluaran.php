<?php  

    header('Access-Control-Allow-Origin: *');
    session_start();
    require_once'functions.php';
    if(!isset($_SESSION['login'])){
      pindahhalaman();
    }
    
    $data=getpengeluaran("SELECT * FROM pengeluaran ORDER BY id_pengeluaran DESC");

    $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran");
    $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);

    if(isset($_POST['confirmpengeluaran'])){
      tambahdatapengeluaran($_POST);
    }

    // if(isset($_POST['caripengeluaran'])){
    //   $keywordpengeluaran=htmlspecialchars($_POST['keywordpengeluaran']);
    //   $data=getpengeluaran("SELECT * FROM pengeluaran WHERE tanggal_pengeluaran LIKE '%$keywordpengeluaran%' ORDER BY id_pengeluaran DESC");

    //   $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran WHERE tanggal_pengeluaran LIKE '%$keywordpengeluaran%'");
    //   $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
    // }

    if(isset($_POST['caridatapengeluaran'])){
      $pilihtanggal=htmlspecialchars($_POST['pilihtanggal']);
      $pilihbulan=htmlspecialchars($_POST['pilihbulan']);
      $pilihtahun=htmlspecialchars($_POST['pilihtahun']);
      // var_dump($_POST);die;
      if($pilihtahun=='all'&&$pilihbulan=='all'&&$pilihtanggal=='all'){
        $merger="";
        $data=getpengeluaran("SELECT * FROM pengeluaran ORDER BY tanggal_pengeluaran DESC, id_pengeluaran DESC");

        $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran");
        $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
      }else if($pilihtahun=='all'&&$pilihbulan=='all'){
          // $merger=$pilihtanggal;
          $data=getpengeluaran("SELECT * FROM pengeluaran WHERE dayofmonth(tanggal_pengeluaran)='$pilihtanggal' ORDER BY tanggal_pengeluaran DESC, id_pengeluaran DESC");

          $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran WHERE dayofmonth(tanggal_pengeluaran)='$pilihtanggal'");
          $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
      }else if($pilihbulan=='all'&&$pilihtanggal=='all'){
          // $merger=$pilihtahun;
          $data=getpengeluaran("SELECT * FROM pengeluaran WHERE year(tanggal_pengeluaran)='$pilihtahun' ORDER BY tanggal_pengeluaran DESC, id_pengeluaran DESC");

          $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran WHERE year(tanggal_pengeluaran)='$pilihtahun'");
          $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
      }else if($pilihtanggal=='all'&&$pilihtahun=='all'){
          // $merger=$pilihbulan;
          $data=getpengeluaran("SELECT * FROM pengeluaran WHERE month(tanggal_pengeluaran)='$pilihbulan' ORDER BY tanggal_pengeluaran DESC, id_pengeluaran DESC");

          $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran WHERE month(tanggal_pengeluaran)='$pilihbulan'");
          $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
      }else{

        if($pilihtahun=='all'){
          // $merger=$pilihbulan."-".$pilihtanggal;
          $data=getpengeluaran("SELECT * FROM pengeluaran WHERE month(tanggal_pengeluaran)='$pilihbulan' and dayofmonth(tanggal_pengeluaran)='$pilihtanggal' ORDER BY tanggal_pengeluaran DESC, id_pengeluaran DESC");

          $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran WHERE month(tanggal_pengeluaran)='$pilihbulan' and dayofmonth(tanggal_pengeluaran)='$pilihtanggal'");
          $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
        }else if($pilihbulan=='all'){
          $data=getpengeluaran("SELECT * FROM pengeluaran WHERE year(tanggal_pengeluaran)='$pilihtahun' and dayofmonth(tanggal_pengeluaran)='$pilihtanggal' ORDER BY tanggal_pengeluaran DESC, id_pengeluaran DESC");

          $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran WHERE year(tanggal_pengeluaran)='$pilihtahun' and dayofmonth(tanggal_pengeluaran)='$pilihtanggal'");
          $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
        }else if($pilihtanggal=='all'){
          // $merger=$pilihtahun."-".$pilihbulan;
          $data=getpengeluaran("SELECT * FROM pengeluaran WHERE year(tanggal_pengeluaran)='$pilihtahun' and month(tanggal_pengeluaran)='$pilihbulan' ORDER BY tanggal_pengeluaran DESC, id_pengeluaran DESC");

          $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran WHERE year(tanggal_pengeluaran)='$pilihtahun' and month(tanggal_pengeluaran)='$pilihbulan'");
          $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
        }else{
          // $merger=$pilihtahun."-".$pilihbulan."-".$pilihtanggal;
          $data=getpengeluaran("SELECT * FROM pengeluaran WHERE year(tanggal_pengeluaran)='$pilihtahun' and month(tanggal_pengeluaran)='$pilihbulan' and dayofmonth(tanggal_pengeluaran)='$pilihtanggal' ORDER BY tanggal_pengeluaran DESC, id_pengeluaran DESC");

          $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran WHERE year(tanggal_pengeluaran)='$pilihtahun' and month(tanggal_pengeluaran)='$pilihbulan' and dayofmonth(tanggal_pengeluaran)='$pilihtanggal'");
          $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
        }
      }

    }

    if(isset($_POST['updateconfirm'])){
      $updateid=htmlspecialchars($_POST['updateid']);
      $updateketerangan=htmlspecialchars($_POST['updateketerangan']);
      $updatetanggal=htmlspecialchars($_POST['updatetanggal']);
      $updatejumlah=htmlspecialchars($_POST['updatejumlah']);

      $updatedatapemasukan=mysqli_query($conn,"UPDATE pengeluaran SET keterangan_pengeluaran='$updateketerangan',tanggal_pengeluaran='$updatetanggal',jumlah_pengeluaran='$updatejumlah' WHERE id_pengeluaran='$updateid'");
      $notif=mysqli_affected_rows($conn);
        if($notif>0){
          echo"<script>
              alert('Data berhasil diupdate!');
              document.location.href='pengeluaran.php';
            </script>";
        }else{
          echo"<script>
              alert('Data gagal diupdate!');
              document.location.href='pengeluaran.php';
            </script>";
        }
    }

    if(isset($_POST['idpost'])){
      $datapostid=htmlspecialchars($_POST['idpost']);

      $querypost=mysqli_query($conn,"SELECT * FROM pengeluaran WHERE id_pengeluaran='$datapostid'");
      $fetquerypost=mysqli_fetch_assoc($querypost);
      echo json_encode($fetquerypost);
      return false;
      exit;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>halaman pengeluaran</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style type="text/css">
    .muter{
      -webkit-transform:rotate(0deg);
      transition: .5s;
    }
    .muter:hover{
      -webkit-transform:rotate(-180deg);
      transition: .5s;
      color: black;
    }
    .ukuran{
      font-size: 20px;
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
        <a class="nav-link" href="anggota.php">
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
        <a class="nav-link bg-info" href="pengeluaran.php">
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
    <?php }else{echo "";} ?>

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
                  <i class="fas fa-fw fa-power-off"></i>
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
              <h4 class="text-left">Pengeluaran</h4>
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

      <!-- form tambah pemasukan -->
      <?php if(isset($_SESSION['login'])){ ?>
        <?php if($_SESSION['login']=='admin'){ ?>
        <button id="trigerpengeluaran" class="btn btn-primary mb-4">
          <i id="iconic" class="fas fa-fw fa-plus"></i> <span id="ubahtriger">Add</span></button>
        <form action="" method="post" class="mb-4" id="slidepengeluaran">
          <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:100px;">Keterangan</span>
          </div>
          <input type="text" class="form-control" placeholder="masukan keterangan" aria-label="Username" aria-describedby="basic-addon1" name="keteranganpengeluaran" autocomplete="off" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:100px;">Tanggal</span>
          </div>
          <input type="date" class="form-control" placeholder="masukan tanggal" aria-label="Username" aria-describedby="basic-addon1" name="tanggalpengeluaran" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:100px;">Jumlah</span>
          </div>
          <input type="number" class="form-control" placeholder="masukan jumlah" aria-label="Username" aria-describedby="basic-addon1" name="jumlahpengeluaran" autocomplete="off" required>
        </div>
        <button type="submit" class="btn btn-primary" name="confirmpengeluaran">Confirm <i class="far fa-fw fa-arrow-alt-circle-right"></i></button>
        </form>
        <?php }else{echo "";} ?>
      <?php }else{echo "";} ?>

        <!-- <form class="form-inline mb-2" action="" method="post" style="width: 14rem">
          <div class="input-group">
            <div class="input-group-prepend">
            </div>
            <input type="text" class="form-control" placeholder="Ketik tanggal..." aria-label="Username" aria-describedby="basic-addon1" style="border-radius:5px;" name="keywordpengeluaran" autocomplete="off" value="<?php if(isset($_POST['caripengeluaran'])){echo $_POST['keywordpengeluaran'];} ?>">
            <button class="input-group-text" id="basic-addon1" name="caripengeluaran">cari</button>
          </div>
        </form> -->

        <form class="form-inline mb-2" action="" method="post" style="">
          <div class="input-group">
            <div class="input-group-prepend">
            </div>

              <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtanggal">
                <option value="all">tgl</option>
              <?php if(isset($_POST['caridatapengeluaran'])){ ?>

                <?php for($datatanggal=1;$datatanggal<32;$datatanggal++){ ?>
                  <?php if($datatanggal<10){ ?>

                    <?php if("0".$datatanggal==$_POST['pilihtanggal']){ ?>
                    <option <?="selected"; ?> value="<?='0'.$datatanggal; ?>"><?='0'.$datatanggal; ?></option>
                    <?php }else{ ?>
                    <option value="<?='0'.$datatanggal; ?>"><?='0'.$datatanggal; ?></option>
                    <?php } ?>

                  <?php }else{ ?>

                    <?php if($datatanggal==$_POST['pilihtanggal']){ ?>
                    <option <?="selected"; ?> value="<?=$datatanggal; ?>"><?=$datatanggal; ?></option>
                    <?php }else{ ?>
                    <option value="<?=$datatanggal; ?>"><?=$datatanggal; ?></option>
                    <?php } ?>

                  <?php } ?>
                <?php } ?>

              <?php }else{ ?>

                <?php for($datatanggal=1;$datatanggal<32;$datatanggal++){ ?>
                  <?php if($datatanggal<10){ ?>
                    <option value="<?='0'.$datatanggal; ?>"><?='0'.$datatanggal; ?></option>
                  <?php }else{ ?>
                    <option value="<?=$datatanggal; ?>"><?=$datatanggal; ?></option>
                  <?php } ?>
                <?php } ?>

              <?php } ?>
              </select>

              <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihbulan">
                <option value="all">bln</option>
                <?php if(isset($_POST['caridatapengeluaran'])){ ?>

                <?php for($databulan=1;$databulan<13;$databulan++){ ?>
                  <?php if($databulan<10){ ?>

                    <?php if("0".$databulan==$_POST['pilihbulan']){ ?>
                      <option <?="selected"; ?> value="<?='0'.$databulan; ?>"><?='0'.$databulan; ?></option>
                    <?php }else{ ?>
                      <option value="<?='0'.$databulan; ?>"><?='0'.$databulan; ?></option>
                    <?php } ?>

                  <?php }else{ ?>

                    <?php if($databulan==$_POST['pilihbulan']){ ?>
                      <option <?="selected"; ?> value="<?=$databulan; ?>"><?=$databulan; ?></option>
                    <?php }else{ ?>
                      <option value="<?=$databulan; ?>"><?=$databulan; ?></option>
                    <?php } ?>

                  <?php } ?>
                <?php } ?>

                <?php }else{ ?>

                  <?php for($databulan=1;$databulan<13;$databulan++){ ?>
                  <?php if($databulan<10){ ?>
                    <option value="<?='0'.$databulan; ?>"><?='0'.$databulan; ?></option>
                  <?php }else{ ?>
                    <option value="<?=$databulan; ?>"><?=$databulan; ?></option>
                  <?php } ?>
                <?php } ?>

                <?php } ?>
              </select>

              <select class="custom-select" id="inputGroupSelect01" style="border-radius:5px;" name="pilihtahun">
                <option value="all">thn</option>
                <?php if(isset($_POST['caridatapengeluaran'])){ ?>

                  <?php $tahun=date("Y"); for($datatahun=2018; $datatahun<$tahun+1; $datatahun++){ ?>
                    <?php if($datatahun==$_POST['pilihtahun']){ ?>
                      <option <?="selected"; ?> value="<?=$datatahun; ?>"><?=$datatahun; ?></option>
                    <?php }else{ ?>
                      <option value="<?=$datatahun; ?>"><?=$datatahun; ?></option>
                    <?php } ?>
                  <?php } ?>

                <?php }else{ ?>

                  <?php $tahun=date("Y"); for($datatahun=2018; $datatahun<$tahun+1; $datatahun++){ ?>
                    <option value="<?=$datatahun; ?>"><?=$datatahun; ?></option>
                  <?php } ?>

                <?php } ?>
              </select>

              <button class="btn btn-info" id="basic-addon1" name="caridatapengeluaran" style=""><i class="fas fa-fw fa-search"></i></button>
          </div>
        </form>

        <?php if($totalpengeluaran['total']==null){ ?>
          <h1 class="mt-5 text-center">Tidak ada data!</h1>
        <?php }else{ ?>

        <div class="alert alert-info text-right mt-2" role="alert" style="margin-bottom: 1px">
          <span class="">Total : Rp <?=str_replace(',','.',number_format($totalpengeluaran['total'])); ?></span>
        </div>

      <!-- table pengeluaran -->
      <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Ket</th>
            <th scope="col">Tgl</th>
            <th scope="col">Jmlh</th>
            <?php if(isset($_SESSION['login'])){ ?>
              <?php if($_SESSION['login']=='admin'){ ?>
            <!-- <th scope="col">Aksi</th> -->
              <?php }else{echo "";} ?>
            <?php }else{echo "";} ?>
          </tr>
        </thead>
        <tbody>

          <?php $no=1; foreach($data as $d): ?>
            <tr>
              <th scope="row"><?=$no; ?></th>
              <td><?=$d['keterangan_pengeluaran']; ?></td>
              <td><?=date('d-m-Y', strtotime($d['tanggal_pengeluaran'])); ?></td>
              <td>Rp <?=str_replace(',','.',number_format($d['jumlah_pengeluaran'])); ?></td>
              <?php if(isset($_SESSION['login'])){ ?>
                <?php if($_SESSION['login']=='admin'){ ?>
              <td>
                <a tabindex="0" class="badge float-right asd" role="button" data-toggle="popover" data-trigger="focus" title="<?=$d['keterangan_pengeluaran']; ?>" data-html="true" data-content='<div class="text-center"><a href="" data-idanjing="<?=$d['id_pengeluaran']; ?>"><div class="btn davu fuck"><i class="fas fa-fw fa-edit text-success ukuran"></i></div></a>||<a href="delete/deletepengeluaran.php?idpengeluaran=<?=$d['id_pengeluaran']; ?>"><div class="btn returne"><i class="fas fa-fw fa-trash-alt text-danger ukuran"></i></div></a></div>'><i class="fas fa-fw fa-cog muter" style="font-size: 20px;" data-idpemasukan="<?=$d['id_pengeluaran']; ?>"></i></a>

                <!-- <a href="delete/deletepengeluaran.php?idpengeluaran=<?=$d['id_pengeluaran']; ?>" class="badge" onclick="return confirm('yakin ingin hapus?')"><i class="far fa-fw fa-trash-alt" style="font-size: 25px;color: red"></a> -->
              </td>
                <?php }else{echo "";} ?>
              <?php }else{echo "";} ?>
            </tr>
          <?php $no++; endforeach; ?>

        </tbody>
      </table>
      <?php } ?>

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

   <!-- <div class="anjing"> -->
    <?php if(isset($_SESSION['login'])){ ?>
      <?php if($_SESSION['login']=='admin'){ ?>
      <div class="modal fade collapse show" id="exampleModalasu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Data Pengeluaran <span class="loader"><img src="img/loader.gif" width="22"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body datahide">
              <form action="" method="post" class="mb-4">
                <input type="hidden" name="updateid" class="updateid">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" style="width:100px;">Keterangan</span>
                </div>
                <input type="text" class="form-control updateketerangan" placeholder="masukan keterangan" aria-label="Username" aria-describedby="basic-addon1" name="updateketerangan" autocomplete="off" required>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" style="width:100px;">Tanggal</span>
                </div>
                <input type="date" class="form-control updatetanggal" placeholder="masukan tanggal" aria-label="Username" aria-describedby="basic-addon1" name="updatetanggal" required>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1" style="width:100px;">Jumlah</span>
                </div>
                <input type="number" class="form-control updatejumlah" placeholder="masukan jumlah" aria-label="Username" aria-describedby="basic-addon1" name="updatejumlah" autocomplete="off" required>
              </div>
              <button type="submit" class="btn btn-primary" name="updateconfirm">Confirm <i class="far fa-fw fa-arrow-alt-circle-right"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php }else{} ?>
    <?php }else{} ?>
<!-- </div> -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
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
  <?php if(isset($_SESSION['login'])){ ?>
  <script type="text/javascript">
    $('#slidepengeluaran').hide();
      var triger=1;
    $('#trigerpengeluaran').on('click',function(){
      triger=triger+1;
      if(triger==3){
        triger=1;
      }
      if(triger==1){
        $('#ubahtriger').html('Add');
        $('#trigerpengeluaran').removeClass('btn-danger');
        $('#iconic').addClass('fa-plus');
        $('#iconic').removeClass('fa-times');
      }else{
        $('#ubahtriger').html('');
        $('#trigerpengeluaran').addClass('btn-danger');
        $('#iconic').removeClass('fa-plus');
        $('#iconic').addClass('fa-times');
      }

      $('#slidepengeluaran').slideToggle();
    });

     $('.asd').popover({
        trigger: 'hover focus'
    });

    $('body').on('click','.returne',function(){
      return confirm('yakin ingin hapus?');
    });

    $('body').on('click','.muter',function(){
      var anjing=$(this).data('idpemasukan');
      $('.datahide').hide();
      $('.loader').show();
       $.ajax({
          url: 'https://sttkertasari.000webhostapp.com/pengeluaran.php',
          method: "POST",
          data: 'idpost=' + anjing,
          dataType: "json",
          success:function(data){
            // console.log(data);
            $('.updateid').val(data.id_pengeluaran);
            $('.updateketerangan').val(data.keterangan_pengeluaran);
            $('.updatetanggal').val(data.tanggal_pengeluaran);
            $('.updatejumlah').val(data.jumlah_pengeluaran);

            $('.datahide').show();
            $('.loader').hide();
          }
        });
    });

    $('body').on('click','.davu',function(e){
        e.preventDefault();
        $('#exampleModalasu').modal('show');
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
  <?php }else{} ?>

</body>

</html>