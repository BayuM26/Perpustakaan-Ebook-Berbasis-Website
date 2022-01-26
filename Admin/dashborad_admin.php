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
	<title>Dahsboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- cdn icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <!-- end cdn icon -->
    
	<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>

	<!-- cdn boostrap and w3schools -->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<!-- end cdn boostrap and w3schools -->

	<!-- cdn chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js"></script>
	<!-- end cdn chart -->

	<script src="../lib/JS/loader.js"></script>
	<script src="../lib/JS/dropdown.js"></script>
	<link rel="stylesheet" href="../lib/CSS/info.css">
	<link rel="stylesheet" href="../lib/CSS/main.css">
	<link rel="stylesheet" href="../lib/CSS/loader.css">
	

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
			<div class="navbar navbar-expand-lg w3-blue">
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
		<div class="sidebar w3-sidebar w3-bar-block w3-blue w3-card">
			<a href="dashborad_admin.php" class="w3-bar-item w3-button w3-light-grey"><i class="fa fa-home"></i> HOME</a>
			
			<button class="w3-button w3-block w3-left-align" onclick="bookFunc()"><i class="bi bi-book"></i> BUKU <i class="fa fa-caret-down"></i></button>
			<div id="itemDropdownBook" class="w3-hide w3-small w3-white w3-card">
				<a href="input_book.php" class="w3-bar-item w3-button bi bi-bookmark-plus"> Tambah Buku</a>
				<a href="data_book.php" class="w3-bar-item w3-button bi bi-journal-bookmark-fill"> Data Buku</a>
				<a href="../ebooklist.php" class="w3-bar-item w3-button bi bi-journal-richtext"> Daftar Buku</a>
			</div>

			<button class="w3-button w3-block w3-left-align" onclick="userFunc()"><i class="bi bi-person-circle"></i> Pustakawan <i class="fa fa-caret-down"></i></button>
			<div id="itemDropdownUser" class="w3-hide w3-white w3-small w3-card">
				<a href="input_admin.php" class="w3-bar-item w3-button bi bi-person-plus-fill"> Tambah Pustakawan</a>
				<a href="data_admin.php" class="w3-bar-item w3-button bi bi-person-lines-fill"> Data Pustakawan</a>
			</div>

			<a href="data_pengunjung.php" class="w3-bar-item w3-button"><i class="bi bi-person"></i> Data Pengunjung</a>

			<a href="Help.php" class="w3-bar-item w3-button"><i class="bi bi-question-circle"></i> BANTUAN</a>
		</div>		
	<!-- end sidebar -->

	<!-- isi -->
		<?php
			require_once '../class/dashboardAdmin.php';
		?>
		<div class="w3-contrainer" style="margin-left: 180px; min-height: 600px;">

			<div class="row">
				<div class="offset-sm-1 col-sm-10">
					<canvas id="AkumulasiviewKategori"></canvas>
				</div>
			</div>

			<div class="mt-lg-5">
				<div class="row">
					<div class="offset-sm-1 col-sm-10">
						<canvas id="AkumulasiKategori"></canvas>
					</div>
				</div>
			</div>
		</div>
	<!-- end isi -->

	<script>
		// AKUMULASI BUKU DALAM KATEGORI
		
			var ctx = document.getElementById("AkumulasiKategori");
			
			var persentasejk = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: [<?php
						$dashboard->viewkategoridiagram("SELECT kategori FROM tbl_listkategori");
					?>],
					datasets: [{
							data: [
									<?php
										$dashboard->akumulasiebookDiagram("SELECT COUNT(judul_buku) as jd FROM tbl_book GROUP BY Kategori");
									?>
							],
							
							backgroundColor: [
								'rgba(0, 0, 128, 0.5)',
								'rgba(152, 251, 152, 0.5)'

							],
							borderColor: [
								'rgba(0, 0, 128, 1)',
								'rgba(152, 251, 152, 1)'
							],
							borderWidth: 1,
							
							datalabels:{
								anchor: 'end',
								align: 'top'
							}
						}]
				},
				options: {
					scales: {
						yAxes: [{
								ticks: {
									beginAtZero: true
									
								}
							}]
					},
					legend: {display: false},
					title: {
						display: true,
							text: "AKUMULASI BUKU DALAM KATEGORI"
					},
					
				},
				plugins:[ChartDataLabels],
			});
		// end AKUMULASI BUKU DALAM KATEGORI
        
		// akumulasi view kategori
			
			var ctx = document.getElementById("AkumulasiviewKategori");
			
			var persentasejk = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: [<?php
						$dashboard->viewkategoridiagram("SELECT kategori FROM tbl_listkategori");
					?>],
					datasets: [{
							data: [
									<?php
										$dashboard->akumulasiDiagram("SELECT COUNT(judulEbook) as jd FROM tbl_record_history GROUP BY kategori");
									?>
							],
							backgroundColor: [
								'rgba(0, 0, 128, 0.5)',
								'rgba(152, 251, 152, 0.5)'

							],
							borderColor: [
								'rgba(0, 0, 128, 1)',
								'rgba(152, 251, 152, 1)'
							],
							borderWidth: 1,
							
							datalabels:{
								anchor: 'end',
								align: 'top'
							}
						}]
				},
				options: {
					scales: {
						yAxes: [{
								ticks: {
									beginAtZero: true
									
								}
							}]
					},
					legend: {display: false},
					title: {
						display: true,
							text: "AKUMULASI VIEW PERKATEGORI"
					}
				},
				plugins:[ChartDataLabels],
			});
		// end akumulasi view kategori
	</script>
		
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

