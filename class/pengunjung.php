<?php
require_once 'koneksi.php';
class Pengunjung extends koneksi {
        
    // input data pengunjung
        public function InsertPengunjung($nama,$email,$tlp,$jk,$pendidikan,$pekerjaan,
        $namaidentitasbaru,$tipe_Identitas,$username,$password,$token,$aktif){
            try
                {
                    $insertpengunjung = $this->db->prepare("INSERT INTO tbl_pengunjung (nama,email,telepon,jk,p_terakhir,pekerjaan,ktp,tipe_kartu_identitas,username,password,token,aktif) 
                    VALUES (:nama,:email,:telepon,:jk,:p_terakhir,:pekerjaan,:ktp,:tipe_kartu_identitas,:username,:password,:token,:aktif)");
                    
                    $insertpengunjung->bindParam(":nama",$nama);
                    $insertpengunjung->bindParam(":email",$email);
                    $insertpengunjung->bindParam(":telepon",$tlp);
                    $insertpengunjung->bindParam(":jk",$jk);
                    $insertpengunjung->bindParam(":p_terakhir",$pendidikan);
                    $insertpengunjung->bindParam(":pekerjaan",$pekerjaan);
                    $insertpengunjung->bindParam(":ktp",$namaidentitasbaru);
                    $insertpengunjung->bindParam(":tipe_kartu_identitas",$tipe_Identitas);
                    $insertpengunjung->bindParam(":username",$username);
                    $insertpengunjung->bindParam(":password",$password);
                    $insertpengunjung->bindParam(":token",$token);
                    $insertpengunjung->bindParam(":aktif",$aktif);

                    $insertpengunjung->execute();
                    return true;
                }

            catch (PDOException $e)
                {
                    $e->getMessage();
                    return false;
                }

        }
    // end input data pengunjung

    // tampil data pengunjung
        public function Viewpengunjung($query){
            try{
                $view = $this->db->prepare($query);
                $view->execute();
    
                    while ($row = $view->fetch(PDO::FETCH_ASSOC)){
                        ?>   
                            <tr>
                                <td><?php echo "{$this->no}"; ?></td>
                                <td><?php echo "{$row['nama']}"; ?></td>
                                <td><?php echo "{$row['email']}"; ?></td>
                                <td><?php echo "{$row['telepon']}"; ?></td>
                                <td><?php echo "{$row['jk']}"; ?></td>
                                <td><?php echo "{$row['p_terakhir']}"; ?></td>
                                <td><?php echo "{$row['pekerjaan']}"; ?></td>
                                <td><img src="../fileUpload/file identitas/<?php echo "{$row['ktp']}"; ?>"  style="width:150px"></td>
                                <td><?php echo "{$row['tipe_kartu_identitas']}"; ?></td>
                                <td><?php echo "{$row['username']}"; ?></td>
                                <td><?php echo "{$row['password']}"; ?></td>
                                <td>
                                    <a href="" id='<?php echo $row['id_pengunjung']?>' class='btn_deletepengunjung btn btn-danger bi bi-trash-fill '
                                    ></a>
                                </td>
                                <td>
                                    <a href='../tindakan/UpdatePengunjung.php?idpengunjung=<?php echo "{$row['id_pengunjung']}"; ?>' class='btn btn-primary bi bi-pen'></a>
                                </td>
                            </tr>
                        
                            <?php
                        $this->no++;
                    }
                return true;
                }
                
                catch(PDOException $e)
                {
                    $e->getMessage();
                    return false;
                }
        }
    // end tampil data pengunjung

    // penghapusan data pengunjung
        public function deletepengunjung($idpengunjung){
            
            $delete = $this->db->prepare('DELETE FROM tbl_pengunjung Where id_pengunjung='.$idpengunjung);
            $delete->execute();
            header('location:../Admin/data_admin.php');        
        }
    // end penghapusan data pengunjung

    // update data pengunjung
        public function Updatepengunjung($id,$nama,$email,$tlp,$username,$password){
            try
            {
                $data = [
                    'nama'=>$nama,
                    'email'=>$email,
                    'telepon'=>$tlp,
                    'username'=>$username,
                    'password'=>$password,
                    'id_pengunjung'=>$id
                ];

                $updatedatapengunjung = $this->db->prepare("UPDATE tbl_pengunjung 
                                                        SET nama = :nama,
                                                            email = :email,
                                                            telepon = :telepon,
                                                            username = :username,
                                                            password = :password
                                                        WHERE id_pengunjung =:id_pengunjung");
                if($updatedatapengunjung->execute($data)){
                    echo "<script>window.location.href = '../Admin/data_pengunjung.php';</script>";
                    return true;
                }
                
            }
            
            catch (PDOException $e)
            {
                $e->getMessage();
                return false;
            }
        }
    // end update data pengunjung

    // aktivasi pengunjung
        public function Aktivasi($token){
            try
            {
                $aktivasipengunjung = $this->db->prepare("UPDATE tbl_pengunjung 
                                                        SET aktif = '1'
                                                        WHERE token = '$token' AND aktif = '0'");

                $aktivasipengunjung->execute();
                return true;
            }
            
            catch (PDOException $e)
            {
                $e->getMessage();
                return false;
            }
        }
    // end aktivasi pengunjung
}

$pengunjung = new Pengunjung($con);

// pencarian
    if(isset($_POST['searcPengunjung'])){
        $searcPengunjung = $_POST['searcPengunjung'];
        $query = "SELECT * FROM tbl_pengunjung WHERE nama LIKE '%".$searcPengunjung."%'";
        $pengunjung->Viewpengunjung($query);
    }
// end pencarian

// delete
    if(isset($_POST['Deletepengunjung'])){
        $Deletepengunjung = $_POST['Deletepengunjung'];
        $pengunjung->deletepengunjung($Deletepengunjung);
    }
// end delete