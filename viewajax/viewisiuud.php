<?php  

  session_start();
  // sleep(1);
  require_once '../functions.php';

  if(isset($_POST['kirimisi'])){
  		$iduud=htmlspecialchars($_POST['kirimisi']);
		$datauud=mysqli_query($conn,"SELECT id_uud,id_isi,nama_uud,isi from daftaruud JOIN daftarisiuud USING (id_uud) WHERE id_uud='$iduud'");
	}else{
		header('location: ../index.php');
    	return exit;
	}

?>

                
		  <?php $no=1;  foreach($datauud as $uu): ?>
	        <div class="row">
              <div class="col-1">
                <?=$no++; ?>
              </div>
              <div class="col-11">
                <?=$uu['isi']; ?>
                <span class="editisiuud mr-3" data-idisi="<?=$uu['id_isi']; ?>" data-isiuud="<?=$uu['isi']; ?>" data-iduud="<?=$uu['id_uud']; ?>"><i class="fas fa-fw fa-edit text-success ukuran"></i></span>
                <span class="deleteisiuud" data-idisi="<?=$uu['id_isi']; ?>" data-iduud="<?=$uu['id_uud']; ?>"><i class="fas fa-fw fa-trash-alt text-danger ukuran"></i></span>
              </div>
            </div>
	      <?php endforeach; ?>