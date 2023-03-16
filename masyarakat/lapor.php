<?php 

    include('../conn/koneksi.php');

        $tgl = date('Y-m-d');
		$no=1;
		$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik");
		 { ?>

<link rel="stylesheet" href="../css/daftar.css">


    <section class="container3">
        <form method="POST" enctype="multipart/form-data">
          <div class="input-box" style="color: #fff;">
            <label for="nik">NIK</label>
            <br><?php echo ucwords($_SESSION['data']['nik']); ?>
          </div>

        <div class="input-box" style="color: #fff;">
          <label for="nama">Nama</label>
          <br><?php echo ucwords($_SESSION['data']['nama']); ?>
        </div>

        <div class="input-box" style="color: #fff;">
          <label for="tgl">Tanggal Pengaduan</label>
          <br><?php echo $tgl; ?>
        </div>
		
		<div class="input-box" style="color: #fff;">
          <label for="judul">Judul Laporan</label>
          <br><input type="textarea" name="judul">
        </div>

        <div class="input-box" style="color: #fff;">
          <label for="laporan">Tulis Laporan</label>
          <br><input type="textarea" name="laporan">
        </div>

        <div class="input-box" style="color: #fff;">
            <label>Gambar</label>
			<input type="file" name="foto"><br><br>
        </div>

        <input type="submit" name="kirim" value="Kirim">
      </form>
    </section>

    <?php 
	
	 if(isset($_POST['kirim'])){
	 	$nik = $_SESSION['data']['nik'];
	 	$tgl = date('Y-m-d');


	 	$foto = $_FILES['foto']['name'];
	 	$source = $_FILES['foto']['tmp_name'];
	 	$folder = './../img/';
	 	$listeks = array('jpg','png','jpeg');
	 	$pecah = explode('.', $foto);
	 	$eks = $pecah['1'];
	 	$size = $_FILES['foto']['size'];
	 	$nama = date('dmYis').$foto;

		if($foto !=""){
		 	if(in_array($eks, $listeks)){
		 		if($size<=100000){
					move_uploaded_file($source, $folder.$nama);
					$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['judul']."','".$_POST['laporan']."','$nama','proses')");

		 			if($query){
			 			echo "<script>alert('Pengaduan Akan Segera di Proses')</script>";
			 			echo "<script>location='index.php?p=pengaduan';</script>";
		 			}

		 		}
		 		else{
		 			echo "<script>alert('Akuran Gambar Tidak Lebih Dari 100KB')</script>";
		 		}
		 	}
		 	else{
		 		echo "<script>alert('Format File Tidak Di Dukung')</script>";
		 	}
		}
		else{
			$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['judul']."','".$_POST['laporan']."','noImage.png','proses')");
			if($query){
			 	echo "<script>alert('Pengaduan Akan Segera Ditanggapi')</script>";
	 			echo "<script>location='index.php?p=pengaduan';</script>";
 			}
		}
	}
}
?>