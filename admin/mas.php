<table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
					<th>No</th>
					<th>NIK</th>
					<th>Email</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Telp</th>
                	<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
	
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM masyarakat ORDER BY nik ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nik']; ?></td>
			<td><?php echo $r['email']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['username']; ?></td>
			<td><?php echo $r['telp']; ?></td>
			<td><a class="btn teal modal-trigger" href="#mas_edit?nik=<?php echo $r['nik'] ?>">Edit</a> <a onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" class="btn red" href="index.php?p=mas_hapus&nik=<?php echo $r['nik'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="mas_edit?nik=<?php echo $r['nik'] ?>" class="modal">
          <div class="modal-content">
            <h4>Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nik">NIK</label>
					<input id="nik" type="number" name="nik" style="color: #000;" value="<?php echo $r['nik']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="email">Email</label>		
					<input id="email" type="text" name="email" style="color: #000;" value="<?php echo $r['email']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama" style="color: #000;" value="<?php echo $r['nama']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" style="color: #000;" value="<?php echo $r['username']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" style="color: #000;" value="<?php echo $r['telp']; ?>">
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					$update=mysqli_query($koneksi,"UPDATE masyarakat SET nik='".$_POST['nik']."',email='".$_POST['email']."',nama='".$_POST['nama']."',username='".$_POST['username']."',telp='".$_POST['telp']."' WHERE nik='".$_POST['nik']."' ");
					if($update){
						echo "<script>alert('Data di Update')</script>";
						echo "<script>location='index.php?p=mas'</script>";
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
