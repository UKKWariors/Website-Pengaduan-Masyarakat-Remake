<table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>Judul Laporan</th>
				<th>Tanggal Masuk</th>
				<th>Status</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE pengaduan.nik='".$_SESSION['data']['nik']."' AND status='proses' ORDER BY pengaduan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nik']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['judul']; ?></td>
			<td><?php echo $r['tgl_pengaduan']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td><a class="btn modal-trigger blue" href="#more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>">More </a></td>

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
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        
