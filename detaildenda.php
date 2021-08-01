<?php  

  session_start();
  require_once'functions.php';
    if(!isset($_SESSION['login'])){
      pindahhalaman();
    }
  // $iddenda=mysqli_real_escape_string($conn,$_GET['iddenda']);

 //  $cek=mysqli_query($conn,"SELECT * FROM denda WHERE id_denda=$iddenda");
 //  $fetcek=mysqli_fetch_assoc($cek);

 //  if(isset($iddenda)){
 //    $iddenda=$_GET['iddenda'];
 //    if($iddenda==''){
 //      header("location:error.php");
 //    }else if($fetcek['id_denda']!=$iddenda){
 //      header("location:error.php");
 //    }
 //  }else{
 //    header("location:error.php");
 //  }

  $iddenda = isset($_GET['iddenda']) ? $_GET['iddenda'] : null;

  if($iddenda==null){
    header("Location: error.php");
    exit;
  }else{
    $query="SELECT * FROM `denda` WHERE `id_denda`= '".mysqli_real_escape_string($conn,$iddenda)."'";
    $cek=mysqli_query($conn,$query);
    $fetcek = $cek ? mysqli_fetch_assoc($cek) : null ;

    if(!$fetcek){ 
      header('Location: error.php');
      exit; 
    }

  }

  $query="SELECT id_denda,nama_anggota,keterangan_denda,tanggal_denda,jumlah_denda,status_denda FROM anggota JOIN denda USING (id_anggota) WHERE id_denda=$iddenda";
    $getdatadenda=mysqli_query($conn,$query);
    $fetchdetaildenda=mysqli_fetch_assoc($getdatadenda);

    $querybayardenda="SELECT id_denda,id_bayardenda,tanggal_bayardenda,jumlah_bayardenda FROM denda JOIN bayardenda USING (id_denda) WHERE id_denda=$iddenda";
    $getdatabayardenda=mysqli_query($conn,$querybayardenda);

    $queryterbayar=mysqli_query($conn,"SELECT SUM(jumlah_bayardenda)as total FROM bayardenda WHERE id_denda=$iddenda");
    $fetchterbayar=mysqli_fetch_assoc($queryterbayar);

    $jumlahdenda=$fetchdetaildenda['jumlah_denda'];
    $jumlahbayardenda=$fetchterbayar['total'];

    if(isset($_POST['confirmbayardenda'])){
      tambahdatabayardenda($_POST,$jumlahdenda,$jumlahbayardenda);
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

  <title>halaman detail denda</title>

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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePinjam" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-funnel-dollar"></i>
          <span>Pinjaman</span>
        </a>
        <div id="collapsePinjam" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu pinjaman:</h6>
            <a class="collapse-item" href="pinjaman.php">Belum Lunas <span class="badge badge-danger badge-counter"><?php $counter=counter(); if($counter==0){}else{echo $counter;}?></span></a>
            <a class="collapse-item" href="pinjamanlunas.php">Sudah Lunas</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item">
        <a class="nav-link bg-info" href="denda.php">
          <i class="far fa-fw fa-money-bill-alt"></i>
          <span>Denda</span></a>
      </li> -->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link bg-info" href="#" data-toggle="collapse" data-target="#collapseDenda" aria-expanded="true" aria-controls="collapseTwo">
          <i class="far fa-fw fa-money-bill-alt"></i>
          <span>Denda</span>
        </a>
        <div id="collapseDenda" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu denda:</h6>

          <?php if($fetchdetaildenda['status_denda']=='belum bayar'){ ?>
            <a class="collapse-item active" style="background-color: #ddd;" href="denda.php">Belum Lunas <span class="badge badge-danger badge-counter"><?php $counterdenda=counterdenda(); if($counterdenda==0){}else{echo $counterdenda;}?></span></a>
            <a class="collapse-item" href="dendalunas.php">Sudah Lunas</a>
          <?php }else{ ?>
            <a class="collapse-item" href="denda.php">Belum Lunas <span class="badge badge-danger badge-counter"><?php $counterdenda=counterdenda(); if($counterdenda==0){}else{echo $counterdenda;}?></span></a>
            <a class="collapse-item active" style="background-color: #ddd;" href="dendalunas.php">Sudah Lunas</a>
          <?php } ?>

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
              <h4 class="text-left">Rincian Denda '<?=$fetchdetaildenda['nama_anggota']; ?>'</h4>
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

            <!-- <h4 class="text-center mb-4">Detail denda</h4> -->
            <div class="row justify-content-center">
              <div class="card" style="width:24rem;">
              <?php if(isset($_SESSION['login'])){ ?>
                <?php if($_SESSION['login']=='admin'){ ?> 
                <a href="delete/deletedenda.php?iddenda=<?=$fetchdetaildenda['id_denda']; ?>" class="btn btn-danger float-right" onclick="return confirm('yakin ingin hapus?')">
                       <i class="fas fa-fw fa-trash-alt" style="font-size: 35px;"></i>
                </a>
                <?php }else{echo "";} ?>
              <?php }else{echo "";} ?>

                <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="130"><i class="far fa-fw fa-id-card"></i> Nama </td>
                        <td>: <!-- <input type="text" name="namaanggota" class="namahide" value="<?=$get_anggota['nama_anggota']; ?>"> -->
                          <span style="font-weight:bold;" class="namaanggota"><?=$fetchdetaildenda['nama_anggota']; ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>

                    <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="130"><i class="fas fa-fw fa-info"></i></i> Keterangan </td>
                        <td>: <!-- <input type="number" name="tlpanggota" class="tlphide" value="<?=$get_anggota['tlp_anggota']; ?>"> -->
                          <span style="font-weight:bold;" class="tlpanggota"><?=$fetchdetaildenda['keterangan_denda']; ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>

                <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="130"><i class="fas fa-fw fa-calendar-alt"></i> Tanggal </td>
                        <td>: <!-- <input type="number" name="tlpanggota" class="tlphide" value="<?=$get_anggota['tlp_anggota']; ?>"> -->
                          <span style="font-weight:bold;" class="tlpanggota"><?=date('d-m-Y', strtotime($fetchdetaildenda['tanggal_denda'])); ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>

                    <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="130"><i class="fas fa-fw fa-calculator"></i> Jumlah denda </td>
                        <td>: <!-- <input type="number" name="tlpanggota" class="tlphide" value="<?=$get_anggota['tlp_anggota']; ?>"> -->
                          <span style="font-weight:bold;" class="tlpanggota">Rp <?=str_replace(',','.',number_format($fetchdetaildenda['jumlah_denda'])); ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>

                    <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="130"><i class="fas fa-fw fa-dollar-sign"></i></i> Terbayar </td>
                        <td>: <!-- <input type="number" name="tlpanggota" class="tlphide" value="<?=$get_anggota['tlp_anggota']; ?>"> -->
                          <span style="font-weight:bold;" class="tlpanggota">Rp <?=str_replace(',','.',number_format($jumlahbayardenda)); ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>

                    <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="130"><i class="far fa-fw fa-clock"></i></i> Sisa denda </td>
                        <td>: <!-- <input type="number" name="tlpanggota" class="tlphide" value="<?=$get_anggota['tlp_anggota']; ?>"> -->
                          <span style="font-weight:bold;" class="tlpanggota">Rp <?=str_replace(',','.',number_format($jumlahdenda-$jumlahbayardenda)); ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>

                <li class="list-group-item">
                      <table>
                        <tr>
                          <td width="130"><i class="fas fa-fw fa-hourglass-half"></i> Status </td> 
                          <td>: 
                                  <!-- <select class="statushide" name="statusanggota" style="width: 182px">
                                    <option selected value="aktif">belum bayar</option>
                                    <option value="non aktif">lunas</option>
                                  </select> -->

                                  <span style="font-weight:bold;" class="statusanggota"><?=$fetchdetaildenda['status_denda']; ?></span>
                          </td>
                        </tr>
                      </table>
                    </li>
                  </ul>

                <div class="card-body awalform text-center" style="background-color: #ccc;height: 40px;line-height: 5px;">
                  Rincian Pembayaran Denda
                </div>

                <?php if($jumlahbayardenda==null){ ?>
                    <h5 class="mt-4 text-center mb-5">Belum Pernah Bayar!</h5>
                <?php }else{ ?>
                <div class="card-body awalform" style="margin-top: -19px">
                    <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jumlah</th>
              <?php if(isset($_SESSION['login'])){ ?>
                <?php if($_SESSION['login']=='admin'){ ?>
                <th scope="col">Action</th>
                <?php }else{echo "";} ?>
              <?php }else{echo "";} ?>
              </tr>
            </thead>
            <tbody>

              <?php $no=1; foreach($getdatabayardenda as $bayardenda): ?>
                <tr>
                  <th scope="row"><?=$no; ?></th>
                  <td><?=date('d-m-Y', strtotime($bayardenda['tanggal_bayardenda'])); ?></td>
                  <td>Rp <?=str_replace(',','.',number_format($bayardenda['jumlah_bayardenda'])); ?></td>
                <?php if(isset($_SESSION['login'])){ ?>
                  <?php if($_SESSION['login']=='admin'){ ?>
                  <td><a href="delete/deletebayardenda.php?idbayardenda=<?=$bayardenda['id_bayardenda']; ?>&iddenda=<?=$bayardenda['id_denda']; ?>" class="badge" onclick="return confirm('yakin ingin hapus?')"><i class="far fa-fw fa-trash-alt" style="font-size: 25px;color: red;"></i></a></td>
                  <?php }else{echo "";} ?>
                <?php }else{echo "";} ?>
                </tr>
            <?php $no++; endforeach ?>

            </tbody>
          </table>
                </div>
              <?php } ?>

              <?php if(isset($_SESSION['login'])){ ?>
                <?php if($_SESSION['login']=='admin'){ ?>
                <div class="container" style="margin-top:-20px">
                  <button class="btn btn-primary mb-2 btnbayardenda"><i class="fas fa-fw fa-chevron-circle-right"></i></button>
                <form action="" method="post" class="formbayardenda">
                  <input type="hidden" name="iddenda" value="<?=$iddenda; ?>">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1" style="width:110px;">Jumlah bayar</span>
                    </div>
                    <input type="number" class="form-control" placeholder="masukan jumlah pembayaran" aria-label="Username" aria-describedby="basic-addon1" name="jumlahbayardenda" required>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1" style="width:110px;">Tanggal</span>
                    </div>
                    <input type="date" class="form-control" placeholder="masukan tanggal pembayaran" aria-label="Username" aria-describedby="basic-addon1" name="tanggalbayardenda" required>
                  </div>
                 <button type="submit" class="btn btn-primary" name="confirmbayardenda">Bayar</button>
                </form>
                </div>
                <?php }else{echo "";} ?>
              <?php }else{echo "";} ?>
            </div>

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
          <a class="btn btn-primary" href="login.html">Logout</a>
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
    $('.formbayardenda').hide();
    var triger=1;
    $('.btnbayardenda').on('click',function(){
        triger=triger+1;
        if(triger==3){
          triger=1;
        }
        if(triger==1){
          $('.btnbayardenda').html('<i class="fas fa-fw fa-chevron-circle-right"></i>');
        }else{
          $('.btnbayardenda').html('<i class="fas fa-fw fa-chevron-circle-down"></i>');
        }
        $('.formbayardenda').slideToggle();
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

</body>

</html>