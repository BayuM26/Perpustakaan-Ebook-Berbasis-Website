<!DOCTYPE html>
<html>
<head>
	<title>Tambah Pustakawan</title>
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
				<img src="../lib/img/dinaslogo.png" class="navbar-brand " style="width: 30px; margin-left: 20px;">
				 <h4 class="font">PERPUSTAKAAN ONLINE</h4> 				
		</div>
	</header>
	<!-- akhir atas -->

	<!-- isi -->
<?php

	require_once '../class/pengunjung.php';
	require_once '../class/koneksi.php';
	if(isset($_POST['btn_registrasi'])){
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$tlp = $_POST['tlp'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm_pass = $_POST['confirm_password'];
		
		
			if($nama == '' || $email == '' || $tlp == '' || isset($_POST['jk']) == ''  || 
			isset($_POST['pendidikan']) == '' || isset($_POST['pekerjaan']) == '' ||  
			isset($_POST['tipeIdentitas']) == '' || $username == '' || $password == '' || 
			$confirm_pass == ''){
				
				echo'
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</symbol> 
						</svg> 

						<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div>
								MOHON UNUTK MELENGKAPI DATA TERLEBIH DAHULU!!!!
							</div>

							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
			}
			else{

				if($password != $confirm_pass){
					echo'
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
						</symbol> 
					</svg> 
		
					<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
						<div>
							PASSWORD TIDAK SAMA!!!
						</div>
		
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';

				
				}
				else{
				
					$namaidentitas = $_FILES['fileIdentitas']['name'];
					$sizeidentitas = $_FILES['fileIdentitas']['size'];
					$erroridentitas = $_FILES['fileIdentitas']['error'];
					$fileidentias = $_FILES['fileIdentitas']['tmp_name'];

					if($erroridentitas==4){
						echo'
							<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
								<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
									<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</symbol> 
							</svg> 
	
							<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
								<div>
									FILE IDENTITAS TIDAK BOLEH KOSONG!!!!
								</div>
	
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
					}else{
						
						$typeGambarList = ['jpg', 'png','jpeg'];
						$typeGambar = explode('.', $namaidentitas);
						$gettypeGambar = strtolower(end($typeGambar));

						if(!in_array($gettypeGambar, $typeGambarList)){
							echo'
							<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
								<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
									<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</symbol> 
							</svg> 
		
							<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
								<div>
									GAMBAR HARUS BERTIPE jpg,png,jpeg!!!!
								</div>
		
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
						}
						else{
							if($sizeidentitas > 1024*2000){
								echo'
								<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
									<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
										<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
									</symbol> 
								</svg> 
			
								<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert">
									<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
									<div>
										FIlE HARUS 2 MB KE BAWAH!!!!
									</div>
			
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
							}
							else{
								
								$checkEmail = $con->prepare("SELECT email,username FROM tbl_pengunjung WHERE email = '$email'");
								$checkEmail->execute();

								while($row = $checkEmail->fetch(PDO::FETCH_ASSOC)){
									$cekemail = $row['email'];
								}
								if(isset($cekemail) == $_POST['email']){
									echo'
									<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
										<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
											<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
										</symbol> 
									</svg> 
				
									<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert">
										<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
										<div>
											EMAIL SUDAH TERPAKAI, SILAKAN MENGGUNAKAN EMAIL LAIN!!!!
										</div>
				
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>';
								}
								else{
									$checkUsername = $con->prepare("SELECT username FROM tbl_pengunjung WHERE username = '$username'");
									$checkUsername->execute();

									while($row = $checkUsername->fetch(PDO::FETCH_ASSOC)){
										$cekusername = $row['username'];
									}
									if(isset($cekusername) == $_POST['username']){
										echo'
										<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
											<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
												<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
											</symbol> 
										</svg> 
					
										<div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert">
											<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
											<div>
												USERNAME SUDAH TERPAKAI, SILAKAN MENGGUNAKAN USERNAME LAIN LAIN!!!!
											</div>
					
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>';
									}else{
										$namaidentitasbaru = uniqid();
										$namaidentitasbaru .='.';
										$namaidentitasbaru .= $gettypeGambar;
		
										$jk = $_POST['jk'];
										$pendidikan = $_POST['pendidikan'];
										$pekerjaan = $_POST['pekerjaan'];
										$tipe_Identitas = $_POST['tipeIdentitas'];
										
										if(move_uploaded_file($fileidentias, '../fileUpload/file identitas/'.$namaidentitasbaru)){
		
											$token = hash('sha256', md5(date('Y-m-d H:i:s')));
											$aktif = '0';
	
											include 'KirimEmail.php';
		
											$pengunjung->InsertPengunjung($nama,$email,$tlp,$jk,$pendidikan,$pekerjaan,
																			$namaidentitasbaru,$tipe_Identitas,$username,$password,$token,$aktif);
											
										}
									}
								}
							}
						}
					}
				}
			}
		}
?>
		<div class="w3-container">
		
			<div class="row">
				<div class="offset-sm-2 col-sm-8">
				<a href="../index.php" style="color: black" class="w3-left mt-lg-3 nav-link bi bi-backspace-fill"> Back</a>

					<form action="" method="post" enctype="multipart/form-data">						
						<div class="w3-center mt-sm-5">
							<h2>Registrasi Pengunjung</h2>
						</div>
						
								<div class="input-group mt-sm-4">
									<input type="text" class="form-control" name="nama" autocomplete="off" placeholder="Nama lengkap">
								</div>

								<div class="input-group mt-sm-4">
									<input type="email" class="form-control" name="email" placeholder="Email">
								</div>
								
								<div class="input-group mt-sm-4">
									<input type="number" class="form-control" name="tlp" autocomplete="off" placeholder="nomor HP">
								</div>

                                <select class="form-select mt-sm-4" name="jk">
                                    <option selected disabled>Jenis Kelamin</option>
                                    <option value="L">PRIA</option>
                                    <option value="P">WANITA</option>
                                </select>

								<select class="form-select mt-sm-4" name="pendidikan">
									<option selected disabled>Pendidikan Terakhir</option>
									<option value="SekolahDasar">SD Kebawah</option>
									<option value="SLTP">SLTP (SMP)</option>
									<option value="SLTA">SLTA (SMA/SMK)</option>
									<option value="D1">D1</option>
									<option value="D3">D3</option>
									<option value="D4">D4</option>
									<option value="S1">S1</option>
									<option value="S2">S2</option>
									<option value="S3">S3</option>
                          		</select>

								<select class="form-select mt-sm-4" name="pekerjaan">
									<option selected disabled>Pekerjaan Saat ini</option>
									<option value="PNS">Pegawai Negri Sipil (PNS)</option>
									<option value="TNI">TNI</option>
									<option value="POLRI">POLRI</option>
									<option value="Pegawai Swasta">Pegawai Swasta</option>
									<option value="Wiraswasta">Wiraswasta/Usahawan</option>
									<option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
									<option value="lainnya">Lainnya...</option>
								</select>

								<p  class="form-label mt-sm-3">Upload kartu identitas</p>
								<input type="file" name="fileIdentitas" class="form-control" >

								<select class="form-select mt-sm-4" name="tipeIdentitas">
                                    <option selected disabled>Tipe Kartu Identitas</option>
                                    <option value="ktp">KTP</option>
                                    <option value="kPelajar">Kartu pelajar</option>
									<option value="lainnya">Lainnya...</option>
                                </select>

								<div class="input-group mt-sm-4">
									<input type="text" class="form-control" name="username"  autocomplete="off" placeholder="Username">
								</div>
						
								<div class="row ">
									<div class="col-lg-6">

										<div class="input-group-password mt-sm-4">
											<input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password">
										</div>
									
									</div>

									<div class="col-lg-6" >

										<div class="input-group-password mt-sm-4">
											<input type="password" class="form-control" name="confirm_password" autocomplete="off" placeholder="Tulis ulang password">
										</div>

									</div>	

								</div>

						<div class="mt-sm-4">
							<button type="submit" name="btn_registrasi" class="mb-sm-5 btn btn-success bi bi-person-plus-fill w3-right">  Resgistrasi</button>
						</div>
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
</body>
</html>

