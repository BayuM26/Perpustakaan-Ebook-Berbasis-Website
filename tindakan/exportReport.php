<?php

session_start();

require_once '../lib/phpspreadsheet/vendor/autoload.php';
require_once '../class/koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment; 
use PhpOffice\PhpSpreadsheet\Style\Border;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// setting style
    // style untuk judul kolom
        $styleJudulKolom = [
            'font'=>[
                'color'=>[
                    'rgb'=>'000000'
                ],
                'bold'=>true,
                'size'=>12
            ],

            'alignment'=>[
                'horizontal'=>Alignment::HORIZONTAL_CENTER,    
            ],

            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
    // end style untuk judul kolom

    // style untuk isi kolom
        $styleIsiKolom = [
            'font' => [
                'size' =>10,
            ],

            'alignment'=>[
                'horizontal'=>Alignment::HORIZONTAL_LEFT,    
            ],
            
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        
        ];
    // end style untuk isi kolom

    // style title
        $title = [
            'font' => [
                'size' =>14,
                'bold'=>true,
            ],
        
            'alignment'=>[
                'horizontal'=>Alignment::HORIZONTAL_CENTER,    
            ],
        ];

        $maintitle = [
            'font' => [
                'size' =>16,
                'bold'=>true,
            ],
        
            'alignment'=>[
                'horizontal'=>Alignment::HORIZONTAL_CENTER,    
            ],
        ];
    // end style title
// end setting style

// title
    // main title
        $sheet ->setCellValue('B2',"LAPORAN DATA EBOOK PERPUSTKAAN ONLINE");

        // style title ebook
            $sheet->mergeCells('B2:O2');
            $sheet->getStyle('B2')->applyFromArray($maintitle);
        // end style title ebook
    // end main title

    // title ebook
        $sheet ->setCellValue('B6',"DATA EBOOK");

        // style title ebook
            $sheet->mergeCells('B6:J6');
            $sheet->getStyle('B6')->applyFromArray($title);
        // end style title ebook
    // end title ebook

    // title kategori
        $sheet ->setCellValue('M6',"DATA KATEGORI");

        // style title ebook
            $sheet->mergeCells('M6:O6');
            $sheet->getStyle('M6')->applyFromArray($title);
        // end style title ebook
    // end title kategori
// end title

// judul kolom
    // judul kolom Ebook
        $sheet  ->setCellValue("B8","No.")
                ->setCellValue("C8","Jumlah view")
                ->setCellValue("D8","Jumlah vote")
                ->setCellValue("E8","ISBN")
                ->setCellValue("F8","Judul eBook")
                ->setCellValue("G8","Kategori")
                ->setCellValue("H8","Penulis")
                ->setCellValue("I8","Penerbit")
                ->setCellValue("J8","Tahun terbit");
    // end judul kolom Ebook

    // judul kolom kategori
        $sheet  ->setCellValue("M8","No.")
                ->setCellValue("N8","Kategori")
                ->setCellValue("O8","Jumlah View");
    // end judul kolom kategori

    // memanggil style unutk judul kolom
        $spreadsheet->getActiveSheet()
                    ->getStyle('B8:J8')
                    ->applyFromArray($styleJudulKolom);

        $spreadsheet->getActiveSheet()
                    ->getStyle('M8:O8')
                    ->applyFromArray($styleJudulKolom);
    //end memanggil style unutk judul kolom

    // auto size dimension
        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('I')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('J')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('M')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('N')
                    ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
                    ->getColumnDimension('O')
                    ->setAutoSize(true);
    // end auto size dimension
// end judul kolom

// isi kolom
    // isi kolom data ebook
        $tampildatabook = $con->prepare("SELECT * FROM tbl_book tb, tbl_penerbit tp WHERE tb.id_book = tp.id_penerbit");
        $tampildatabook->execute();
            
        $angka = 9;
        $no = 1;

        while($row = $tampildatabook->fetch(PDO::FETCH_ASSOC))
        {
            $view = $con->query("SELECT COUNT(judulEbook) FROM tbl_record_history WHERE id_ebook = {$row['id_book']}")->fetchColumn();
            $akumulasiVote = $con->query("SELECT COUNT(vote) FROM tbl_vote WHERE vote = 1 AND id_ebook = {$row['id_book']} ORDER BY vote")->fetchColumn();  
            $sheet  ->setCellValue("B".$angka,$no)
                    ->setCellValue("C".$angka,$view)
                    ->setCellValue("D".$angka,$akumulasiVote)
                    ->setCellValue("E".$angka,$row['ISBN'])
                    ->setCellValue("F".$angka,$row['judul_buku'])
                    ->setCellValue("G".$angka,$row['Kategori'])
                    ->setCellValue("H".$angka,$row['Penulis'])
                    ->setCellValue("I".$angka,$row['penerbit'])
                    ->setCellValue("J".$angka,$row['tahun_terbit']);       
                $angka++;
                $no++;
        }

        $angka = $angka - 1;
        // style unutk isi kolom Ebook
            $spreadsheet->getActiveSheet()
                        ->getStyle('B9:J'.$angka)
                        ->applyFromArray($styleIsiKolom);
        //end style unutk isi kolom Ebook
    // end isi kolom data ebook

    // isi kolom kategori
        $tampilkategoribaru = $con->prepare("SELECT * FROM tbl_listkategori ORDER BY id_kategori ASC");
        $tampilkategoribaru->execute();

        $angka = 9;
        $no = 1;
        while($row = $tampilkategoribaru->fetch(PDO::FETCH_ASSOC))          
        {
            $jumlahviewKategori = $con->query("SELECT COUNT(judulEbook) FROM tbl_record_history WHERE kategori = '{$row['kategori']}' ORDER BY kategori")->fetchColumn();
            $sheet  ->setCellValue("M".$angka,$no)
                    ->setCellValue("N".$angka,$row['kategori'])
                    ->setCellValue("O".$angka,$jumlahviewKategori);
            $angka++;
            $no++;
        } 

        $angka = $angka - 1;
        // memanggil style unutk isi kolom
            $spreadsheet->getActiveSheet()
                        ->getStyle('M9:O'.$angka)
                        ->applyFromArray($styleIsiKolom);
        //end memanggil style unutk isi kolom
    // end isi kolom kategori
// end isi kolom


// SIMPAN FILE
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment;filename=\"REPORT PEPUSTAKAAN ONLINE.xlsx\"");
// END SIMPAN FILE

$writer = IOFactory::createWriter($spreadsheet, "Xlsx");
$writer->save('php://output');



 