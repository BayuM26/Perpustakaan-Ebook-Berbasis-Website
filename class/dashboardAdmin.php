<?php
require_once 'koneksi.php';
class DashboardAdmin extends koneksi {
    // view kategori diagram
        public function viewkategoridiagram($query){
            $view = $this->db->prepare($query);
            $view->execute();

            while($row = $view->fetch(PDO::FETCH_ASSOC)){
                $kategori = $row['kategori'];
                echo "'$kategori',";
            }
        }
    // end view kategori diagram

    // view akumulasi view kategori
        public function akumulasiDiagram($query){
            $akumulasiviewkategori = $this->db->prepare($query);
            $akumulasiviewkategori->execute();

            while($row = $akumulasiviewkategori->fetch(PDO::FETCH_ASSOC)){
                $akumulasi = $row['jd'];
                echo "'$akumulasi',";
            }
        }
    // end view akumulasi view kategori

    // view akumulasi view kategori
        public function akumulasiebookDiagram($query){
            $akumulasiebookkategori = $this->db->prepare($query);
            $akumulasiebookkategori->execute();

            while($row = $akumulasiebookkategori->fetch(PDO::FETCH_ASSOC)){
                $akumulasi = $row['jd'];
                echo "'$akumulasi',";
            }
        }
    // end view akumulasi view kategori
}

$dashboard = new DashboardAdmin($con);