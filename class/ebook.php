<?php
require_once 'koneksi.php';
class Ebook extends koneksi {   
    
    //  input ebook baru
        public function uploadebook($judulbuku,$name_book,$Penulis,$kategori,$namaCover,$isbn, $sinopsis)
            {
                try
                {
                    $insertEbook = $this->db->prepare("INSERT INTO tbl_book (judul_buku, name_book, Penulis, Kategori, nameCover, ISBN, sinopsis) VALUES (:judul_buku, :name_book, :Penulis, :Kategori, :nameCover, :ISBN, :sinopsis)");
                    
                    $insertEbook->bindParam(':judul_buku', $judulbuku);
                    $insertEbook->bindParam(':name_book', $name_book);
                    $insertEbook->bindParam(':Penulis', $Penulis);
                    $insertEbook->bindParam(':Kategori', $kategori);
                    $insertEbook->bindParam(':nameCover', $namaCover);
                    $insertEbook->bindParam(':ISBN', $isbn);
                    $insertEbook->bindParam(':sinopsis', $sinopsis);

                    $insertEbook->execute();
                    return true;
                }

                catch (PDOException $e){
                    $e->getMessage();
                    return false;
                }
            }
    // end input ebook baru

    // view data ebook
        public function viewDataBook($query){
            try{

                $tampildatabook = $this->db->prepare($query);
                $tampildatabook->execute();

                
                while($row = $tampildatabook->fetch(PDO::FETCH_ASSOC))
                    {
                        $_SESSION['file'] = $row['name_book'];
                        ?>
                            <tr>
                                <td><?php echo "{$this->no}"; ?></td>
                                <td>
                                    <?php   
                                        $view = $this->db->query("SELECT COUNT(judulEbook) FROM tbl_record_history WHERE id_ebook = {$row['id_book']}")->fetchColumn(); 
                                        echo $view;
                                    ?>
                                </td>
                                <td><?php echo "{$row['ISBN']}"; ?></td>
                                <td><?php echo "{$row['judul_buku']}"; ?></td>
                                <td><img src="../fileUpload/cover ebook/<?php echo "{$row['nameCover']}"; ?>"  style="width:150px"></td>
                                <td><?php echo "{$row['Penulis']}"; ?></td>
                                <td><?php echo "{$row['penerbit']}"; ?></td>
                                <td><?php echo "{$row['Kategori']}"; ?></td>
                                <td><?php echo "{$row['tahun_terbit']}"; ?></td>
                                <td>
                                    <a id='<?php echo "{$row['id_book']}"; ?>' class='btn_deleteEbook btn btn-danger bi bi-trash-fill'></a>
                                </td>
                                <td>
                                    <a href='../tindakan/UpdateEbook.php?idebook=<?php echo "{$row['id_book']}"; ?>' class='btn btn-primary bi bi-pen'></a>
                                </td>
                                
                            
                            </tr>
                        
                            <?php
                        $this->no++;
                    }
                return true;
            }

            catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }
    // end view data ebook

