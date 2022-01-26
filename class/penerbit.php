<?php
require_once 'ebook.php';
class Penerbit extends Ebook {
    // input penerbit baru
        public function uploadPenerbit($namapPenerbit,$tahunTerbit,$kotaTerbit)
        {
            try
            {
                $insertPenerbit = $this->db->prepare("INSERT INTO tbl_penerbit (penerbit, tahun_terbit, kota) VALUES (:penerbit, :tahun_terbit, :kota)");
                
                $insertPenerbit->bindParam(':penerbit',$namapPenerbit);
                $insertPenerbit->bindParam(':tahun_terbit',$tahunTerbit);
                $insertPenerbit->bindParam(':kota',$kotaTerbit);
                
                $insertPenerbit->execute();
                return true;
            }

            catch (PDOException $e){
                $e->getMessage();
                return false;
            }
        }
    // end input penerbit baru

    // update penerbit
        public function updatePenerbit($idbook,$namapenerbit,$tahunterbit,$kotaterbit){
            try
            {
                $datapenerbit = [
                    'penerbit'=>$namapenerbit,
                    'tahun_terbit'=>$tahunterbit,
                    'kota'=>$kotaterbit,
                    'id_penerbit'=>$idbook
                ];

                $updatedatpenerbit = $this->db->prepare("UPDATE tbl_penerbit 
                                                        SET penerbit = :penerbit,
                                                            tahun_terbit = :tahun_terbit,
                                                            kota = :kota
                                                        WHERE id_penerbit =:id_penerbit");
                if($updatedatpenerbit->execute($datapenerbit)){
                    echo "<script>window.location.href = '../Admin/data_book.php';</script>";
                    return true;
                }
            }
            
            catch (PDOException $e)
            {
                $e->getMessage();
                return false;
            }
        }
    // end update penerbit

}

$penerbit = new Penerbit($con);