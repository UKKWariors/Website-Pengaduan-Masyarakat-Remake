<?php 
	session_start();
	include '../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['data']['level'] != "petugas"){
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
      <span class="logo_name">Menu Petugas</span>
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
          <a href="index.php?p=pengaduan">
            <i class='bx bxs-report' ></i>
            <span class="link_name">Laporan</span>
          </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php?p=pengaduan">Laporan</a></li>
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
		elseif(@$_GET['p']=="tanggapan"){
			include_once 'tanggapan.php';
		}
		elseif(@$_GET['p']=="respon"){
			include_once 'respon.php';
		}
		elseif(@$_GET['p']=="tanggapan_hapus"){
			
			$query = mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_tanggapan='".$_GET['id_tanggapan']."'");
			if($query){
				header('location:index.php?p=tanggapan_show');
			}
		}
	 ?>
   </div>
</div>
  </section>

    <!-- <body style="background:url(../img/bg.jpg); background-size: cover;">

    <div class="row">
      <div class="col s12 m3">
          <ul id="slide-out" class="sidenav sidenav-fixed">
              <li>
                  <div class="user-view">
                      <div class="background">
                          <img src="../img/bg.jpg">
                      </div>
                      <a href="#user"><img class="circle" src="https://cdn5.vectorstock.com/i/1000x1000/01/69/businesswoman-character-avatar-icon-vector-12800169.jpg"></a>
                      <a href="#name"><span class="blue-text name"><?php echo ucwords($_SESSION['data']['nama_petugas']); ?></a>
                  </div>
              </li>
              <li><a href="index.php?p=dashboard"><i class="material-icons">dashboard</i>Dashboard</a></li>
              <li><a href="index.php?p=pengaduan"><i class="material-icons">report</i>Pengaduan</a></li>
              <li><a href="index.php?p=respon"><i class="material-icons">question_answer</i>Respon</a></li>
              <li>
                  <div class="divider"></div>
              </li>
              <li><a class="waves-effect" href="../logout.php"><i class="material-icons">logout</i>Logout</a></li>
          </ul>

          <a href="#" data-target="slide-out" class="btn sidenav-trigger"><i class="material-icons">menu</i></a>
      </div> -->




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