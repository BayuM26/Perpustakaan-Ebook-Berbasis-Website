<?php
require_once 'pengunjung.php';
class vote extends Pengunjung {
    // like
        public function voteEbook($idEbook, $idPengunjung, $vote){
            try
            {
                $likeEbook = $this->db->prepare("INSERT INTO tbl_vote (id_pengunjung, id_ebook, vote) VALUES (:id_pengunjung, :id_ebook, :vote)");

                $likeEbook ->bindParam(':id_pengunjung',$idPengunjung);
                $likeEbook ->bindParam(':id_ebook',$idEbook);
                $likeEbook ->bindParam(':vote',$vote);

                if($likeEbook->execute()){
                    return true;
                }else{
                    return false;
                }
            }
            
            catch (PDOException $e)
                {
                    $e->getMessage();
                    return false;
                }
        }
    // end like 
    
    // dislike
        public function cencelvoteEbook($vote,$idEbook,$idPengunjung){
            try
            {
                $data = [
                    'vote' => $vote,
                    'id_ebook' => $idEbook,
                    'id_pengunjung' => $idPengunjung
                ];

                $updatedatapengunjung = $this->db->prepare("UPDATE tbl_vote 
                                                        SET vote = :vote
                                                        WHERE id_ebook = :id_ebook AND id_pengunjung = :id_pengunjung");

                if($updatedatapengunjung->execute($data)){
                    return true;
                }else{
                    return false;
                }
            }
            
            catch (PDOException $e)
            {
                $e->getMessage();
                return false;
            }
        }
    // end dislike
}

$Vote = new vote($con);