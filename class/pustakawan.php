<?php
require_once 'koneksi.php';
class Pustakawan extends koneksi {
    // input admin baru
        public function InsertAdminBaru($nik,$nama,$username,$password)
        {
            try
            {
                $insertdataAdmin = $this->db->prepare("INSERT INTO tbl_pustakawan (nik,nama,username,password) VALUES (:nik,:nama,:username,:password)");

                $insertdataAdmin ->bindParam(':nik',$nik);
                $insertdataAdmin ->bindParam(':nama',$nama);
                $insertdataAdmin ->bindParam(':username',$username);
                $insertdataAdmin ->bindParam(':password',$password);
                $insertdataAdmin->execute();
                return true;
            }
            
            catch (PDOException $e)
                {
                    $e->getMessage();
                    return false;
                }

       }
    // end input admin baru
    
    // view data admin
        public function ViewAdmin($query){
            try{
            $view = $this->db->prepare($query);
            $view->execute();

                while ($row = $view->fetch(PDO::FETCH_ASSOC)){
                    ?>   
                        <tr>
                            <td><?php echo "{$this->no}"; ?></td>
                            <td><?php echo "{$row['nik']}"; ?></td>
                            <td><?php echo "{$row['nama']}"; ?></td>
                            <td><?php echo "{$row['username']}"; ?></td>
                            <td><?php echo "{$row['password']}"; ?></td>
                            <td>
                                <a href="" id='<?php echo $row['id_pustakawan']?>' class='btn_deleteAdmin btn btn-danger bi bi-trash-fill'></a>
                            </td>
                            <td>
                                <a href='../tindakan/UpdateAdmin.php?idAdmin=<?php echo "{$row['id_pustakawan']}"; ?>' class='btn btn-primary bi bi-pen'></a>
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
    // end view data admin

    // update data admin

        public function UpdateAdmin($id,$nik,$nama,$username,$password){
            try
            {
                $data = [
                    'nik'=>$nik,
                    'nama'=>$nama,
                    'username'=>$username,
                    'password'=>$password,
                    'id_user'=>$id
                ];

                $updatedataAdmin = $this->db->prepare("UPDATE tbl_pustakawan 
                                                        SET nik = :nik,
                                                            nama = :nama,
                                                            username = :username,
                                                            password = :password
                                                        WHERE id_pustakawan =:id_user");
                if($updatedataAdmin->execute($data)){
                    echo "<script>window.location.href = '../Admin/data_admin.php';</script>";
                    return true;
                }
            }
            
            catch (PDOException $e)
            {
                $e->getMessage();
                return false;
            }
        }

    // end update data admin

    // penghapusan data pustakawan
        public function deleteadmin($idAdmin){
            
            $delete = $this->db->prepare('DELETE FROM tbl_pustakawan Where id_pustakawan='.$idAdmin);
            $delete->execute();
            echo "<script>window.location.href = '../Admin/data_admin.php';</script>";        
            }
    // end penghapusan data pustakawan
    
}

$pustakawan = new Pustakawan($con);

// pencarian
    if(isset($_POST['searchDataAdmin'])){
        $searchDataAdmin = $_POST['searchDataAdmin'];
        $query = "SELECT * FROM tbl_pustakawan WHERE nama LIKE '%".$searchDataAdmin."%'";
        $pustakawan->ViewAdmin($query);
    }
// end pencarian

// delete
    if(isset($_POST['DeleteAdmin'])){
        var_dump($_POST['DeleteAdmin']);
        $DeleteAdmin = $_POST['DeleteAdmin'];
        $pustakawan->deleteadmin($DeleteAdmin);
    }
// end delete