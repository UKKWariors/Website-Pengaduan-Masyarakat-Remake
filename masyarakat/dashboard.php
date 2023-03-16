<table id="example" class="display responsive-table" border="2" style="width: 100%;">
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
				<?php 
					$no=1;
					$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE pengaduan.nik='".$_SESSION['data']['nik']."' ORDER BY pengaduan.id_pengaduan DESC");
					while ($r=mysqli_fetch_assoc($pengaduan)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $r['nik']; ?></td>
						<td><?php echo $r['nama']; ?></td>
						<td><?php echo $r['judul']; ?></td>
						<td><?php echo $r['tgl_pengaduan']; ?></td>
						<td><?php echo $r['status']; ?></td>
						<td>
							<a class="btn blue modal-trigger" href="#tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">DETAIL</a> 

<!-- ditanggapi -->
        <div id="tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12">
				<p>NIK : <?php echo $r['nik']; ?></p>
            	<p>Dari : <?php echo $r['nama']; ?></p>
				<p>Judul : <?php echo $r['judul']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<p>Tanggal Ditanggapi : <?php echo $r['tgl_tanggapan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p><br>
				<p>Yang Menanggapi : <?php echo $r['level'];?></p>
				<b>Respon</b>
				<p><?php echo $r['tanggapan']; ?></p>
				<?php 
					if($r['bukti']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['bukti']; ?>">
				<?php }
				 ?>
            </div>

          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ditanggapi -->

					</tr>
				<?php	}
				 ?>
		</td>
	</tr>
</table>