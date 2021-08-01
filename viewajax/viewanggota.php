<?php 

  session_start();
  // sleep(1);
  require_once '../functions.php';
  // $data=anggota("SELECT * FROM anggota WHERE status_anggota='aktif' or status_anggota='non aktif' ORDER BY nama_anggota");

  if(isset($_POST['optiontipe'])||isset($_POST['keywordcari'])){
    $optiontipe=htmlspecialchars($_POST['optiontipe']);
    $keywordcari=htmlspecialchars(strtolower($_POST['keywordcari']));
    if($optiontipe==='all'){
      $data=anggota("SELECT * FROM anggota WHERE nama_anggota like '%$keywordcari%' ORDER BY status_anggota,nama_anggota");
    }
    else if($optiontipe==='aktif / non aktif'){
      $data=anggota("SELECT * FROM anggota WHERE (status_anggota='aktif' or status_anggota='non aktif') and nama_anggota like '%$keywordcari%' ORDER BY status_anggota,nama_anggota");
    }
    else{
      $data=anggota("SELECT * FROM anggota WHERE status_anggota='$optiontipe' and nama_anggota like '%$keywordcari%' ORDER BY status_anggota,nama_anggota");
    // var_dump($_POST->optiontipe);
    // return exit;
    }
  }else{
    header('location: ../anggota.php');
    return exit;
  }

?>    

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