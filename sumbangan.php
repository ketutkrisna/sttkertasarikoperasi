<?php

    session_start();
    require_once'functions.php';
    if(!isset($_SESSION['login'])){
      pindahhalaman();
    }
    
    $datasumbangan=getdatasumbangan("SELECT * FROM sumbangan ORDER BY tanggal_sumbangan DESC,id_sumbangan DESC");

    $resultsumbangan=mysqli_query($conn,"SELECT SUM(jumlah_sumbangan) AS total FROM sumbangan");
    $totalsumbangan=mysqli_fetch_assoc($resultsumbangan);

    if(isset($_POST['confirmsumbang'])){
      tambahdatasumbangan($_POST);
    }

    if(isset($_POST['carisumbangan'])){
      $keywordsumbangan=htmlspecialchars($_POST['keywordsumbangan']);

      $datasumbangan=getdatasumbangan("SELECT * FROM sumbangan WHERE nama_sumbangan LIKE '%$keywordsumbangan%' ORDER BY tanggal_sumbangan DESC,id_sumbangan DESC");

      $resultsumbangan=mysqli_query($conn,"SELECT SUM(jumlah_sumbangan) AS total FROM sumbangan WHERE nama_sumbangan LIKE '%$keywordsumbangan%'");
      $totalsumbangan=mysqli_fetch_assoc($resultsumbangan);
    }

    if(isset($_POST['idpost'])){
      $datapostid=htmlspecialchars($_POST['idpost']);

      $querypost=mysqli_query($conn,"SELECT * FROM sumbangan WHERE id_sumbangan='$datapostid'");
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

  <title>halaman sumbangan</title>

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
    <?php  if(isset($_SESSION['login'])){ ?>
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
        <a class="nav-link bg-info" href="sumbangan.php">
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
              <h4 class="text-left">Sumbangan</h4>
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
        <button id="trigersumbangan" class="btn btn-primary mb-3">
          <i id="iconic" class="fas fa-fw fa-plus"></i> <span id="ubahtriger">Add</span></button>
        <form action="" method="post" class="mb-4" id="slidesumbangan">
          <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:100px;">Nama</span>
          </div>
          <input type="text" class="form-control" placeholder="masukan nama penyumbang" aria-label="Username" aria-describedby="basic-addon1" name="namasumbang" autocomplete="off" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:100px;">Tanggal</span>
          </div>
          <input type="date" class="form-control" placeholder="masukan tanggal" aria-label="Username" aria-describedby="basic-addon1" name="tanggalsumbang" autocomplete="off" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:100px;">Jumlah</span>
          </div>
          <input type="number" class="form-control" placeholder="masukan jumlah" aria-label="Username" aria-describedby="basic-addon1" name="jumlahsumbang" autocomplete="off" required>
        </div>
        <button type="submit" class="btn btn-primary" name="confirmsumbang">Confirm <i class="far fa-fw fa-arrow-alt-circle-right"></i></button>
        </form>
        <?php }else{echo "";} ?>
      <?php }else{echo "";} ?>

      <form class="form-inline mt-3 mb-2" action="" method="post" style="">
        <div class="input-group">
          <div class="input-group-prepend">
          </div>
          <input type="text" class="form-control" placeholder="Ketik nama..." aria-label="Username" aria-describedby="basic-addon1" style="border-radius:5px;" name="keywordsumbangan" autocomplete="off" value="<?php if(isset($_POST['carisumbangan'])){echo $_POST['keywordsumbangan'];} ?>">
          <button class="btn btn-info" id="basic-addon1" name="carisumbangan"><i class="fas fa-fw fa-search"></i></button>
        </div>
      </form>

      <?php if($totalsumbangan['total']==null){ ?>
          <h1 class="mt-5 text-center">Tidak ada data!</h1>
      <?php }else{ ?>

          <div class="alert alert-info text-right" role="alert" style="margin-bottom: 1px">
            <span>Total : Rp <?=str_replace(',','.',number_format($totalsumbangan['total'])); ?></span>
          </div>

      <!-- table pemasukan -->
      <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
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
          <?php $no=1; foreach($datasumbangan as $sumbangan): ?>
            <tr>
              <th scope="row"><?=$no; ?></th>
              <td><?=$sumbangan['nama_sumbangan']; ?></td>
              <td><?=date('d-m-Y', strtotime($sumbangan['tanggal_sumbangan'])); ?></td>
              <td>Rp <?=str_replace(',','.',number_format($sumbangan['jumlah_sumbangan'])); ?></td>
            <?php if(isset($_SESSION['login'])){ ?>
              <?php if($_SESSION['login']=='admin'){ ?>
              <td>
                <a tabindex="0" class="badge float-right asd" role="button" data-toggle="popover" data-trigger="focus" title="<?=$sumbangan['nama_sumbangan']; ?>" data-html="true" data-content='<div class="text-center"><a href="" data-idanjing="<?=$sumbangan['id_sumbangan']; ?>"><div class="btn davu fuck"><i class="fas fa-fw fa-edit text-success ukuran"></i></div></a>||<a href="delete/deletesumbangan.php?idsumbangan=<?=$sumbangan['id_sumbangan']; ?>"><div class="btn returne"><i class="fas fa-fw fa-trash-alt text-danger ukuran"></i></div></a></div>'><i class="fas fa-fw fa-cog muter" style="font-size: 20px;" data-idpemasukan="<?=$sumbangan['id_sumbangan']; ?>"></i></a>

                <!-- <a href="delete/deletesumbangan.php?idsumbangan=<?=$sumbangan['id_sumbangan']; ?>" class="badge" onclick="return confirm('yakin ingin hapus?')"><i class="far fa-fw fa-trash-alt" style="font-size: 25px;color: red"></a> -->
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

       <!-- Modal -->
      <!-- <div class="anjing"> -->
    <?php if(isset($_SESSION['login'])){ ?>
      <?php if($_SESSION['login']=='admin'){ ?>
      <div class="modal fade collapse show" id="exampleModalasu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Data Sumbangan <span class="loader"><img src="img/loader.gif" width="22"></span></h5>
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
    $('#slidesumbangan').hide();
      var triger=1;
    $('#trigersumbangan').on('click',function(){
      triger=triger+1;
      if(triger==3){
        triger=1;
      }
      if(triger==1){
        $('#ubahtriger').html('Add');
        $('#trigersumbangan').removeClass('btn-danger');
        $('#iconic').addClass('fa-plus');
        $('#iconic').removeClass('fa-times');
      }else{
        $('#ubahtriger').html('');
        $('#trigersumbangan').addClass('btn-danger');
        $('#iconic').removeClass('fa-plus');
        $('#iconic').addClass('fa-times');
      }

      $('#slidesumbangan').slideToggle();
    });

     $('.asd').popover({
        trigger: 'hover focus'
    });

    $('body').on('click','.returne',function(){
      return confirm('yakin ingin hapus?');
    });

    $('body').on('click','.muter',function(){
      var anjing=$(this).data('idpemasukan');
      // console.log(anjing);
      $('.datahide').hide();
      $('.loader').show();
       $.ajax({
          url: 'https://sttkertasari.000webhostapp.com/sumbangan.php',
          method: "POST",
          data: 'idpost=' + anjing,
          dataType: "json",
          success:function(data){
            // console.log(data);
            $('.updateid').val(data.id_sumbangan);
            $('.updateketerangan').val(data.nama_sumbangan);
            $('.updatetanggal').val(data.tanggal_sumbangan);
            $('.updatejumlah').val(data.jumlah_sumbangan);

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