<?php  
  
  session_start();
  require_once'functions.php';
    if(!isset($_SESSION['login'])){
      pindahhalaman();
    }
    
    date_default_timezone_set('Asia/Jakarta');
    $tglhariini=date("Y-m-d");
    // var_dump($tglhariini);die;
    // pemasukan{
    $data=getpemasukan("SELECT * FROM pemasukan where tanggal_pemasukan='$tglhariini' ORDER BY tanggal_pemasukan DESC, id_pemasukan DESC");
    $pemasukan=mysqli_query($conn,"SELECT SUM(jumlah_pemasukan) AS total FROM pemasukan where tanggal_pemasukan='$tglhariini'");
    $totalpemasukan=mysqli_fetch_assoc($pemasukan);
    // }
    // pengeluaran{
    $datapengeluaran=getpengeluaran("SELECT * FROM pengeluaran where tanggal_pengeluaran='$tglhariini' ORDER BY id_pengeluaran DESC");
    $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran where tanggal_pengeluaran='$tglhariini'");
    $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
    // }
    // pinjaman dibayar
      $pinjamandibayar=mysqli_query($conn,"SELECT SUM(jumlah_pembayaran) AS total FROM pembayaran WHERE tanggal_pembayaran='$tglhariini'");
      $totalpinjamandibayar=mysqli_fetch_assoc($pinjamandibayar);
     // denda dibayar
      $dendadibayar=mysqli_query($conn,"SELECT SUM(jumlah_bayardenda) AS total FROM bayardenda WHERE tanggal_bayardenda='$tglhariini'");
      $totaldendadibayar=mysqli_fetch_assoc($dendadibayar);
      // pinjaman belum lunas
      $pinjaman=mysqli_query($conn,"SELECT SUM(jumlah_pinjaman) AS total FROM pinjaman WHERE status_pinjaman='belum lunas' and tanggal_pinjaman='$tglhariini'");
      $totalpinjaman=mysqli_fetch_assoc($pinjaman)['total'];
      // data bunga
      $queryterbayarbunga=mysqli_query($conn,"SELECT SUM(jumlah_bunga)as total FROM bungapinjaman WHERE tanggal_bunga='$tglhariini'");
      $fetchterbayarbunga=mysqli_fetch_assoc($queryterbayarbunga);
      $jumlahbunga=$fetchterbayarbunga['total'];
      // denda
      $denda=mysqli_query($conn,"SELECT SUM(jumlah_denda) AS total FROM denda WHERE status_denda='belum bayar' and tanggal_denda='$tglhariini'");
      $totaldenda=mysqli_fetch_assoc($denda)['total'];
      // var_dump($totaldenda);die;
      // sumbangan
      $datasumbangan=getdatasumbangan("SELECT * FROM sumbangan where tanggal_sumbangan='$tglhariini' ORDER BY tanggal_sumbangan DESC,id_sumbangan DESC");
      $resultsumbangan=mysqli_query($conn,"SELECT SUM(jumlah_sumbangan) AS total FROM sumbangan where tanggal_sumbangan='$tglhariini'");
      $totalsumbangan=mysqli_fetch_assoc($resultsumbangan);


    // cari tanggal
    if(isset($_POST['caritanggal'])){
      $tglhariini=htmlspecialchars($_POST['keywordtanggal']);
      // pemasukan{
    $data=getpemasukan("SELECT * FROM pemasukan where tanggal_pemasukan='$tglhariini' ORDER BY tanggal_pemasukan DESC, id_pemasukan DESC");
    $pemasukan=mysqli_query($conn,"SELECT SUM(jumlah_pemasukan) AS total FROM pemasukan where tanggal_pemasukan='$tglhariini'");
    $totalpemasukan=mysqli_fetch_assoc($pemasukan);
    // }
    // pengeluaran{
    $datapengeluaran=getpengeluaran("SELECT * FROM pengeluaran where tanggal_pengeluaran='$tglhariini' ORDER BY id_pengeluaran DESC");
    $pengeluaran=mysqli_query($conn,"SELECT SUM(jumlah_pengeluaran) AS total FROM pengeluaran where tanggal_pengeluaran='$tglhariini'");
    $totalpengeluaran=mysqli_fetch_assoc($pengeluaran);
    // }
    // pinjaman dibayar{
      $pinjamandibayar=mysqli_query($conn,"SELECT SUM(jumlah_pembayaran) AS total FROM pembayaran WHERE tanggal_pembayaran='$tglhariini'");
      $totalpinjamandibayar=mysqli_fetch_assoc($pinjamandibayar);
      // }
      // pinjaman belum lunas
      $pinjaman=mysqli_query($conn,"SELECT SUM(jumlah_pinjaman) AS total FROM pinjaman WHERE status_pinjaman='belum lunas' and tanggal_pinjaman='$tglhariini'");
      $totalpinjaman=mysqli_fetch_assoc($pinjaman)['total'];
      // data bunga
      $queryterbayarbunga=mysqli_query($conn,"SELECT SUM(jumlah_bunga)as total FROM bungapinjaman WHERE tanggal_bunga='$tglhariini'");
      $fetchterbayarbunga=mysqli_fetch_assoc($queryterbayarbunga);
      $jumlahbunga=$fetchterbayarbunga['total'];
      // denda
      $denda=mysqli_query($conn,"SELECT SUM(jumlah_denda) AS total FROM denda WHERE status_denda='belum bayar' and tanggal_denda='$tglhariini'");
      $totaldenda=mysqli_fetch_assoc($denda)['total'];
      // pinjaman dibayar
      $dendadibayar=mysqli_query($conn,"SELECT SUM(jumlah_bayardenda) AS total FROM bayardenda WHERE tanggal_bayardenda='$tglhariini'");
      $totaldendadibayar=mysqli_fetch_assoc($dendadibayar);
      // sumbangan
      $datasumbangan=getdatasumbangan("SELECT * FROM sumbangan where tanggal_sumbangan='$tglhariini' ORDER BY tanggal_sumbangan DESC,id_sumbangan DESC");
      $resultsumbangan=mysqli_query($conn,"SELECT SUM(jumlah_sumbangan) AS total FROM sumbangan where tanggal_sumbangan='$tglhariini'");
      $totalsumbangan=mysqli_fetch_assoc($resultsumbangan);

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

  <title>halaman pemasukan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
        <a class="nav-link bg-info" href="rekap.php">
          <i class="fab fa-fw fa-readme"></i>
          <span>Rekap</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="saldo.php">
          <i class="fas fa-fw fa-wallet"></i>
          <span>Saldo</span></a>
      </li>
    <?php }else{echo'';} ?>

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
              <h4 class="text-left">Rekapitulasi</h4>
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

          <form class="form-inline mt-3 mb-2" action="" method="post" style="">
          <div class="input-group">
            <div class="input-group-prepend">
            </div>
            <input type="date" class="form-control" placeholder="Ketik nama..." aria-label="Username" aria-describedby="basic-addon1" style="border-radius:5px;" name="keywordtanggal" autocomplete="off" value="<?php if(isset($_POST['caritanggal'])){echo $_POST['keywordtanggal'];} ?>">
            <button class="btn btn-info" id="basic-addon1" name="caritanggal"><i class="fas fa-fw fa-search"></i></button>
          </div>
        </form>
        
  <?php if($totalpemasukan['total']==0&&$totalpengeluaran['total']==0&&$totalpinjamandibayar['total']==0&&$totaldendadibayar['total']==0&&$totalsumbangan['total']==0&&$totalpinjaman==0&&$totaldenda==0){ ?>
    <h1 class="mt-5 text-center">Tidak ada data!</h1>
  <?php }else{ ?>

  <?php if($totalpemasukan['total']>0){ ?>
        <div class="alert alert-info mt-2" role="alert" style="margin-bottom: 1px">
          <span>Pemasukan Tgl : <?=date('d-m-Y', strtotime($tglhariini)); ?></span><hr style="margin: 3px">
        <?php $nopemasukan=1; foreach($data as $dp): ?>
          <div><?=$nopemasukan.". ".$dp['keterangan_pemasukan']." : Rp ".str_replace(',','.',number_format($dp['jumlah_pemasukan'])); ?></div>
        <?php $nopemasukan++; endforeach; ?>
          <div class="text-right"><?="Total : Rp ".str_replace(',','.',number_format($totalpemasukan['total'])); ?></div>
        </div>
    <?php }else{} ?>

    <?php if($totalpengeluaran['total']>0){ ?>
        <div class="alert alert-info mt-2" role="alert" style="margin-bottom: 1px">
          <span>Pengeluaran Tgl : <?=date('d-m-Y', strtotime($tglhariini)); ?></span><hr style="margin: 3px">
        <?php $nopengeluaran=1; foreach($datapengeluaran as $dpengeluaran): ?>
          <div><?=$nopengeluaran.". ".$dpengeluaran['keterangan_pengeluaran']." : Rp ".str_replace(',','.',number_format($dpengeluaran['jumlah_pengeluaran'])); ?></div>
        <?php $nopengeluaran++; endforeach; ?>
          <div class="text-right"><?="Total : Rp ".str_replace(',','.',number_format($totalpengeluaran['total'])); ?></div>
        </div>
    <?php }else{} ?>

    <?php if($totalpinjamandibayar['total']+$totalpinjaman+$jumlahbunga > 0){ ?>
        <div class="alert alert-info mt-2" role="alert" style="margin-bottom: 1px">
          <span>Pinjaman Tgl : <?=date('d-m-Y', strtotime($tglhariini)); ?></span><hr style="margin: 3px">
          <div><?="1. Dipinjamkan : Rp ".str_replace(',','.',number_format($totalpinjaman)); ?></div>
          <div><?="2. Dibayar : Rp ".str_replace(',','.',number_format($totalpinjamandibayar['total'])); ?></div>
          <div><?="3. Bunga Dibayar : Rp ".str_replace(',','.',number_format($jumlahbunga)); ?></div>
          <!-- <div class="text-right"><?="Total : Rp ".str_replace(',','.',number_format($totalpinjamandibayar['total']+$totalpinjaman)); ?></div> -->
        </div>
    <?php }else{} ?>

    <?php if($totaldendadibayar['total']+$totaldenda>0){ ?>
        <div class="alert alert-info mt-2" role="alert" style="margin-bottom: 1px">
          <span>Denda Tgl : <?=date('d-m-Y', strtotime($tglhariini)); ?></span><hr style="margin: 3px">
          <?php if(is_null($totaldendadibayar['total']+$totaldenda)){ ?>
            <div></div>
          <?php }else{ ?>
          <div><?="1. Didendakan : Rp ".str_replace(',','.',number_format($totaldenda)); ?></div>
          <div><?="2. Dibayar : Rp ".str_replace(',','.',number_format($totaldendadibayar['total'])); ?></div>
          <?php } ?>
          <!-- <div class="text-right"><?="Total : Rp ".str_replace(',','.',number_format($totaldendadibayar['total'])); ?></div> -->
        </div>
    <?php }else{} ?>

    <?php if($totalsumbangan['total']>0){ ?>
        <div class="alert alert-info mt-2" role="alert" style="margin-bottom: 1px">
          <span>Sumbangan Tgl : <?=date('d-m-Y', strtotime($tglhariini)); ?></span><hr style="margin: 3px">
        <?php $nosumbangan=1; foreach($datasumbangan as $dsumbangan): ?>
          <div><?=$nosumbangan.". ".$dsumbangan['nama_sumbangan']." : Rp ".str_replace(',','.',number_format($dsumbangan['jumlah_sumbangan'])); ?></div>
        <?php $nosumbangan++; endforeach; ?>
          <div class="text-right"><?="Total : Rp ".str_replace(',','.',number_format($totalsumbangan['total'])); ?></div>
        </div>
    <?php }else{} ?>

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
    $(document).ready(function(){

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

    });
  </script>

</body>

</html>