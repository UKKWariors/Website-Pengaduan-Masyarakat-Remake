<?php 
	session_start();
  ob_start();
	include '../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['data']['level'] != "admin"){
		header('location:../index.php');
	}
?>
  <!DOCTYPE html>
  <html>
    <head>
    	<title>Aplikasi Pengaduan masyarakat</title>
		<!--Import Google Icon Font-->
		<link href="../css/font.css" rel="stylesheet">

		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="../css/materialize.min.css">

		<!-- Compiled and minified JavaScript -->
		<script src="../js/materialize.min.js"></script>

		<script src="../js/jquery.min.js"></script>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">

		<link href="../css/style.css" rel="stylesheet">

		<!-- Boxicons -->
		<link href="../css/boxicons2.min.css" rel="stylesheet" />

		<script src="../js/jquery.min.js"></script>
		
		<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.js"></script>

		<script type="text/javascript">
			$(document).ready( function () {
			$('#example').DataTable();
			$('select').formSelect();
			} );
		</script>

    </head>

    <body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Menu Admin</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="index.php?p=dashboard">
          <i class='bx bxs-dashboard' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php?p=dashboard">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-user-plus' ></i>
            <span class="link_name">Tambah User</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Tambah User</a></li>
          <li><a href="index.php?p=adm_input">Petugas</a></li>
          <li><a href="index.php?p=mas_input">Masyarakat</a></li>
        </ul>
      </li>
      <li>
          <a href="index.php?p=pengaduan">
            <i class='bx bxs-report' ></i>
            <span class="link_name">Laporan</span>
          </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php?p=pengaduan">Laporan</a></li>
		</ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-user-account' ></i>
            <span class="link_name">Kelola User</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Kelola User</a></li>
          <li><a href="index.php?p=adm">Admin</a></li>
          <li><a href="index.php?p=mas">Masyarakat</a></li>
        </ul>
      </li>
      <li>
        <a href="index.php?p=respon">
          <i class='bx bx-reply' ></i>
          <span class="link_name">Respon</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php?p=respon">Respon</a></li>
        </ul>
      </li>
      <li>
        <a href="index.php?p=cetak">
          <i class='bx bx-printer'></i>
          <span class="link_name">Cetak Laporan</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php?p=cetak">Cetak Laporan</a></li>
        </ul>
      </li>
      <br>
      <hr>
      <br>
      <li>
        <a href="../logout.php">
          <i class='bx bx-log-out'></i>
          <p class="link_name">  <?php echo ucwords($_SESSION['data']['nama_petugas']); ?> </p>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../logout.php">log out</a></li>
        </ul>
      </li>
      
     
      
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
	  <div class="home-content-print">
    <?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="mas"){
			include_once 'mas.php';
		}
		elseif(@$_GET['p']=="cetak"){
			include_once 'cetak.php';
		}
		elseif(@$_GET['p']=="mas_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM masyarakat WHERE nik='".$_GET['nik']."'");
			if($query){
        header('location:index.php?p=mas');
			}
		}
		elseif(@$_GET['p']=="pengaduan"){
			include_once 'pengaduan.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['foto']);
			if($data['status']=="proses"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				header('location:index.php?p=pengaduan');
			}
			elseif($data['status']=="selesai"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				if($delete){
					$delete2=mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
					header('location:index.php?p=pengaduan');
				}	
			}

		}
		elseif(@$_GET['p']=="more"){
			include_once 'more.php';
		}
		elseif(@$_GET['p']=="respon"){
			include_once 'respon.php';
		}
		elseif(@$_GET['p']=="tanggapan_hapus"){
			
			$query = mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_tanggapan='".$_GET['id_tanggapan']."'");
			if($query){
				header('location:index.php?p=respon');
			}
		}
		elseif(@$_GET['p']=="adm"){
			include_once 'adm.php';
		}
		elseif(@$_GET['p']=="adm_input"){
			include_once 'adm_input.php';
		}
		elseif(@$_GET['p']=="adm_edit"){
			include_once 'adm_edit.php';
		}
		elseif(@$_GET['p']=="adm_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM petugas WHERE id_petugas='".$_GET['id_petugas']."'");
			if($query){
				header('location:index.php?p=adm');
			}
		}
    elseif(@$_GET['p']=="mas"){
			include_once 'mas.php';
		}
    elseif(@$_GET['p']=="mas_input"){
			include_once 'mas_input.php';
		}
		elseif(@$_GET['p']=="laporan"){
			include_once 'laporan.php';
		}
	?>
	 </div>
    </div>
  </section>
  
</body>
</html>

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/materialize.min.js"></script>

      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.modal');
          var instances = M.Modal.init(elems);
        });
      </script>

<script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>

    </body>
  </html>