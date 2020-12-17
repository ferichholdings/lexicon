<?php

class Database{

    private $server = "localhost";
    private $user   = "root";
    private $pass   = "";
    private $db     = "lexicon";

    public function con(){
        $con = new Mysqli($this->server,$this->user,$this->pass,$this->db);
        return $con;
    }
}



?>