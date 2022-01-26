<?php
	session_start();
	if($_SESSION['status']!='login' AND $_SESSION['hak_akses']!='pengunjung')
		{
			header('Location:index.php?masuk="paksaan_masuk"');	
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Pustakawan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="lib/JS/loader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
	<link rel="stylesheet" href="lib/CSS/info.css">
	<link rel="stylesheet" href="lib/CSS/main.css">
	<link rel="stylesheet" href="lib/CSS/loader.css">
</head>
<body>


	<!-- loading screen -->
		<div class="preloader">
			<div class="loading">
				<img src="lib/img/Loader.gif" width="200">
				<p>MEMUAT....</p>
			</div>
		</div>
    <!-- end loading screen -->


    <!-- atas -->
	<header>
		<div class="navbar navbar-expand-lg w3-blue">
			<a href="dashboard.php" class="navbar-brand font">
				<img src="lib/img/dinaslogo.png" style="width: 30px; margin-left: 20px;">
				 PERPUSTAKAAN ONLINE
			</a>
				
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#item" aria-controls="item" aria-expanded="false" aria-label="Toggle navigation">
				<span class="toggler navbar-toggler-icon w3-blue"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="item">
				<div class="d-flex" >					
					<ul class="navbar-nav ">
						<li class="nav-item font">
							<a href="dashboard.php" class="nav-link font"><i class="fa fa-home"></i> HOME</a>
						</li>
						<li class="nav-item active">
							<a href="ebooklist.php" class="nav-link bi bi-journal-richtext font"> Daftar Buku</a>
						</li>

						<li class="nav-item">
						<a href="#" onclick="document.getElementById('id01').style.display='block'" class="nav-link bi bi-info-circle font"> Tentang Perpustakaan</a>
						</li>

						<div class="w3-dropdown-hover">
							<button class="w3-button bi bi-person-badge-fill font"> Pengguna: <?php echo "{$_SESSION['username']}" ?></button>
							
							<div class="w3-dropdown-content w3-bar-block w3-border w3-animate-opacity">
								<?php 
								require_once 'class/koneksi.php';
								$query = "SELECT * FROM tbl_pengunjung WHERE id_pengunjung=". $_SESSION['idPengunjung'];
								$view = $con->prepare($query);
								$view->execute();
											
								while($row = $view->fetch(PDO::FETCH_ASSOC))
								{
									if(isset($row['foto_profile'])==''){
									?>
										<a href="profile.php" class="w3-bar-item w3-button"><img src="lib/img/image_profile_default.jpg" for="fileElem" class="w3-circle" style="width:100%; max-width:20px"> Profile</a>
									<?php
									}

									else{?>
										<a href="profile.php" class="w3-bar-item w3-button"><img src="fileUpload/foto profile/<?php echo "{$row['foto_profile']}" ?>" for="fileElem" class="w3-circle" style="width:100%; max-width:20px"> Profile</a>
									<?php
									}
								}
								?>
								<a onclick='return confirm("Apa anda yakin ingin Logout ? ");' href="tindakan/logout.php" class="w3-bar-item w3-button bi bi-box-arrow-right"> Logout</a>
							</div>
						</div> 	
					</ul>
				</div>
			</div>
					
		</div>
	</header>
	<!-- akhir atas -->

	<!-- isi -->
		<div class="w3-bar">
		
		<div class="w3-container">
            <h3 style="text-align: center">BUKU YANG SUDAH PERNAH DI BACA</h3>
					<?php
						require_once 'class/profile.php';
                        
                          $query = "SELECT DISTINCT id_ebook, judulEbook, nama_ebook, name_cover FROM tbl_record_history WHERE id_pengunjung = ".$_SESSION['idPengunjung'];
                          $profile->viewhistorymembaca($query);
					?>
		</div>	
	<!-- end isi -->

	<!-- footer -->
	<div class="w3-bar w3-blue w3-card w3-block">
		<p class="w3-center">Copyright &copy; Ahmad Wahyudin & Bayu Maulana 2021 <p>
	</div>   
	<!-- end footer -->

				<div id="id01" class="w3-modal">
					<div class="w3-modal-content">
						<header class="w3-container w3-teal"> 
							<span onclick="document.getElementById('id01').style.display='none'" 
							class="w3-button w3-display-topright">&times;</span>
							<div class="template ">
								<h2>Profil Perpustakaan</h2>
							</div>
						</header>

						<div class="w3-container">
							<div class="main">
								<div class="box1 bg-primary">

									<h6>Misi</h6>

									<p>Terwujudnya Masyarakat Yang Cerdas Dan Banyak Ilmu Pengetahun Melalui 
										Gemar Membaca Dengan Memberdayakan Perpustakaan </p>

									<P>Menjadi perpustakaan berbasis web ini mampu mendukung perkembangan teknologi, sosial, budaya dan ekonomi berbasis teknologi informasi dalam
									persoalan dan memudahkan masyarakat dalam hal membaca buku</P>

									
									<h6>Visi</h6>

									<p>1. Terwujudnya layanan Perpustakaan Online</p>
									<p>2. Terwujudnya perpustakaan sebagai Pelestari budaya bangsa  </p>
									<p>3. Memberikan layanan prima dalam mengakses dan menyediakan informasi/bahan pustaka yang diperlukan pemustaka</p>
								</div>

								<div class="box2 bg-primary">
									<h6>Identitas Perpustakaan</h6>
									<hr>
									<p>Dinas Perpustakaan Kab.Karawang</p>
								</div>
							</div>
						</div>
					</div>
				</div>
</body>
</html>