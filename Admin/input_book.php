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
	<title>Tambah Buku</title>
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
			<div class="navbar navbar-expand-lg w3-blue w3-card ">
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
		<div class="w3-sidebar w3-bar-block w3-blue sidebar w3-card mt-sm-auto">
			<a href="dashborad_admin.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
			
			<button class="w3-button w3-block w3-left-align w3-light-grey" onclick="bookFunc()"><i class="bi bi-book"></i> BUKU <i class="fa fa-caret-down"></i></button>
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

		require_once "../class/ebook.php";
		require_once "../class/penerbit.php";
				
			if(isset($_POST['btn_simpan_ebook'])){
				
				// variable input buku
					$judul_buku = $_POST['judulBuku'];
					$penulis = $_POST['penulisBuku'];
					$isbn = $_POST['isbn'];
					$sinopsis = $_POST['sinopsis'];
				// end variable input buku

				// varibel input penerbit	
					$namapenerbit = $_POST['nama_penerbit'];
					$tahunterbit = $_POST['tahun_terbit'];
					$kotaterbit = $_POST['kota'];
				// end variable input penerbit
			
			// validasi

				if($judul_buku == ''|| $penulis == ''|| $isbn == ''||$sinopsis == ''|| isset($_POST['kategori'])=='' || $namapenerbit == ''|| $tahunterbit == ''|| $kotaterbit == ''){
					echo'
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</symbol> 
						</svg> 

						<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div>
								MOHON UNUTK MELENGKAPKAN DATA TERLEBIH DAHULU!!!!
							</div>

							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
				}

				// varible img cover
				$namaImg=$_FILES['imgCover']['name'];
				$sizeImg=$_FILES['imgCover']['size'];
				$errorImg=$_FILES['imgCover']['error'];
				$tmpImage=$_FILES['imgCover']['tmp_name'];

				// variable file pdf
				$namapdf=$_FILES['fileEbook']['name'];
				$sizepdf=$_FILES['fileEbook']['size'];
				$errorpdf=$_FILES['fileEbook']['error'];
				$tmppdf=$_FILES['fileEbook']['tmp_name'];

				if($errorImg==4){
					echo'
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</symbol> 
						</svg> 

						<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div>
								GAMBAR COVER TIDAK BOLEH KOSONG!!!!
							</div>

							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
				}

				else if($errorpdf==4){
					echo'
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</symbol> 
						</svg> 

						<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div>
								FILE EBOOK TIDAK BOLEH KOSONG!!!!
							</div>

							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
				}

				else{

					// menentukan type file cover image 
					$typeGambarList = ['jpg', 'png','jpeg'];
					$typeGambar = explode('.', $namaImg);
					$gettypeGambar = strtolower(end($typeGambar));

					// meentukan type file ebook 
					$typeEbook = ['pdf'];
					$typeEbookFile = explode('.', $namapdf);
					$gettypeEbook = strtolower(end($typeEbookFile));
	
					if(!in_array($gettypeGambar, $typeGambarList)){
						echo'
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</symbol> 
						</svg> 
	
						<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div>
								GAMBAR HARUS BERTIPE jpg,png,jpeg!!!!
							</div>
	
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
					}

					else if(!in_array($gettypeEbook, $typeEbook)){
						echo'
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</symbol> 
						</svg> 
	
						<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div>
								FILE EBOOK HARUS BERTIPE PDF!!!!
							</div>
	
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
					}

					else{
						if($sizeImg > 1024*2000){
							echo'
							<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
								<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
									<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</symbol> 
							</svg> 
		
							<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
								<div>
									GAMBAR HARUS 2 MB KE BAWAH!!!!
								</div>
		
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
						}

						else if($sizepdf > 1024*100000){
							echo'
							<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
								<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
									<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</symbol> 
							</svg> 
		
							<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
								<div>
									FILE EBOOK HARUS 100 MB KE BAWAH!!!!
								</div>
		
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
						}

						else{
							
							$kategori = $_POST['kategori'];

								$namaimgbaru = uniqid();
								$namaimgbaru .='.';
								$namaimgbaru .= $gettypeGambar;
	
								$namapdfbaru = uniqid();
								$namapdfbaru .='.';
								$namapdfbaru .= $gettypeEbook;
	
									move_uploaded_file($tmpImage,'../fileUpload/cover ebook/'.$namaimgbaru);
									move_uploaded_file($tmppdf,'../fileUpload/file ebook/'.$namapdfbaru);	

								if($ebook->uploadebook($judul_buku,$namapdfbaru,$penulis,$kategori,$namaimgbaru,$isbn, $sinopsis)){
									$penerbit->uploadPenerbit($namapenerbit,$tahunterbit,$kotaterbit);
									
									echo'
									<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
										<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
											<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
										</symbol>
									</svg>
									
									<div class="alert alert-success d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
										<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
										<div>
											EBOOK BERHASIL DI SIMPAN <i class="bi bi-emoji-smile"></i>
										</div>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>';
						
							}		

						}
					}
	
				}
				// end validasi	
			}

			else if(isset($_POST['btn_tambahkategori'])){
				$kategoribaru = $_POST['kategoriBaru'];

				if($kategoribaru == ''){
					echo'
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
							</symbol>
						</svg>
						
						<div class="alert alert-success d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
							<div>
								LENGKAPI DATA TERLEBIH DAHULU <i class="bi bi-emoji-smile"></i>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
				}

				else{
					$ebook->insertkategoribaru($kategoribaru);
					echo'
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
							</symbol>
						</svg>
						
						<div class="alert alert-success d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style="margin-left: 155px;">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
							<div>
								KATEGORI BERHASIL DI SIMPAN <i class="bi bi-emoji-smile"></i>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
				}
			}
	?>

		<div class="w3-container mt-sm-5 mb-sm-5" style="margin-left: 170px; min-height: 50em;">
			<div class="row">
				<div class="offset-sm-2 col-sm-8">
					
					<h2 class="">Data Buku</h2>
					<form action="" method="post" enctype="multipart/form-data">
						<!-- form buku -->
							<p  class="form-label">Judul Buku </p>
							<input type="text" name="judulBuku" id="" class="form-control" placeholder="Judul Buku">

							<p  class="form-label">Penulis </p>
							<input type="text" name="penulisBuku" id="" class="form-control" placeholder="Penulis">

							<p  class="form-label">ISBN  </p>
							<input type="text" name="isbn" id="" class="form-control" placeholder="ISBN">

							<p  class="form-label">Sinopsis </p>
							<textarea type="text-area" name="sinopsis" id="" class="form-control" maxlength="1000" rows="10" placeholder="SINOPSIS"></textarea>
							
							<p  class="form-label">Kategori Buku </p>
							<div class="input-group">
								<select class="form-select" name="kategori" id="inputGroupSelect04" aria-label="Example select with button addon">
									<option selected disabled>Kategori....</option>
									<?php
										$ebook->viewlistKategoribaru("SELECT * FROM tbl_listkategori ORDER BY id_kategori ASC");
									?>
								</select>
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKategori">
									<i class="bi bi-plus-lg"></i>
								</button>
							</div>

							<!-- Modal kategori -->
								<div class="modal fade" id="modalKategori" tabindex="-1" aria-labelledby="modaltambahkategori" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="modaltambahkategori">TAMBAH KATEGORI</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>

											<div class="modal-body">
												<p  class="form-label">Kategori</p>
												<input type="text" name="kategoriBaru" class="form-control" placeholder="Tambah kategori">
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal <i class=" bi bi-x"></i> </button>
												<button type="sumbit" name="btn_tambahkategori" class="btn btn-primary">Tambah <i class="bi bi-plus"></i> </button>
											</div>
										</div>
									</div>
								</div>
							<!-- end modal kategori -->

							<div class="row ">
								<div class="col-lg-6">
	
							<p  class="form-label">Cover Buku</p>
							<input type="file" name="imgCover" id="" class="form-control" >
							
							</div>
								<div class="col-lg-6">
	
							<p  class="form-label">Ebook File</p>
							<input type="file" name="fileEbook" id="" class="form-control" >
						
						</div>
					</div>
				<!-- end form buku -->

						<!-- form penerbit -->
							<h2 class="mt-sm-5">Data Penerbit</h2>

							<p  class="form-label">Nama Penerbit</p>
							<input type="text" name="nama_penerbit" id="" class="form-control" placeholder="Nama Penerbit">

							<p  class="form-label">Tahun Terbit</p>
							<input type="text" name="tahun_terbit" id="" class="form-control" placeholder="Tahun Terbit">

							<p  class="form-label">Kota</p>
							<input type="text" name="kota" id="" class="form-control" placeholder="Kota">
						<!-- end form penerbit -->

						<button type="submit" name="btn_simpan_ebook" class="btn btn-success mt-sm-4 w3-right bi bi-journal-plus"> SELESAI</button>

					</form>

				</div>
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

