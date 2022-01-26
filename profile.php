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

    <!-- notif update -->
        <?php
            if(isset($_GET['update'])=='update'){
                echo'
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>
            
                <div class="alert alert-success d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" style=">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        PROFIL ANDA BERHASIL TERUPDATE <i class="bi bi-emoji-smile"></i>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        ?>
    <!-- end notif update -->

    <!-- isi -->
		<div class="w3-container">  
        <a href="EditProfile.php" class="btn btn-secondary bi bi-gear w3-right mt-lg-2" type="button"> Edit Profile</a> 
            <?php
                if(isset($row['foto_profile'])==''){
            ?>
                    <div class="w3-center">
                        <div class="w3-row-padding w3-margin-top ">
                            <div class="">
                                <label class="pointer">
                                    <img src="lib/img/image_profile_default.jpg" class="w3-circle" style="width:100%; max-width:100px">
                                </label>
                                <div class="w3-container">
                                    <h5><?php echo "{$_SESSION['username']}" ?></h5>
                                    <h5><?php echo "{$row['email']}" ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                    }
                    else{
            ?>
                    <div class="w3-center">
                        <div class="w3-row-padding w3-margin-top">
                            <div class="">
                                <label class="pointer">
                                    <img src="fileUpload/foto profile/<?php echo "{$row['foto_profile']}" ?>" class="w3-circle" style="width:100%; max-width:100px">
                                </label>
                                <div class="w3-container">
                                    <h5><?php echo "{$_SESSION['username']}" ?></h5>
                                    <h5><?php echo "{$row['email']}" ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                    }
                }
            ?>

            <div class="w3-display-container w3-hover-opacity w3-center m-lg-5 mt-lg-2 mb-lg-4" style=" width:100%; max-width:300px">
                <img src="lib/img/historty.png" style="width:75% ">
                <div class="w3-display-middle w3-display-hover w3-animate-opacity">
                    <a href="HIstoryMembaca.php" class="w3-button w3-black">History Membaca</a>
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

