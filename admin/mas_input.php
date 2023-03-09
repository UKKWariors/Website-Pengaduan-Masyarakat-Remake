<?php 

include('../conn/koneksi.php');

    if(isset($_POST['input'])){
        $password = md5($_POST['password']);

        $query=mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['email']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."', 1)");
        if($query){
            echo "<script>alert('Data Ditambahkan')</script>";
            echo "<script>location='index.php?p=mas'</script>";
            echo "<script>location.reload()</script>";
        }
    }
?>

<link rel="stylesheet" href="../css/daftar.css">


    <section class="container2">
        <form method="POST">

        <div class="column">
          <div class="input-box">
            <label for="nik">NIK</label>
            <input id="nik" type="number" name="nik" required />
          </div>
        </div>

        <div class="input-box">
          <label for="nama">Nama</label>
          <input id="nama" type="text" name="nama" required />
        </div>

        <div class="input-box">
          <label for="email">Alamat Email</label>
          <input id="email" type="text" name="email" required />
        </div>

        <div class="input-box">
          <label for="username">Nama Pengguna</label>
          <input id="username" type="text" name="username" required />
        </div>

        <div class="input-box">
          <label for="password">Kata Sandi</label>
          <input id="password" type="password" name="password" pattern={6} required />
        </div>

        <div class="column">
          <div class="input-box">
            <label for="telp">Nomor Telepon</label>
            <input id="telp" type="number" name="telp" required />
          </div>
        </div>
        <input type="submit" name="input" value="Simpan">
      </form>
    </section>
  </body>
</html>

