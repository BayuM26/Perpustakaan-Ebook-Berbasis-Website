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
	<title>Tambah Pustakawan</title>
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
    <script src="lib/JS/delete.js"></script>
	<link rel="stylesheet" href="lib/CSS/info.css">
	<link rel="stylesheet" href="lib/CSS/main.css">
	<link rel="stylesheet" href="lib/CSS/loader.css">
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
				<img src="lib/img/Loader.gif" width="200">
				<p>MEMUAT....</p>
			</div>
		</div>
    <!-- end loading screen -->
    

	<!-- atas -->
	<div class="navbar navbar-expand-md w3-blue ">
			<div class="png ms-lg-3">
				<img src="lib/img/dinaslogo.png" style="width: 30px;">
			</div>
			<a href="dashboard.php" class="nav-link" style='color:black;'><span ></span> PERPUSTAKAAN ONLINE</a>	
		
			
			<div class="w3-container w3-display-right">
				<div class="collapse navbar-collapse navbar-nav item ">
					<a href="dashboard.php" class="nav-link font"><i class="fa fa-home"></i> HOME</a>
					<a href="ebooklist.php" class="nav-link bi bi-journal-richtext font"> Daftar Buku</a>
					<a href="#" onclick="document.getElementById('id01').style.display='block'" class="nav-link bi bi-info-circle font"> Tentang Perpustakaan</a>
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
                            ?>
							<a onclick='return confirm("Apa anda yakin ingin Logout ? ");' href="tindakan/logout.php" class="w3-bar-item w3-button bi bi-box-arrow-right"> Logout</a>
						</div>
					</div>
					
				</div>
			</div>
					
		</div>
	<!-- akhir atas -->
    <?php

    require_once 'class/profile.php';

    if(isset($_POST['btn_update_profile'])){
        $nama = $_POST['nama'];
		$email = $_POST['email'];
		$tlp = $_POST['tlp'];
		$username = $_POST['username'];
		$password = $_POST['password'];
  
        $namaprofile = $_FILES['fotoProfile']['name'];
        $sizeprofile = $_FILES['fotoProfile']['size'];
        $errorprofile = $_FILES['fotoProfile']['error'];
        $fileprofile = $_FILES['fotoProfile']['tmp_name'];
        
        $typeGambarList = ['jpg', 'png','jpeg'];
        $typeGambar = explode('.', $namaprofile);
        $gettypeGambar = strtolower(end($typeGambar));
        var_dump($_POST);

        if($errorprofile == 4){
            echo "<script>window.location.href = 'profile.php?update=update';</script>";
            if($pengunjung->Updatepengunjung($_SESSION['idPengunjung'],$nama,$email,$tlp,$username,$password)){
            }
        }else{
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
                if($sizeprofile > 1024*2000){
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
                    $namafotoprofilebaru = uniqid();
                    $namafotoprofilebaru .='.';
                    $namafotoprofilebaru .= $gettypeGambar;
                    $id=$_SESSION['idPengunjung'];
    
                        move_uploaded_file($fileprofile, 'fileUpload/foto profile/'.$namafotoprofilebaru);
                        if($profile->UpdateProfilepengunjung($id,$namafotoprofilebaru,$nama,$email,$tlp,$username,$password)){
                        unlink('fileUpload/foto profile/'.$row['foto_profile']);                                
                    }
                    
                }
            }
        }

    }
  

?>
    <!-- isi -->
		<div class="w3-container">
			
			
					<form action="" method="post" enctype="multipart/form-data">
                        
                    <input type="file" id="fileElem" multiple accept="image/*" name="fotoProfile" class="visually-hidden">	
					    <?php
                            if(isset($row['foto_profile'])==''){
                        ?>
                                    <div class="w3-row-padding w3-margin-top ">
                                        <div class="">
                                            <label for="fileElem" >
                                                <img src="lib/img/image_profile_default.jpg" for="fileElem" class="w3-circle" style="width:100%; max-width:100px; cursor: pointer;">
                                            </label>
                                        </div>
                                    </div>
                        <?php
                                }
                                else{
                        ?>
                                    <div class="w3-row-padding w3-margin-top">
                                        <div class="">
                                            <label for="fileElem">
                                                <img src="fileUpload/foto profile/<?php echo "{$row['foto_profile']}" ?>" for="fileElem" class="w3-circle" style="width:100%; max-width:100px; cursor: pointer;">
                                            </label>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                            <div class="mt-sm-4 ">
									<label class="form-label" for="nama">Nama:</label>
									<input type="text" id="nama" class="form-control" name="nama" value="<?php echo $row['nama'] ?>" autocomplete="off" placeholder="Nama lengkap">
								</div>

								<div class="mt-sm-4">
									<label class="form-label" for="email">email:</label>
									<input type="email" id="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" autocomplete="off" placeholder="Email">
								</div>
								
								<div class="mt-sm-4">
									<label class="form-label" for="tlp">No Teplepon:</label>
									<input type="number" id="tlp" class="form-control" name="tlp" value="<?php echo $row['telepon'] ?>" autocomplete="off" placeholder="nomor HP">
								</div>

								<div class="mt-sm-4">
									<label class="form-label" for="usernmae">Username:</label>
									<input type="text" id="usernmae" class="form-control" name="username" value="<?php echo $row['username'] ?>"  autocomplete="off" placeholder="Username">
								</div>
			
								<div class="input-group-password mt-sm-4">
									<label class="form-label" for="ps">password:</label>
									<input type="text" id="ps" class="form-control" name="password" value="<?php echo $row['password'] ?>" autocomplete="off" placeholder="Password">
								</div>
                        <?php
                            }
                        ?>
                        
						<div class="mt-sm-4">
							<button type="submit" name="btn_update_profile" class="btn btn-success bi bi-arrow-repeat mb-sm-3">  Update Profile</button>
						</div>
					</form>
                        <button id="<?php echo $_SESSION['idPengunjung']?>" class='btn_deleteAkunPengunjung btn btn-danger bi bi-trash-fill mb-sm-5'>HAPUS AKUN</button>
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

