<?php
	session_start();
	if($_SESSION['status']!='login' AND $_SESSION['hak_akses']!='pustakawan')
		{
			header('Location:../index.php?masuk="paksaan_masuk"');	
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Pustakawan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- cdn icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- end cdn icon -->
	
	<!-- cdn bootstrap and w3schools -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<!-- end cdn bootstrap and w3schools -->

	<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

	<!-- lib -->
	<script src="../lib/JS/loader.js"></script>
	<script src="../lib/JS/dropdown.js"></script>
	<script src="../lib/JS/search.js"></script>
	<script src="../lib/JS/delete.js"></script>
	<link rel="stylesheet" href="../lib/CSS/info.css">
	<link rel="stylesheet" href="../lib/CSS/main.css">
	<link rel="stylesheet" href="../lib/CSS/loader.css">
	<!-- end lib -->

	

	<style>
		footer{
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
			text-align: center;
		}

		.sidebar{
			width:auto;
			padding-top: 30px;	
		}
	</style>
</head>
<body>


	<!-- loading screen -->
		<div class="preloader">
			<div class="loading">
				<img src="../lib/img/Loader.gif" width="200">
				<p>MEMUAT....</p>
			</div>
		</div>
    <!-- end loading screen -->

	<!-- atas -->
	<header>
		<div class=" data navbar navbar-expand-lg w3-blue">
			<a href="dashborad_admin.php" class="navbar-brand font">
				<img src="../lib/img/dinaslogo.png" style="width: 30px; margin-left: 20px;">
				 PERPUSTAKAAN ONLINE
			</a>
				
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#item" aria-controls="item" aria-expanded="false" aria-label="Toggle navigation">
				<span class="toggler navbar-toggler-icon w3-blue"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="item">
				<div class="d-flex" >					
					<ul class="navbar-nav ">
						<li class="nav-item">
						<a href="#" onclick="document.getElementById('id01').style.display='block'" class="nav-link bi bi-info-circle font"> Tentang Perpustakaan</a>
						</li>

						<div class="w3-dropdown-hover">
							<button class="w3-button bi bi-person-badge-fill font"> Pengguna: <?php echo "{$_SESSION['username']}" ?></button>
							
							<div class="w3-dropdown-content w3-bar-block w3-border w3-animate-opacity">
								<a onclick='return confirm("Apa anda yakin ingin Logout ? ");' href="../tindakan/logout.php" class="w3-bar-item w3-button bi bi-box-arrow-right"> Logout</a>
							</div>
						</div>
					</ul>
				</div>
			</div>
					
		</div>
	</header>
	<!-- akhir atas -->

	<!-- sidebar -->

	<div class="w3-sidebar w3-bar-block w3-blue sidebar w3-card">
		<a href="dashborad_admin.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
		
		<button class="w3-button w3-block w3-left-align" onclick="bookFunc()"><i class="bi bi-book"></i> BUKU <i class="fa fa-caret-down"></i></button>
		<div id="itemDropdownBook" class="w3-hide w3-small w3-white w3-card">
			<a href="input_book.php" class="w3-bar-item w3-button bi bi-bookmark-plus"> Tambah Buku</a>
			<a href="data_book.php" class="w3-bar-item w3-button bi bi-journal-bookmark-fill"> Data Buku</a>
			<a href="../ebooklist.php" class="w3-bar-item w3-button bi bi-journal-richtext"> Daftar Buku</a>
		</div>

		<button class="w3-button w3-block w3-left-align " onclick="userFunc()"><i class="bi bi-person-circle"></i> PUSTAKAWAN <i class="fa fa-caret-down"></i></button>
		<div id="itemDropdownUser" class="w3-hide w3-white w3-small w3-card">
			<a href="input_admin.php" class="w3-bar-item w3-button bi bi-person-plus-fill"> Tambah Pustakawan</a>
			<a href="data_admin.php" class="w3-bar-item w3-button bi bi-person-lines-fill"> Data Pustakawan</a>
		</div>

        <a href="data_pengunjung.php" class="w3-bar-item w3-button w3-light-grey"><i class="bi bi-person"></i> Data Pengunjung</a>

		<a href="Help.php" class="w3-bar-item w3-button"><i class="bi bi-question-circle"></i> BANTUAN</a>
	</div>			
	<!-- end sidebar -->

	<!-- isi -->
		<div class="w3-container mt-sm-5" style="margin-left: 170px; min-height: 600px;" >

			<h2 class='w3-center'>Data Pustakawan</h2>
			
			<div class="col">
				<div class="col-lg-3">
					<input type="text" id="searchpengunjung" class="form-control mt-lg-3 mb-lg-2" style="font-family: FontAwesome;" placeholder="&#61442; Nama Admin...">
				</div>
			</div>
			<div class="w3-responsive  mb-lg-5">
			<table class="w3-table-all w3-hoverable">
				<thead>
				<tr class="w3-light-grey">
					<th>No.</th>
					<th>Nama</th>
					<th>Email</th>
					<th>telepon</th>
					<th>Gender</th>
					<th>pendidikan</th>
					<th>Pekerjaan</th>
					<th>Kartu Identitas</th>
					<th>Tipe Identitas</th>
					<th>Username</th>
					<th>Password</th>
					<th colspan="2">Aksi</th>
				</tr>
				</thead>

				<tbody id="tampilpengunjung">
					<?php
						require_once '../class/pengunjung.php';

						$query = "SELECT * FROM tbl_pengunjung ORDER BY id_pengunjung ASC";
						
						$pengunjung->Viewpengunjung($query);
					?>
				</tbody>

			</table>
			</div>

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

