<?php
require_once 'koneksi.php';
class login extends koneksi {

    // validasi username dan password 
        public function validasipustakawan($username,$password){

            $login = $this->db->prepare("SELECT * FROM tbl_pustakawan WHERE username = '$username' and password='$password'");
            $login->execute();
    
                session_start();
                
                while($row = $login->fetch(PDO::FETCH_ASSOC)){
                    $nama = $row['nama'];
                    
                    if($login->rowCount() == 1){
                        $_SESSION['username'] = $nama;
                        $_SESSION['status'] = "login";
                        $_SESSION['hak_akses'] = 'pustakawan';
                        
                        header("Location:Admin/dashborad_admin.php");
                    }
                }         
            }
    // end validasi username dan password

    // validasi username dan password 
        public function validasiPengunjung($username,$password){

            $login = $this->db->prepare("SELECT * FROM tbl_pengunjung WHERE username = '$username' and password='$password' AND aktif = '1'");
            $login->execute();

                session_start();
                
                while($row = $login->fetch(PDO::FETCH_ASSOC)){
                    $nama = $row['nama'];
                    $id = $row['id_pengunjung'];

                    if($login->rowCount() == 1){
                        $_SESSION['idPengunjung'] = $id;
                        $_SESSION['username'] = $nama;
                        $_SESSION['status'] = "login";
                        $_SESSION['hak_akses'] = 'pengunjung';
                        
                        header("Location:dashboard.php");
                    }
                }         
        }
    // end validasi username dan password
}

$login = new login($con);