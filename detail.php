<?php 
	
  session_start();
	require_once 'functions.php';
  if(!isset($_SESSION['login'])){
      echo"<script>
            alert('Maaf anda tidak ada hak akses!');
            document.location.href='index.php';
          </script>";
      pindahhalaman();
      return false;
      exit;
    }
    if($_SESSION['login']=='anggota'){
      echo"<script>
            alert('Maaf anda tidak ada hak akses!');
            document.location.href='index.php';
          </script>";
      return false;
      exit;
    }
  // $samakan='id_anggota';
	$id_anggota = isset($_GET['id_anggota']) ? $_GET['id_anggota'] : null;

  if($id_anggota==null){
    header("Location: error.php");
    exit;
  }else{
    $get_anggota=get_anggota($id_anggota);
    $query="SELECT * FROM `anggota` WHERE `id_anggota`= '".mysqli_real_escape_string($conn,$id_anggota)."'";
    $cek=mysqli_query($conn,$query);
    $fetcek = $cek ? mysqli_fetch_assoc($cek) : null ;

    if(!$fetcek){ header('Location: error.php'); exit; }

    // if($id_anggota==''){
    //   header("Location: error.php");
    //   exit;
    // }elseif($fetcek['id_anggota']!=$id_anggota){
    //   header("Location: error.php");
    //   exit;
    // }
  }

  // if(isset($id_anggota)){
  //   $id_anggota=$_GET['id_anggota'];
  //   if(empty($id_anggota)){
  //     header("Location:error.php");
  //   }else if($fetcek['id_anggota']!=$id_anggota){
  //     header("Location:error.php");
  //   }
  // }else{
  //   header("Location:error.php");
  // }

  if(isset($_POST['ubahdataanggota'])){
    $idanggota=htmlspecialchars($_POST['idanggota']);
    $fotolama=htmlspecialchars($_POST['fotolama']);
    $namaanggota=htmlspecialchars($_POST['namaanggota']);
    $tlpanggota=htmlspecialchars($_POST['tlpanggota']);
    $kelaminanggota=htmlspecialchars($_POST['kelaminanggota']);
    $jabatananggota=htmlspecialchars($_POST['jabatananggota']);
    $statusanggota=htmlspecialchars($_POST['statusanggota']);


    if($_FILES['foto']['error']===4){
      $foto=$fotolama;
    }else{
      $foto =updatefoto($idanggota);
      if($get_anggota['foto_anggota'] != 'default.jpg'){
        unlink("img/anggota/".$get_anggota['foto_anggota']);
      }
    }

      $query="UPDATE anggota SET
          foto_anggota='$foto',
          nama_anggota='$namaanggota',
          tlp_anggota='$tlpanggota',
          kelamin_anggota='$kelaminanggota',
          jabatan_anggota='$jabatananggota',
          status_anggota='$statusanggota'
          WHERE id_anggota='$idanggota'
        ";
      $mysqli=mysqli_query($conn,$query);
      $notif=mysqli_affected_rows($conn);
      // var_dump($notif);die;
      if($notif>0){
        echo"<script>
            alert('Data berhasil diubah!');
            document.location.href='detail.php?id_anggota=".$idanggota."';
          </script>";
          exit;
      }else{
        echo"<script>
            alert('Data gagal diubah!');
            document.location.href='detail.php?id_anggota=".$idanggota."';
          </script>";
          exit;
      }
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

  <title>halaman detail</title>
  
  <script data-ad-client="ca-pub-7792471363511159" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

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
      <li class="nav-item">
        <a class="nav-link" href="pinjaman.php">
          <i class="fas fa-fw fa-funnel-dollar"></i>
          <span>Pinjaman</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="denda.php">
          <i class="far fa-fw fa-money-bill-alt"></i>
          <span>Denda</span></a>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h3 mb-0 text-gray-800">Anggota</h1> -->
          </div>

      		  <h4 class="text-center mb-4">Detail anggota</h4>
            <div class="row justify-content-center">
        		 	<div class="card" style="width:22rem;">
                <img class="card-img-top" src="img/anggota/<?=$get_anggota['foto_anggota']; ?>">

                <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="idanggota" value="<?=$id_anggota; ?>">
                  <input type="hidden" name="fotolama" value="<?=$get_anggota['foto_anggota']; ?>">
          			  <ul class="list-group list-group-flush">
                    <?php if(isset($_SESSION['login'])){ ?>
                      <?php if($_SESSION['login']=="admin"){ ?>
                        <li class="list-group-item fotofile">
                          <span style="font-weight:bold;"><input type="file" name="foto"></span>
                        </li>
                      <?php }else{echo "";} ?>
                    <?php }else{echo "";} ?>
          			    <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="95"><i class="far fa-fw fa-id-card"></i> Nama <span class="float-right">:</span></td>
                        <td> <?php if(isset($_SESSION['login'])){ ?>
                                <?php if($_SESSION['login']=="admin"){ ?>
                                  <input type="text" name="namaanggota" class="namahide form-control" value="<?=$get_anggota['nama_anggota']; ?>">
                                <?php }else{echo "";} ?>
                              <?php }else{echo "";} ?>
                          <span style="font-weight:bold;" class="namaanggota"><?=$get_anggota['nama_anggota']; ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>
                    <?php if(isset($_SESSION['login'])){ ?>
          			    <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="95"><i class="fas fa-fw fa-phone"></i> Tlp <span class="float-right">:</span></td>
                        <td> <?php if(isset($_SESSION['login'])){ ?>
                                <?php if($_SESSION['login']=="admin"){ ?>
                                  <input type="number" name="tlpanggota" class="tlphide form-control" value="<?=$get_anggota['tlp_anggota']; ?>">
                                <?php }else{echo "";} ?>
                              <?php }else{echo "";} ?>
                          <span style="font-weight:bold;" class="tlpanggota"><?=$get_anggota['tlp_anggota']; ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>
                    <?php }else{} ?>
                    <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="95"><i class="fas fa-fw fa-venus-mars"></i></i> Kelamin <span class="float-right">:</span></td>
                        <td> <?php if(isset($_SESSION['login'])){ ?>
                                <?php if($_SESSION['login']=="admin"){ ?>
                              <?php if($get_anggota['kelamin_anggota']=='laki-laki'){ ?>
                                <select class="jabatanhide form-control" name="kelaminanggota" style="">
                                  <option selected value="laki-laki">Laki-laki</option>
                                  <option value="perempuan">Perempuan</option>
                                </select>
                               <?php }else if($get_anggota['kelamin_anggota']=='perempuan'){ ?>
                                <select class="jabatanhide form-control" name="kelaminanggota" style="">
                                  <option value="laki-laki">Laki-laki</option>
                                  <option selected value="perempuan">Perempuan</option>
                                </select>
                               <?php } ?>
                                <?php }else{echo "";} ?>
                              <?php }else{echo "";} ?>
                          <span style="font-weight:bold;" class="jabatananggota"><?=$get_anggota['kelamin_anggota']; ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>
          			    <li class="list-group-item">
                      <table>
                        <tr>
                        <td width="95"><i class="fas fa-fw fa-suitcase"></i> Jabatan <span class="float-right">:</span></td>
                        <td> <?php if(isset($_SESSION['login'])){ ?>
                                <?php if($_SESSION['login']=="admin"){ ?>
                              <?php if($get_anggota['jabatan_anggota']=='ketua'){ ?>
                                <select class="jabatanhide form-control" name="jabatananggota">
                                  <option value="anggota">Anggota</option>
                                  <option value="humas">Humas</option>
                                  <option value="bendahara">Bendahara</option>
                                  <option value="wakil">Wakil</option>
                                  <option selected value="ketua">Ketua</option>
                                </select>
                               <?php }else if($get_anggota['jabatan_anggota']=='humas'){ ?>
                                <select class="jabatanhide form-control" name="jabatananggota">
                                  <option value="anggota">Anggota</option>
                                  <option selected value="humas">Humas</option>
                                  <option value="bendahara">Bendahara</option>
                                  <option value="wakil">Wakil</option>
                                  <option value="ketua">Ketua</option>
                                </select>
                               <?php }else if($get_anggota['jabatan_anggota']=='bendahara'){ ?>
                                <select class="jabatanhide form-control" name="jabatananggota">
                                  <option value="anggota">Anggota</option>
                                  <option value="humas">Humas</option>
                                  <option selected value="bendahara">Bendahara</option>
                                  <option value="wakil">Wakil</option>
                                  <option value="ketua">Ketua</option>
                                </select>
                               <?php }else if($get_anggota['jabatan_anggota']=='wakil'){ ?>
                                <select class="jabatanhide form-control" name="jabatananggota">
                                  <option value="anggota">Anggota</option>
                                  <option value="humas">Humas</option>
                                  <option value="bendahara">Bendahara</option>
                                  <option selected value="wakil">Wakil</option>
                                  <option value="ketua">Ketua</option>
                                </select>
                               <?php }else if($get_anggota['jabatan_anggota']=='anggota'){ ?>
                                <select class="jabatanhide form-control" name="jabatananggota">
                                  <option selected value="anggota">Anggota</option>
                                  <option value="humas">Humas</option>
                                  <option value="bendahara">Bendahara</option>
                                  <option value="wakil">Wakil</option>
                                  <option value="ketua">Ketua</option>
                                </select>
                               <?php } ?>
                                <?php }else{echo "";} ?>
                              <?php }else{echo "";} ?>
                          <span style="font-weight:bold;" class="jabatananggota"><?=$get_anggota['jabatan_anggota']; ?></span>
                        </td>
                        </tr>
                      </table>
                    </li>
          			    <li class="list-group-item">
                      <table>
                        <tr>
                          <td width="95"><i class="fas fa-fw fa-hourglass-half"></i> Status <span class="float-right">:</span></td> 
                          <td> <?php if(isset($_SESSION['login'])){ ?>
                                  <?php if($_SESSION['login']=="admin"){ ?>
                                <?php if($get_anggota['status_anggota']=='aktif'){ ?>
                                  <select class="statushide form-control" name="statusanggota">
                                    <option selected value="aktif">Aktif</option>
                                    <option value="non aktif">Non aktif</option>
                                    <option value="menikah">Menikah</option>
                                    <option value="drop out">Drop out</option>
                                  </select>
                                <?php }else if($get_anggota['status_anggota']=='non aktif'){ ?>
                                  <select class="statushide form-control" name="statusanggota">
                                    <option value="aktif">Aktif</option>
                                    <option selected value="non aktif">Non aktif</option>
                                    <option value="menikah">Menikah</option>
                                    <option value="drop out">Drop out</option>
                                  </select>
                                <?php }else if($get_anggota['status_anggota']=='menikah'){ ?>
                                  <select class="statushide form-control" name="statusanggota">
                                    <option value="aktif">Aktif</option>
                                    <option value="non aktif">Non aktif</option>
                                    <option selected value="menikah">Menikah</option>
                                    <option value="drop out">Drop out</option>
                                  </select>
                                <?php }else{ ?>
                                  <select class="statushide form-control" name="statusanggota">
                                    <option value="aktif">Aktif</option>
                                    <option value="non aktif">Non aktif</option>
                                    <option value="menikah">Menikah</option>
                                    <option selected value="drop out">Drop out</option>
                                  </select>
                                <?php } ?>
                                  <?php }else{echo "";} ?>
                                <?php }else{echo "";} ?>

                                  <span style="font-weight:bold;" class="statusanggota"><?=$get_anggota['status_anggota']; ?></span>
                          </td>
                        </tr>
                      </table>
                    </li>
          			  </ul>
                  <?php if(isset($_SESSION['login'])){ ?>
                    <?php if($_SESSION['login']=='admin'){ ?>
                  <div class="card-body editform">
                    <button type="submit" class="btn" name="ubahdataanggota">
                      <i class="fas fa-fw fa-check" style="font-size: 35px;color: green;"></i>
                    </button>
                    <button class="btn float-right cancel">
                      <i class="fas fa-fw fa-arrow-alt-circle-left" style="font-size: 35px;color: red;"></i>
                    </button>
                  </div>
                  </form>

                <div class="card-body awalform">
                  <button class="btn editanggota">
                  <i class="fas fa-fw fa-edit" style="font-size: 35px;color: green;"></i>
                  </button>
                  <a href="delete/deleteanggota.php?id_anggota=<?=$get_anggota['id_anggota']; ?>" class="btn float-right" onclick="return confirm('yakin ingin hapus?')">
                  <i class="fas fa-fw fa-trash-alt" style="font-size: 35px;color: red;"></i>
                  </a>
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
    // setTimeout(function() {
    $('.fotofile').hide();
    $('.namahide').hide();
    $('.tlphide').hide();
    $('.jabatanhide').hide();
    $('.statushide').hide();
    $('.editform').hide();
    // }, 100);

    $('.editanggota').on('click',function(){
      // setTimeout(function() {
      $('.awalform').hide();
      $('.namaanggota').hide();
      $('.tlpanggota').hide();
      $('.jabatananggota').hide();
      $('.statusanggota').hide();

      $('.fotofile').show();
      $('.namahide').show();
      $('.tlphide').show();
      $('.jabatanhide').show();
      $('.statushide').show();
      $('.editform').show();
      // }, 500);
    });

    $('.cancel').on('click',function(){
      // setTimeout(function() {

      $('.fotofile').hide();
      $('.namahide').hide();
      $('.tlphide').hide();
      $('.jabatanhide').hide();
      $('.statushide').hide();
      $('.editform').hide();
      // }, 500);
      $('.awalform').show();
      $('.namaanggota').show();
      $('.tlpanggota').show();
      $('.jabatananggota').show();
      $('.statusanggota').show();
      
    });
  </script>

</body>

</html>