    // view ebook list
        public function viewEbook($query){
            try{

                $tampilbook = $this->db->prepare($query);
                $tampilbook->execute();

                while($row = $tampilbook->fetch(PDO::FETCH_ASSOC))          
                {
                    ?>        
                        <div class="w3-third w3-section w3-center" style="float:left; min-height: 400px;">
                            <div class="">
                                <a href="tampilanebook.php?idbook=<?php echo "{$row['id_book']}";?>" style='text-decoration:none'>
                                    <img src="fileUpload/cover ebook/<?php echo "{$row['nameCover']}"; ?>"  style="min-height: 300px; width:150px">
                                            
                                    <div class="w3-container w3-white">
                                        <p><?php echo "{$row['judul_buku']}"; ?></p>
                                        <p><?php echo "{$row['Penulis']}"; ?></p>
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
    // end view Ebook list

    // tambah kategori baru
        public function insertkategoribaru($kategoribaru)
            {
                try
                {
                    $insertKategori = $this->db->prepare("INSERT INTO tbl_listkategori (kategori) VALUES (:kategori)");
                    
                    $insertKategori->bindParam(':kategori', $kategoribaru);

                    if($insertKategori->execute()){
                        echo "<script>window.location.href = '../Admin/input_book.php';</script>";
                        return true;
                    }
                }

                catch (PDOException $e){
                    $e->getMessage();
                    return false;
                }
            }
        
    // end tambah kategori baru

    // view kategori baru
        public function viewlistKategoribaru($query){
            try{

                $tampilkategoribaru = $this->db->prepare($query);
                $tampilkategoribaru->execute();

                while($row = $tampilkategoribaru->fetch(PDO::FETCH_ASSOC))          
                {
                    ?>
                        <option value="<?php echo $row['kategori'] ?>"><?php echo $row['kategori'] ?></option>
                    <?php
                } 
                return true;     
            }
            catch(PDOException $e){
                $e->getMessage();
                return false;
            }
        }
    // end view kategori baru

    // view kategori
        public function viewlistKategori($query){
            try{

                $tampilbook = $this->db->prepare($query);
                $tampilbook->execute();

                while($row = $tampilbook->fetch(PDO::FETCH_ASSOC))          
                {
                    ?>        
                        <div class="w3-third w3-section w3-center" style="float:left; min-height: 400px;">
                            <div class="">
                                <a href="tampilanebook.php?idbook=<?php echo "{$row['id_book']}";?>" style='text-decoration:none'>
                                    <img src="fileUpload/cover ebook/<?php echo "{$row['nameCover']}"; ?>"  style="min-height: 300px; width:150px">
                                            
                                    <div class="w3-container w3-white">
                                        <p><?php echo "{$row['judul_buku']}"; ?></p>
                                        <p><?php echo "{$row['Penulis']}"; ?></p>
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
    // end view kategori

    // kategori ebook
        public function viewEbookberdasarkankategori($query){
            try{
            $view = $this->db->prepare($query);
            $view->execute();

                while ($row = $view->fetch(PDO::FETCH_ASSOC)){
                    ?>   
                        <a href="ebooklistKategori.php?kategori='<?php echo $row['Kategori']?>'" class="w3-bar-item w3-button" ><?php echo $row['Kategori'] ?></a>   
                    <?php
                }
            return true;
            }
            
            catch(PDOException $e)
            {
                $e->getMessage();
                return false;
            }
        }
    // end kategori ebook

    // penghapusan data ebook
        public function deleteebook($idebook){

            $delete = $this->db->prepare("SELECT * FROM tbl_book tb, tbl_penerbit tp WHERE id_book = id_penerbit AND tb.id_book =".$idebook);
            $delete->execute();           
                while($row = $delete->fetch(PDO::FETCH_ASSOC))
                    {
                        $file=$row['name_book'];
                        $cover=$row['nameCover'];  
                    }          
                    
                    unlink('../fileUpload/file ebook/'.$file);
                    unlink('../fileUpload/cover ebook/'.$cover);
            
            $deleteBook = $this->db->prepare('DELETE tb.*, tp.* FROM tbl_book tb, tbl_penerbit tp WHERE tb.id_book = tp.id_penerbit AND id_book = '.$idebook);
            $deleteBook->execute();
            echo "<script>window.location.href = '../Admin/data_book.php';</script>"; 
            }
    // end penghapusan data ebook

    // full update data ebook
        public function fullupdatedataEbook($idbook,$judulbuku,$Penulis,$sinopsis,$namaCover,$isbn){
            try
            {
                $data = [
                    'judul_buku'=>$judulbuku,
                    'Penulis'=>$Penulis,
                    'ISBN'=>$isbn,
                    'sinopsis'=>$sinopsis,
                    'nameCover'=>$namaCover,
                    'id_book'=>$idbook
                ];

                $fullupdatedataebook = $this->db->prepare("UPDATE tbl_book 
                                                        SET judul_buku = :judul_buku,
                                                            Penulis = :Penulis,
                                                            ISBN = :ISBN,
                                                            sinopsis = :sinopsis,
                                                            nameCover = :nameCover
                                                        WHERE id_book = :id_book");
                if($fullupdatedataebook->execute($data)){
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
    // end full update data ebook

    // update data ebook
        public function updatedataEbook($idbook,$judulbuku,$Penulis,$isbn, $sinopsis){
            try
            {
                $data = [
                    'judul_buku'=>$judulbuku,
                    'Penulis'=>$Penulis,
                    'ISBN'=>$isbn,
                    'sinopsis'=>$sinopsis,
                    'idEbook'=>$idbook
                ];

                $updatedataebook = $this->db->prepare("UPDATE tbl_book 
                                                        SET judul_buku = :judul_buku,
                                                            Penulis = :Penulis,
                                                            ISBN = :ISBN,
                                                            sinopsis = :sinopsis
                                                        WHERE id_book =:idEbook");
                if($updatedataebook->execute($data)){
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
    // end update data ebook

    // detail
        public function detail($query){
            $detailebook = $this->db->prepare($query);
            $detailebook->execute();

            while($row = $detailebook->fetch(PDO::FETCH_ASSOC))          
            
            echo'
            
            <tr>
                <td><h5><b>JUDUL</b></td>
                <td><h5><b> : </b></td>
                <td><h5> '.$row['judul_buku'].' </h5></td>
            </tr>

            <tr>
                <td><h6><b>PENULIS</b></h6></td>
                <td><h6><b> : </b></h6></td>
                <td><h6> '.$row['Penulis'].' </td>
                </tr>

            <tr>
                <td><h6><b>ISBN</b></h6></td>
                <td><h6><b> : </b></h6></td>
                <td><h6> '.$row['ISBN'].' </h6></td>
            </tr>

            <tr>
                <td><h6><b>PENERBIT</b></h6></td>
                <td><h6><b> : </b></h6></td>
                <td><h6> '.$row['penerbit'].' </h6></td>
            </tr>
            <tr>
                <td><h6><b>TAHUN TERBIT</b></h6></td>
                <td><h6><b> : </b></h6></td>
                <td><h6> '.$row['tahun_terbit'].' </h6></td>
            </tr>  
            
            <tr>
                <td><h6 style="text-align: justify;"><b>SINOPSIS</b></h6></td>
                <td><h6><b> : </b></h6></td>
                <td><h6> '.$row['sinopsis'].' </h6></td>
            </tr>';


            
        }
    // end detail

}

$ebook = new Ebook($con);

// delete
    if(isset($_POST['DeleteEbook'])){
        $DeleteEbook = $_POST['DeleteEbook'];
        $ebook->deleteebook($DeleteEbook);
        return true;
    }
// end delete

// pencarian
    if (isset($_POST['searchDataEbook'])) {
        $searchDataEbook = $_POST['searchDataEbook'];
        $query = "SELECT * FROM tbl_book tb, tbl_penerbit tp WHERE id_book = id_penerbit AND judul_buku LIKE '%".$searchDataEbook."%'";
        $ebook->viewDataBook($query);
    }

    else if (isset($_POST['searchEbook'])){
        $searchEbook = $_POST['searchEbook'];
        $query = "SELECT * FROM tbl_book WHERE judul_buku LIKE '%".$searchEbook."%'";
        $ebook->viewEbook($query);
    }
// end pencarian