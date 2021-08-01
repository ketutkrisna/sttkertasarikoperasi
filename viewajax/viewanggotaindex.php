<?php 

	session_start();
  	// sleep(1);
  	require_once '../functions.php';
  	if(isset($_POST['kirimdata'])){
		$data=anggota("SELECT * FROM anggota ORDER BY nama_anggota");

		$humas=mysqli_query($conn,"SELECT count(jabatan_anggota)as contol FROM anggota where jabatan_anggota='humas'");
	    $kontol=mysqli_fetch_assoc($humas)['contol'];
	}else{
		header('location: ../index.php');
    	return exit;
	}
?>

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