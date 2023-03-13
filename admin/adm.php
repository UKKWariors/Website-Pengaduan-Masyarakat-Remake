<table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>Email</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Telephone</th>
				<th>level</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$tampil = mysqli_query($koneksi,"SELECT * FROM petugas ORDER BY nama_petugas ASC");
		while ($r=mysqli_fetch_assoc($tampil)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['email']; ?></td>
			<td><?php echo $r['nama_petugas']; ?></td>
			<td><?php echo $r['username']; ?></td>
			<td><?php echo $r['telp_petugas']; ?></td>
			<td><?php echo $r['level']; ?></td>
			<td><a class="btn teal modal-trigger" href="#adm_edit<?php echo $r['id_petugas'] ?>">Edit</a> <a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=adm_hapus&id_petugas=<?php echo $r['id_petugas'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="adm_edit<?php echo $r['id_petugas'] ?>" class="modal">
          <div class="modal-content">
            <h4>Edit</h4>
			<form method="POST">
			<div class="col s12 input-field">
					<label for="email">Email</label>		
					<input id="email" type="text" name="email" value="<?php echo $r['email']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input hidden type="text" name="id_petugas" value="<?php echo $r['id_petugas']; ?>">
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama_petugas']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?php echo $r['telp_petugas']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<p>
						<label>
						  <input value="admin" class="with-gap" name="level" type="radio" <?php if($r['level']=="admin"){echo "checked";} ?> />
						  <span>Admin</span>
						</label>
						<label>
						  <input value="petugas" class="with-gap" name="level" type="radio" <?php if($r['level']=="petugas"){echo "checked";} ?> />
						  <span>Petugas</span>
						</label>
					</p>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					// echo $_POST['nama'].$_POST['username'].$_POST['telp'].$_POST['level'];
					$update=mysqli_query($koneksi,"UPDATE petugas SET email='".$_POST['email']."',nama_petugas='".$_POST['nama']."',username='".$_POST['username']."',telp_petugas='".$_POST['telp']."',level='".$_POST['level']."' WHERE id_petugas='".$_POST['id_petugas']."' ");
					if($update){
						echo "<script>alert('Data di Update')</script>";
						echo "<script>location='index.php?p=adm'</script>";
						echo "<script>location.reload()</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        