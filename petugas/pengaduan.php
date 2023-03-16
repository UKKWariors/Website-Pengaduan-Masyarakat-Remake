<table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>Tanggal Masuk</th>
				<th>Status</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE pengaduan.status='proses' ORDER BY pengaduan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nik']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['tgl_pengaduan']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td><a class="btn modal-trigger blue" href="#more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Tanggapi</a> <a class="btn modal-trigger red" href="#tolak?id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Tolak</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12 m6">
				<p>NIK : <?php echo $r['nik']; ?></p>
            	<p>Dari : <?php echo $r['nama']; ?></p>
				<p>Judul Laporan : <?php echo $r['judul']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<p>Status : <?php echo $r['status']; ?></p>
            </div>
            <?php 
            	if($r['status']=="proses"){ ?>
	            <div class="col s12 m6">
					<form method="POST" enctype="multipart/form-data">
						<div class="col s12 input-field">
							<label for="textarea">Tanggapan</label>
							<textarea id="textarea" name="tanggapan" style="color: #000;" class="materialize-textarea"></textarea>
						</div>
						<div class="input-box">
            				<label for="bukti">Bukti</label>
							<input type="file" style="color: #000;" name="bukti">
        				</div>
						<div class="col s12 input-field">
							<input type="submit" name="tanggapi" value="Kirim" class="btn right">
						</div>
					</form>
	            </div>
            <?php	}
             ?>

			<?php 
				if(isset($_POST['tanggapi'])){
					$tgl = date('Y-m-d');

					$bukti = $_FILES['bukti']['name'];
					$source = $_FILES['bukti']['tmp_name'];
					$folder = './../img/';
					$listeks = array('jpg','png','jpeg');
					$pecah = explode('.', $bukti);
					$eks = $pecah['1'];
					$size = $_FILES['bukti']['size'];
					$namabukti = date('dmYis').$bukti;

					if($bukti !=""){
						if(in_array($eks, $listeks)){
							if($size<=100000){
								move_uploaded_file($source, $folder.$namabukti);
								$query = mysqli_query($koneksi,"INSERT INTO tanggapan VALUES (NULL,'".$r['id_pengaduan']."','".$tgl."','".$_POST['tanggapan']."','$namabukti','".$_SESSION['data']['id_petugas']."')");

								if($query){
									$update=mysqli_query($koneksi,"UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='".$r['id_pengaduan']."'");
									if($update){
										echo "<script>alert('Tanggapan Terkirim')</script>";
										echo "<script>location='index.php?p=pengaduan';</script>";
									}
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
						$query = mysqli_query($koneksi,"INSERT INTO tanggapan VALUES (NULL,'".$r['id_pengaduan']."','".$tgl."','".$_POST['tanggapan']."','noImage.png','".$_SESSION['data']['id_petugas']."')");
						if($query){
							$update=mysqli_query($koneksi,"UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='".$r['id_pengaduan']."'");
							if($update){
								echo "<script>alert('Tanggapan Terkirim')</script>";
								echo "<script>location='index.php?p=pengaduan';</script>";
							}
						}
					}
				}
			?>
          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>

		<div id="tolak?id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12 m6">
				<p>NIK : <?php echo $r['nik']; ?></p>
            	<p>Dari : <?php echo $r['nama']; ?></p>
				<p>Judul Laporan : <?php echo $r['judul']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<p>Status : <?php echo $r['status']; ?></p>
            </div>
            <?php 
            	if($r['status']=="proses"){ ?>
	            <div class="col s12 m6">
					<form method="POST" enctype="multipart/form-data">
						<div class="col s12 input-field">
							<label for="textarea">Tanggapan</label>
							<textarea id="textarea" name="tanggapan" style="color: #000;" class="materialize-textarea"></textarea>
						</div>
						<div class="input-box">
            				<label for="bukti">Bukti</label>
							<input type="file" style="color: #000;" name="bukti">
        				</div>
						<div class="col s12 input-field">
							<input type="submit" name="tolak" value="Kirim" class="btn right">
						</div>
					</form>
	            </div>
            <?php	}
             ?>

			<?php 
				if(isset($_POST['tolak'])){
					$tgl = date('Y-m-d');

					$bukti = $_FILES['bukti']['name'];
					$source = $_FILES['bukti']['tmp_name'];
					$folder = './../img/';
					$listeks = array('jpg','png','jpeg');
					$pecah = explode('.', $bukti);
					$eks = $pecah['1'];
					$size = $_FILES['bukti']['size'];
					$namabukti = date('dmYis').$bukti;

					if($bukti !=""){
						if(in_array($eks, $listeks)){
							if($size<=100000){
								move_uploaded_file($source, $folder.$namabukti);
								$query = mysqli_query($koneksi,"INSERT INTO tanggapan VALUES (NULL,'".$r['id_pengaduan']."','".$tgl."','".$_POST['tanggapan']."','$namabukti','".$_SESSION['data']['id_petugas']."')");

								if($query){
									$update=mysqli_query($koneksi,"UPDATE pengaduan SET status='ditolak' WHERE id_pengaduan='".$r['id_pengaduan']."'");
									if($update){
										echo "<script>alert('Tanggapan Terkirim')</script>";
										echo "<script>location='index.php?p=pengaduan';</script>";
									}
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
						$query = mysqli_query($koneksi,"INSERT INTO tanggapan VALUES (NULL,'".$r['id_pengaduan']."','".$tgl."','".$_POST['tanggapan']."','noImage.png','".$_SESSION['data']['id_petugas']."')");
						if($query){
							$update=mysqli_query($koneksi,"UPDATE pengaduan SET status='ditolak' WHERE id_pengaduan='".$r['id_pengaduan']."'");
							if($update){
								echo "<script>alert('Tanggapan Terkirim')</script>";
								echo "<script>location='index.php?p=pengaduan';</script>";
							}
						}
					}
				}
			?>
          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        
