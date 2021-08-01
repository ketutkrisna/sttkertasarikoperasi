<?php  
    
    session_start();
    require_once'functions.php';
    if(!isset($_SESSION['login'])){
      pindahhalaman();
    }
    
    $datanamaanggota=anggota("SELECT * FROM anggota ORDER BY nama_anggota");
    // pinjmana lunas belum
    $query="SELECT id_pinjaman,nama_anggota,tanggal_pinjaman,jumlah_pinjaman,status_pinjaman,sum(jumlah_pinjaman)as totalpinjaman,sum(jumlah_pembayaran)as totalpembayaran FROM anggota JOIN pinjaman USING (id_anggota) left JOIN pembayaran USING (id_pinjaman) WHERE status_pinjaman='belum lunas' group by id_pinjaman ORDER BY tanggal_pinjaman DESC,id_pinjaman DESC";
    $getdatapinjaman=mysqli_query($conn,$query);

    $querylunas="SELECT id_pinjaman,nama_anggota,tanggal_pinjaman,jumlah_pinjaman,status_pinjaman FROM anggota JOIN pinjaman USING (id_anggota) WHERE status_pinjaman='lunas' ORDER BY tanggal_pinjaman DESC,id_pinjaman DESC";
    $getdatapinjamanlunas=mysqli_query($conn,$querylunas);
    // lunas dan belum
    $pinjaman=mysqli_query($conn,"SELECT SUM(jumlah_pinjaman) AS total FROM pinjaman WHERE status_pinjaman='belum lunas'");
    $totalpinjaman=mysqli_fetch_assoc($pinjaman);
    $pinjamanlunas=mysqli_query($conn,"SELECT SUM(jumlah_pinjaman) AS total FROM pinjaman WHERE status_pinjaman='lunas'");
    $totalpinjamanlunas=mysqli_fetch_assoc($pinjamanlunas);
    // belum
    $querybelumlunas="SELECT id_pinjaman,sum(jumlah_pinjaman)as totalpinjam,sum(jumlah_pembayaran)as totalbayar,status_pinjaman FROM pinjaman LEFT JOIN pembayaran USING (id_pinjaman) where status_pinjaman='belum lunas'";
    $getdatabelumlunas=mysqli_query($conn,$querybelumlunas);
    $fetchbelumlunas=mysqli_fetch_assoc($getdatabelumlunas);
    // var_dump($fetcount['counter']);die;

    if(isset($_POST['confirmpinjaman'])){
      tambahdatapinjaman($_POST);
    }

    if(isset($_POST['caripinjamanbelum'])){
      $keywordpinjamanbelum=htmlspecialchars($_POST['keywordpinjamanbelum']);

      $query="SELECT id_pinjaman,nama_anggota,tanggal_pinjaman,jumlah_pinjaman,status_pinjaman FROM anggota JOIN pinjaman USING (id_anggota) WHERE status_pinjaman='belum lunas' and nama_anggota LIKE '%$keywordpinjamanbelum%' ORDER BY tanggal_pinjaman DESC,id_pinjaman DESC";
      $getdatapinjaman=mysqli_query($conn,$query);
      // belum lunas
      $pinjaman=mysqli_query($conn,"SELECT SUM(jumlah_pinjaman) AS total,nama_anggota FROM anggota JOIN pinjaman USING (id_anggota) WHERE status_pinjaman='belum lunas' and nama_anggota LIKE '%$keywordpinjamanbelum%'");
      $totalpinjaman=mysqli_fetch_assoc($pinjaman);

      // belum
      $querybelumlunas="SELECT id_pinjaman,sum(jumlah_pinjaman)as totalpinjam,sum(jumlah_pembayaran)as totalbayar,status_pinjaman,nama_anggota FROM anggota join pinjaman USING (id_anggota) LEFT JOIN pembayaran USING (id_pinjaman) where status_pinjaman='belum lunas' and nama_anggota LIKE '%$keywordpinjamanbelum%'";
      $getdatabelumlunas=mysqli_query($conn,$querybelumlunas);
      $fetchbelumlunas=mysqli_fetch_assoc($getdatabelumlunas);
    }

    // if(isset($_POST['caripinjamanlunas'])){
    //   $keywordpinjamanlunas=htmlspecialchars($_POST['keywordpinjamanlunas']);

    //   $querylunas="SELECT id_pinjaman,nama_anggota,tanggal_pinjaman,jumlah_pinjaman,status_pinjaman FROM anggota JOIN pinjaman USING (id_anggota) WHERE status_pinjaman='lunas' and nama_anggota LIKE '%$keywordpinjamanlunas%' ORDER BY tanggal_pinjaman DESC,id_pinjaman DESC";
    //   $getdatapinjamanlunas=mysqli_query($conn,$querylunas);
    //   // belum lunas
    //   $pinjamanlunas=mysqli_query($conn,"SELECT SUM(jumlah_pinjaman) AS total,nama_anggota FROM anggota JOIN pinjaman USING (id_anggota) WHERE status_pinjaman='lunas' and nama_anggota LIKE '%$keywordpinjamanlunas%'");
    //   $totalpinjamanlunas=mysqli_fetch_assoc($pinjamanlunas);
    // }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>halaman pinjaman</title>

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
        <a class="nav-link bg-info" href="pinjaman.php">
          <i class="fas fa-fw fa-funnel-dollar"></i>
          <span>Pinjaman</span></a>
      </li> -->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link bg-info" href="#" data-toggle="collapse" data-target="#collapsePinjam" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-funnel-dollar"></i>
          <span>Pinjaman</span>
        </a>
        <div id="collapsePinjam" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu pinjaman:</h6>
            <a class="collapse-item active" style="background-color: #ddd;" href="pinjaman.php">Belum Lunas <span class="badge badge-danger badge-counter"><?php $counter=counter(); if($counter==0){}else{echo $counter;}?></span></a>
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
        <div id="collapseDenda" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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
              <h4 class="text-left">Pinjaman Belum Lunas</h4>
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
        <button id="trigerpinjaman" class="btn btn-primary mb-2">
          <i id="iconic" class="fas fa-fw fa-plus"></i> <span id="ubahtriger">Add</span></button>
        <form action="" method="post" class="mb-4" id="slidepinjaman">
          <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01" style="width:100px;">Anggota</label>
          </div>
          <select class="custom-select" id="inputGroupSelect01" name="namapinjaman" required>
            <?php $angka=1; foreach($datanamaanggota as $nama): ?>
              <?php if($nama['status_anggota']=='drop out'||$nama['status_anggota']=='menikah'){}else{ ?>
                <option value="<?=$nama['id_anggota']; ?>"><?=$angka++.". ".$nama['nama_anggota']; ?></option>
              <?php } ?>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:100px;">Tanggal</span>
          </div>
          <input type="date" class="form-control" placeholder="masukan tanggal" aria-label="Username" aria-describedby="basic-addon1" name="tanggalpinjaman" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:100px;">Jumlah</span>
          </div>
          <input type="number" class="form-control" placeholder="masukan jumlah" aria-label="Username" aria-describedby="basic-addon1" name="jumlahpinjaman" required>
        </div>
        <button type="submit" class="btn btn-primary" name="confirmpinjaman">Confirm <i class="far fa-fw fa-arrow-alt-circle-right"></i></button>
        </form>
        <?php }else{echo "";} ?>
      <?php }else{echo "";} ?>

          
        
          <!-- <div class="card">
            <div class="card-header text-center" style="background-color: #ccc;">
              Pinjaman belum lunas
            </div>
          </div> -->

          
        <!-- <div style="border:0px solid gray;padding:0 2px 0 2px"> -->
          <form class="form-inline mt-3 mb-2" action="" method="post" style="">
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <input type="text" class="form-control" placeholder="Ketik nama..." aria-label="Username" aria-describedby="basic-addon1" style="border-radius:5px;" name="keywordpinjamanbelum" autocomplete="off" value="<?php if(isset($_POST['caripinjamanbelum'])){echo $_POST['keywordpinjamanbelum'];} ?>">
              <button class="btn btn-info" id="basic-addon1" name="caripinjamanbelum"><i class="fas fa-fw fa-search"></i></button>
            </div>
          </form>

          <?php if($totalpinjaman['total']==null){ ?>
          <h1 class="mt-5 text-center">Tidak ada data!</h1>
          <?php }else{ ?>

          <div class="alert alert-info text-right lihat" role="alert" style="margin-bottom: 1px;display: block;">
            <i id="fox" class="fas fa-fw fa-chevron-circle-right float-left mt-1"></i>
            <span class="ml-auto">Total : Rp <?=str_replace(',','.',number_format($totalpinjaman['total'])); ?></span>
            <div class="lihatsemua">
              <span>Terbayar : Rp <?=str_replace(',','.',number_format($fetchbelumlunas['totalbayar'])); ?></span><br>
              <span>Sisa : Rp <?=str_replace(',','.',number_format($totalpinjaman['total']-$fetchbelumlunas['totalbayar'])); ?></span>
            </div>
          </div>

          <!-- table pemasukan -->
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jmlh</th>
                <!-- <th scope="col">Aksi</th> -->
              </tr>
            </thead>
            <tbody>

              <?php $no=1; foreach($getdatapinjaman as $pinjaman): ?>
                <tr>
                  <th scope="row"><?=$no; ?></th>
                  <td><?=$pinjaman['nama_anggota']; ?></td>
                  <td><div class="sisa" data-toggle="tooltip" data-html="true" title="<b>Sisa hutang : Rp <?=str_replace(',','.',number_format($pinjaman['totalpinjaman']-$pinjaman['totalpembayaran'])); ?></b>">
                  Rp <?=str_replace(',','.',number_format($pinjaman['jumlah_pinjaman'])); ?></div></td>
                  <td><a href="detailpinjaman.php?idpinjaman=<?=$pinjaman['id_pinjaman']; ?>" class="badge"><i class="far fa-fw fa-arrow-alt-circle-right text-primary" style="font-size: 25px;color: blue;"></i></a></td>
                </tr>
              <?php $no++;  endforeach; ?>

            </tbody>
          </table>
          <?php } ?>
        <!-- </div> -->

         <!--  <div class="card mt-4">
            <div class="card-header text-center" style="background-color: #ccc;">
              Pinjaman lunas
            </div>
          </div>


          <form class="form-inline mt-3 mb-2" action="" method="post" style="">
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <input type="text" class="form-control" placeholder="Ketik nama..." aria-label="Username" aria-describedby="basic-addon1" style="border-radius:5px;" name="keywordpinjamanlunas" autocomplete="off" value="<?php if(isset($_POST['caripinjamanlunas'])){echo $_POST['keywordpinjamanlunas'];} ?>">
              <button class="btn btn-info" id="basic-addon1" name="caripinjamanlunas"><i class="fas fa-fw fa-search"></i></button>
            </div>
          </form>

          <?php if($totalpinjamanlunas['total']==null){ ?>
          <h1 class="mt-5 text-center">Tidak ada data!</h1>
          <?php }else{ ?>

          <div class="alert alert-info text-right" role="alert" style="margin-bottom: 1px">
            <span class="">Total : Rp <?=str_replace(',','.',number_format($totalpinjamanlunas['total'])); ?></span>
          </div>

          <table class="table table-sm">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jmlh</th>
                <th scope="col">Aksi</th>
              </tr>
            <tbody>

              <?php $nomer=1; foreach($getdatapinjamanlunas as $pinjamanl): ?>
                <tr>
                  <th scope="row"><?=$nomer; ?></th>
                  <td><?=$pinjamanl['nama_anggota']; ?></td>
                  <td>Rp <?=str_replace(',','.',number_format($pinjamanl['jumlah_pinjaman'])); ?></td>
                  <td><a href="detailpinjaman.php?idpinjaman=<?=$pinjamanl['id_pinjaman']; ?>" class="badge"><i class="far fa-fw fa-arrow-alt-circle-right" style="font-size: 25px;color: blue;"></i></a></td>
                </tr>
              <?php $nomer++;  endforeach; ?>

            </tbody>
          </table>
          <?php } ?> -->

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
  <?php if(isset($_SESSION['login'])){ ?>
  <script type="text/javascript">
    $('#slidepinjaman').hide();
      var triger=1;
    $('#trigerpinjaman').on('click',function(){
      triger=triger+1;
      if(triger==3){
        triger=1;
      }
      if(triger==1){
        $('#ubahtriger').html('Add');
        $('#trigerpinjaman').removeClass('btn-danger');
        $('#iconic').addClass('fa-plus');
        $('#iconic').removeClass('fa-times');
      }else{
        $('#ubahtriger').html('');
        $('#trigerpinjaman').addClass('btn-danger');
        $('#iconic').removeClass('fa-plus');
        $('#iconic').addClass('fa-times');
      }

      $('#slidepinjaman').slideToggle();
    });

    $('.lihatsemua').hide();
      var trigerfox=1;
    $('.lihat').on('click',function(){
      trigerfox=trigerfox+1;
      if(trigerfox==3){
        trigerfox=1;
      }
      if(trigerfox==1){
        $('#fox').addClass('fa-chevron-circle-right');
        $('#fox').removeClass('fa-chevron-circle-down');
      }else{
        $('#fox').removeClass('fa-chevron-circle-right');
        $('#fox').addClass('fa-chevron-circle-down');
      }
      $('.lihatsemua').slideToggle();
    });
    $('.sisa').tooltip({
      triger:'hover',
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