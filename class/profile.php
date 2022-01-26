<?php
require_once 'pengunjung.php';
class profile extends Pengunjung {
    // updateprofile
        public function UpdateProfilepengunjung($id,$fotoProfile,$nama,$email,$tlp,$username,$password){
            try
            {
                $data = [
                    'foto_profile' => $fotoProfile,
                    'nama'=>$nama,
                    'email'=>$email,
                    'telepon'=>$tlp,
                    'username'=>$username,
                    'password'=>$password,
                    'id_pengunjung' => $id
                ];

                $updatedatapengunjung = $this->db->prepare("UPDATE tbl_pengunjung 
                                                            SET foto_profile = :foto_profile,
                                                                nama = :nama,
                                                                email = :email,
                                                                telepon = :telepon,
                                                                username = :username,
                                                                password = :password
                                                            WHERE id_pengunjung = :id_pengunjung");
                $updatedatapengunjung->execute($data);
                echo "<script>window.location.href = 'profile.php?update=update';</script>";
                return true;
            
            }
            
            catch (PDOException $e)
            {
                $e->getMessage();
                return false;
            }
        }
    // end updateprofile

    // record histori reading
        public function record($idbook,$idPengunjung,$time,$judulEbook,$kategori,$namaEbook,$nameCover){
            try
            {
                $recordhistory = $this->db->prepare("INSERT INTO tbl_record_history (id_pengunjung, id_ebook, waktu, judulEbook, kategori, nama_ebook, name_cover) 
                VALUES (:id_pengunjung, :id_ebook, :waktu, :judulEbook, :kategori, :nama_ebook, :name_cover)");
                
                $recordhistory->bindParam(':id_pengunjung',$idPengunjung);
                $recordhistory->bindParam(':id_ebook',$idbook);
                $recordhistory->bindParam(':waktu',$time);
                $recordhistory->bindParam(':judulEbook',$judulEbook);
                $recordhistory->bindParam(':kategori', $kategori);
                $recordhistory->bindParam(':nama_ebook',$namaEbook);
                $recordhistory->bindParam(':name_cover',$nameCover);
                        
                if($recordhistory->execute()){
                    echo "<script>window.location.href = 'tampilpdf.php?namaEbook={$namaEbook}';</script>";
                    return true;
                }else{
                    return false;
                }
            }

            catch (PDOException $e){
                $e->getMessage();
                return false;
            }

            

        }
    // end record histori reading

    // view history
        public function viewhistorymembaca($query){
            try{

                $tampihistory = $this->db->prepare($query);
                $tampihistory->execute();

                while($row = $tampihistory->fetch(PDO::FETCH_ASSOC))          
                    {
                        ?>        
                            <div class="w3-third w3-section w3-center" style="float:left; min-height: 400px;">
                                <div class="">
                                    <a href="tampilanebook.php?idbook=<?php echo "{$row['id_ebook']}";?>" style='text-decoration:none'>
                                        <img src="fileUpload/cover ebook/<?php echo "{$row['name_cover']}"; ?>"  style="min-height: 300px; width:150px">
                                                
                                        <div class="w3-container w3-white">
                                            <p><?php echo "{$row['judulEbook']}"; ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>                                
                        <?php             
                    } 
                return true;     
            }

            catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }
    // end view history
 
    // penghapusan data pengunjung
        public function deleteakunPengunjung($idakunpengunjung){
                
            $delete = $this->db->prepare("DELETE tp.*, trh.* FROM tbl_pengunjung tp, tbl_record_history trh Where tp.id_pengunjung = trh.id_pengunjung AND tp.id_pengunjung = ".$idakunpengunjung);
            $delete->execute();
        }
    // end penghapusan data pengunjung
}

$profile = new Profile($con);

// delete
    if(isset($_POST['DeleteAkun'])){
        $DeleteAkun = $_POST['DeleteAkun'];
        $profile->deleteakunPengunjung($DeleteAkun);
    }
// end delete