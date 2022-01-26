 <?php
        require_once 'class/login.php';

        if(isset($_POST['login']) ) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if($username=='' || $password==''){
                echo'
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol> 
                </svg> 

                <div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" >
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    Username dan Password tidak boleh kosong!!!
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'; 
            }

            else{
                
                if(isset($_POST['hak_akses'])==''){
                    echo'
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol> 
                    </svg> 
    
                    <div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" >
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        Tolong untuk memilih Hak Akses sebelum login!!!
                    </div>
    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'; 
                }else{

                    if($_POST['hak_akses']=='pustakawan'){
                        if($login->validasipustakawan($username,$password)){

                        }else{
                            echo'
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol> 
                            </svg> 
    
                            <div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" >
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                USERNAME ATAU PASSWORD YANG ANDA MASUKAN SALAH!!!
                            </div>
    
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>'; 
                        }
                    }

                    else if($_POST['hak_akses']=='pengunjung'){
                        if($login->validasiPengunjung($username,$password)){

                        }else{
                            echo'
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol> 
                            </svg> 
    
                            <div class="alert alert-warning d-flex alert-dismissible align-items-center w3-animate-opacity" role="alert" >
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                USERNAME ATAU PASSWORD YANG ANDA MASUKAN SALAH!!!
                            </div>
    
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>'; 
                        }
                    }  
                }
            }
        }

    ?>


<html>
    <head>
        <title>login</title>
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
        <script src="lib/JS/showPassword.js"></script>
        <link rel="stylesheet" href="lib/CSS/loader.css">
        <link rel="stylesheet" href="lib/CSS/login.css">
    </head>
    <body >


    
	<!-- loading screen -->
		<div class="preloader">
			<div class="loading">
				<img src="lib/img/Loader.gif" width="200">
				<p>MEMUAT....</p>
			</div>
		</div>
    <!-- end loading screen -->

      <form action="" method="post">
        <div class="login">

            <div class="avatar">
                <i class="bi bi-person-fill"></i>
            </div>

            <h2>LOGIN</h2>

            <select class="form-select mb-sm-3 bg-transparent text-white" name="hak_akses">
                <option selected disabled class="text-dark">HAK AKSES</option>
                <option value="pustakawan" class="text-dark">PUSTAKAWAN</option>
                <option value="pengunjung" class="text-dark">PENGUNJUNG</option>
            </select>

            <div class="box-login">
                <i class="bi bi-person-fill"></i>
                <input type="text" name="username" placeholder="Username" autofocus>
            </div>

            <div class="box-login">
                <i class="bi bi-lock-fill"></i>
                <input type="password" name="password" placeholder="Password" id="ShowPassword">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="showpassword" onclick="Show()">
                <label class="form-check-label text-white mb-lg-3" for="showpassword">
                    Show Password
                </label>
            </div>

            <button type="submit" name="login" class="btn-login"> 
                login
            </button>

            <a href="tindakan/Register.php" style="color: white;" class="w3-right mt-lg-3 nav-link">Resgitrasi</a>


        </div>
        </form>
    </body>
</html>