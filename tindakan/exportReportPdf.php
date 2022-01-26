<?php

require_once '../lib/phpFpdf/vendor/setasign/fpdf/fpdf.php';
require_once '../class/koneksi.php';

$pdf = new FPDF();
$pdf->AddPage();

// kop surat
    $pdf->Image('../lib/img/dinaslogo.png',12,5,18,23);
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,5,'PEMERINTAHAN KABUPATEN KARAWANG','0','1','C',false);
    $pdf->Cell(0,5,'DINAS','0','1','C',false);
    $pdf->Cell(0,5,'PERPUSTAKAAN DAN KEARSIPAN','0','1','C',false);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(0,4,'Jalan Ry By Pass No 02 Tanjung Pura Karawang 41316','0','1','C',false);
    $pdf->Cell(0,2,'Email : info@arsip.karawngkab.go.id / Telp/Fax : (0267)41404','0','1','C',false);
    $pdf->Ln(3);
    $pdf->Cell(190,0.6,'','0','1','C',true);
    $pdf->Ln(5);
// end kop surat

// set judul kolom
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,5,'Laporan Data eBook','0','1','C',false);
    $pdf->Ln(3);

    $pdf->SetFont('Arial','B',7);

    $pdf->Cell(6,6,'NO',1,0,'C');
    $pdf->Cell(25,6,'ISBN',1,0,'C');
    $pdf->Cell(65,6,'JUDUL EBOOK',1,0,'C');
    $pdf->Cell(45,6,'PENULIS',1,0,'C');
    $pdf->Cell(15,6,'TAHUN',1,0,'C');
    $pdf->Cell(35,6,'PENERBIT',1,0,'C');
    $pdf->Ln(6);
    $no = 0;
// end set judul kolom

// isi kolom
    $tampildatabook = $con->prepare("SELECT * FROM tbl_book tb, tbl_penerbit tp WHERE tb.id_book = tp.id_penerbit");
    $tampildatabook->execute();
        
    $no = 1;

    while($row = $tampildatabook->fetch(PDO::FETCH_ASSOC))
    {

    $cellWidth=65; //lebar sel
	$cellHeight=4; //tinggi sel satu baris normal
	
	//periksa apakah teksnya melibihi kolom?
	if($pdf->GetStringWidth($row['judul_buku']) < $cellWidth){
		//jika tidak, maka tidak melakukan apa-apa
		$line=1;
	}else{
		//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
		//dengan memisahkan teks agar sesuai dengan lebar sel
		//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
		
		$textLength=strlen($row['judul_buku']);	//total panjang teks
		$errMargin=5;		//margin kesalahan lebar sel, untuk jaga-jaga
		$startChar=0;		//posisi awal karakter untuk setiap baris
		$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
		$textArray=array();	//untuk menampung data untuk setiap baris
		$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)
		
		while($startChar < $textLength){ //perulangan sampai akhir teks
			//perulangan sampai karakter maksimum tercapai
			while( 
			$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
			($startChar+$maxChar) < $textLength ) {
				$maxChar++;
				$tmpString=substr($row['judul_buku'],$startChar,$maxChar);
			}
			//pindahkan ke baris berikutnya
			$startChar=$startChar+$maxChar;
			//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
			array_push($textArray,$tmpString);
			//reset variabel penampung
			$maxChar=0;
			$tmpString='';
			
		}
		//dapatkan jumlah baris
		$line=count($textArray);
	}
	
    //tulis selnya
    $pdf->SetFillColor(255,255,255);
	$pdf->Cell(6,($line * $cellHeight),$no++,1,0,'C',False); //sesuaikan ketinggian dengan jumlah garis
    $pdf->Cell(25,($line * $cellHeight),$row['ISBN'],1,0,'L',False);
	// $pdf->Cell(6,($line * $cellHeight),$row['judul_buku'],1,0); //sesuaikan ketinggian dengan jumlah garis
	
	//memanfaatkan MultiCell sebagai ganti Cell
	//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
	//ingat posisi x dan y sebelum menulis MultiCell
	$xPos=$pdf->GetX();
	$yPos=$pdf->GetY();
	$pdf->MultiCell($cellWidth,$cellHeight,$row['judul_buku'],1,'L',False);
	
	//kembalikan posisi untuk sel berikutnya di samping MultiCell 
    //dan offset x dengan lebar MultiCell
	$pdf->SetXY($xPos + $cellWidth , $yPos);
	
    $pdf->Cell(45,($line * $cellHeight),$row['Penulis'],1,0,'L',False); 
    $pdf->Cell(15,($line * $cellHeight),$row['tahun_terbit'],1,0,'L',False);
    $pdf->Cell(35,($line * $cellHeight),$row['penerbit'],1,1,'L',False);
    }
// end isi kolom

// set ttd
    // atas ttd
        $pdf->Cell(189 ,20,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(130 ,4,'Mengetahui,',0,0);
        $pdf->Cell(59 ,4,'Karawang, '.date("d F Y"),0,1);
    // end atas ttd

    // jabatan yang ttd
        $pdf->Cell(189 ,1,'',0,1);
        $pdf->SetFont('Arial','B',10);
        // ttd kepala dinas
            $pdf->Cell(130 ,4,'Plt.KepalaDinas',0,0);
        // end ttd kepala dinas
        // ttd pustakawan
            $pdf->Cell(59 ,4,'PUSTAKAWAN',0,1);
        // end ttd pustakawan
    // end jabatan yng ttd

    // nama ttd
        $pdf->Cell(189 ,18,'',0,1);
        $pdf->SetFont('Arial','BU',10);

        // ttd kepala dinas
            $pdf->Cell(130 ,4,'Drs.HARYANTO,M.M',0,0);
        // end ttd kepala dinas

        // ttd pustakawan
            $pdf->Cell(59 ,4,'TRI WARAKANTI, S.STP.M.Pd',0,1);
        // end ttd pustakawan
    // end nama ttd

    // nama ttd
        $pdf->Cell(189 ,1,'',0,1);
        $pdf->SetFont('Arial','B',10);

        // ttd kepala dinas
            $pdf->Cell(130 ,4,'NIP. 19610525 198603 1 017',0,0);
        // end ttd kepala dinas

        // ttd pustakawan
            $pdf->Cell(59 ,4,'NIP. 19780514 199803 2 005',0,1);
        // end ttd pustakawan
    // end nama ttd

// end set ttd
$pdf->Output();

?>
