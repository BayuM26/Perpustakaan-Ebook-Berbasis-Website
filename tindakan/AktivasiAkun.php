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
            require_once '../class/koneksi.php';
            require_once '../class/pengunjung.php';
            $token = $_GET['t'];

                $aktif = $con->prepare("SELECT token FROM tbl_pengunjung WHERE token = '$token' AND aktif = '0'");
                $aktif->execute();
                $aktivasi = $aktif->fetchColumn();
                    if($aktivasi == $token){
                        $pengunjung->Aktivasi($token);
                            echo '<div class="alert alert-success">
                                    Akun anda sudah aktif, silahkan <a href="../index.php">Login</a>
                                </div>';
                        
                    }else{
                        echo '<div class="alert alert-warning">
                        Invalid Token!
                        </div>';
                    }
        ?>
	<!-- end isi -->

	<!-- footer -->
	<div class="w3-bar w3-blue w3-card w3-block">
	<p class="w3-center">Copyright &copy; Ahmad Wahyudin & Bayu Maulana 2021 <p>
	</div>  
	<!-- end footer -->
</body>
</html>

