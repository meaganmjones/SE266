<?php

    include (__DIR__ . '/database.php');
    

    class Patients{

        private $patientData;


    public function __construct($configFile){
        if($ini = parse_ini_file($configFile)){
            $pdo = new PDO( "mysql:host=" . $ini['servername'].
                            ";port=" . $ini['port'] .
                            ";dbname=" . $ini['dbname'],
                            $ini['username'],
                            $ini['password']);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->patientData = $pdo;
        }else{
            throw new Exception("<h2>Creation of database object failed : (</h2>", 0, null);
        }
    }//end construct


 // Grab all of the patients and their info from the DB
    public function getPatients() {
        //global $db;
    
        $results = []; //store in this array
        $patientTable = $this->patientData;

        $query = $patientTable->prepare("SELECT * FROM patients ORDER BY patientLastName"); 
    
        //This runs the query and snatches our patient info
        if ( $query->execute() && $query->rowCount() > 0 ) {
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
             
     }
     
     return ($results);
    }

    //get singular patient
    public function getOnePatient($id){
        //global $db;

        $results = [];
        $patientTable = $this->patientData;

        $query = $patientTable->prepare("SELECT * FROM patients WHERE id = :id");
        $query->bindValue(':id', $id);

            //This runs the query and snatches our patient info
            $results = ($query->execute() && $query->rowCount() > 0);
            
            return ($results);
       
    }
    // public $pat = 28;
    // public $getOne = getOnePatient($pat);
    // public var_dump($getOne);

    //Add a patient
    public function addPatient($firstName, $lastName, $birthdate, $married) {
        //global $db;
        $results = false;
        $patientTable = $this->patientData;

        $query = $patientTable->prepare("INSERT INTO patients SET patientFirstName = :firstName, patientLastName = :lastName, patientBirthDate = :birthDate, patientMarried = :married");

        $binds = array(
            ":firstName" => $firstName,
            ":lastName" => $lastName,
            ":birthDate" => $birthdate,
            ":married" => $married
        );
    
        $results = ($query->execute($binds) && $query->rowCount() > 0);
    
        return ($results);
    }

    //Update a patient
    public function updatePatient($id, $firstName, $lastName, $birthdate, $married) {
        //global $db;
        $results = false;
        $patientTable = $this->patientData;

        $query = $patientTable->prepare("UPDATE patients SET patientFirstName = :firstName, patientLastName = :lastName, patientBirthDate = :birthDate, patientMarried = :married WHERE id = :id");

        $binds = array(
            ":id" => $id,
            ":firstName" => $firstName,
            ":lastName" => $lastName,
            ":birthDate" => $birthdate,
            ":married" => $married
        );
        
        
        $results = ($query->execute($binds) && $query->rowCount() > 0);
        
        return ($results);
    }

    //delete patient
    public function deletePatient($id){
        //global $db;
        $results = false;
        $patientTable = $this->patientData;

        $query = $patientTable->prepare("DELETE FROM patients WHERE id = :id");

        $query->bindValue(':id', $id);

        $results = ($query->execute() && $query->rowCount() > 0);

        return ($results);
    }

    public function getDatabaseRef(){
        return $this->patientData;
    }
    //calculate the age
    function getAge($birthday){
        $now = date("Y-m-d");
        // found this on stackoverflow https://stackoverflow.com/questions/3776682/php-calculate-age
        $age = date_diff(date_create($now), date_create($birthday))->y;

        return ($age);
    }

    // $today = getAge('2000-01-15');
    // echo $today;
   
    public function __deconstruct(){
        $this->patientData = null;
    }

}

?>