<?php 
class Votes{
    private $voteData;


    public function __construct($configFile){
        if($ini = parse_ini_file($configFile)){
            $votePDO = new PDO("mysql:host=" . $ini['servername'] .
            ";port=" .$ini['port']. 
            ";dbname=" .$ini['dbname'],
            $ini['username'],
            $ini['password']);

            $teamPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $teamPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->voteData = $votePDO;
        }else{
            throw new Exception("<h2>Creation of database object failed<h2>", 0, null);
        }
    }

    public function getVotes(){
        $results = [];
        $voteTable = $this->voteData;

        $query = $voteTable->prepare("SELECT * FROM votes");

        if($query->execute() && $query->rowCount() > 0){
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $results;
    }

    public function insertVote($cinderella, $mulan, $snowWhite){
        $results = false;
        $voteTable = $this->voteData;

        $query = $voteTable->prepare("INSERT INTO votes SET ") //fix this query!!!!!!

        $binds = array(":cinderella" => $cinderella,
                        ":mulan" => $mulan,
                        ":snowWhite" => $snowWhite);

        $results = ($query->execute($binds) && $query->rowCount() > 0);

        return $results;
    }

    public function updateVotes($cinderella, $mulan, $snowWhite){
        $results = false;
        $voteTable = $this->voteData;

        $query = $voteTable->prepare("UPDATE votes SET cinderella = :cinderella, mulan = :mulan, snowWhite = :snowWhite WHERE id = :id");

        $binds = array(":cinderella" => $cinderella,
                        ":mulan" => $mulan,
                        ":snowWhite" => $snowWhite);
    }
}


?>