<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../lib/phpmailer/vendor/autoload.php';

$mail = new PHPMailer(true);                         

    //Server settings
    $mail->SMTPDebug = 0;                                 
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                              
    $mail->Username = 'SIPO2021AB@gmail.com';                 
    $mail->Password = 'perpus2021';                           
    $mail->SMTPSecure = 'ssl';                           
    $mail->Port = 465;                                    

    //Recipients
    $mail->setFrom('SIPO2021AB@gmail.com', 'SISTEM INFORMASI PERPUSTAKAAN ONLINE');
    $mail->addAddress($_POST['email'], $_POST['nama']);     

    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = 'VERIFIKASI EMAIL, PENGUNJUNG PERPUSTAKAAN ONLINE';
    $mail->Body    = "Selamat email anda sudah terferivikasi, 
    silakan klik link ini untuk menaktifkan akun anda <a href='http://localhost/magang/tindakan/AktivasiAkun.php?t=".$token."'>http://localhost/magang/tindakan/AktivasiAkun.php?t=".$token."</a>";

    if($mail->send()){
        echo'<div class="alert alert-success">
                VERIVIKASI EMAIL SUDAH TERKIRIM <i class="bi bi-envelope-check"></i>, SILAKAN CHECK <a href="https://mail.google.com/mail/u/0/#inbox">EMAIL</a> ANDA
            </div>';
            }  
    else{
        echo 'EMAIL TIDAK TERKIRIM, SILAKAN REFRESH PAGE';
    }
