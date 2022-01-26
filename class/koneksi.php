<?php

class koneksi{
    public $db;
    public $no;

    public function __construct($con){           
            $this->no = 1;
            $this->db = $con; 
    }
}

try {
    $con = new PDO('mysql:host=localhost;dbname=eperpus', 'root','',array(PDO::ATTR_PERSISTENT=>true));
}
catch (PDOException $e){
    echo $e->getMessage();
}