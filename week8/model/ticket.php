<?php
    //this file is for the Patients class and contains the following functions:
        //getPatients - gets all patients from db
        //getOnePatient - gets one patient from db
        //addPatient - adds a new patient to the db
        //updatePatient - updates an existing patient in the db
        //deletePatient - deletes a patient from the db
        //getDatabaseRef - returns patientData variable
    //######################################################################################

    class Patients{

        private $patientData;

    //class constructor
    public function __construct($configFile){
        if($ini = parse_ini_file($configFile)){
            //create PDO obj based on URL
            $pdo = new PDO( "mysql:host=" . $ini['servername'].
                            ";port=" . $ini['port'] .
                            ";dbname=" . $ini['dbname'],
                            $ini['username'],
                            $ini['password']);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //save the PDO obj as patientData
            $this->patientData = $pdo;
        }else{ //otherwise tell user the error message
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
        $results = [];  //hold db info here after we fetch it
        $patientTable = $this->patientData; //save the db PDO as patientTable

        //prepare sql statement
        $query = $patientTable->prepare("SELECT * FROM patients WHERE id = :id"); //use id to select correct row
        $query->bindValue(':id', $id); //binds :id from line above to the int passed into function

            //if the sql statement gets executed and the returned amount of junk is more than 0:
            if($query->execute() && $query->rowCount() > 0){
                //fetch the first thing that gets returned
                $results = $query->fetch(PDO::FETCH_ASSOC);
            }
            
            return ($results); //return what gets returned after executing sql statement
       
    }

    //Add a patient
    public function addPatient($firstName, $lastName, $birthdate, $married) {

        $results = false;  //initalize results as false
        $patientTable = $this->patientData; //set db PDO as patientTable

        //prepare sql statement to insert what was passed in into the db
        $query = $patientTable->prepare("INSERT INTO patients SET patientFirstName = :firstName, patientLastName = :lastName, patientBirthDate = :birthDate, patientMarried = :married");

        //create array that binds :fieldName in line above to the variables passed into function
        $binds = array(
            ":firstName" => $firstName,
            ":lastName" => $lastName,
            ":birthDate" => $birthdate,
            ":married" => $married
        );
    
        //execute the query using the binds and make sure it returned something
        $results = ($query->execute($binds) && $query->rowCount() > 0);
    
        return ($results);
    }

    //Update a patient
    public function updatePatient($id, $firstName, $lastName, $birthdate, $married) {
        $results = false; //initialze results to false
        $patientTable = $this->patientData; //set db PDO as patientTable

        //prepare the sql statement to update a specific patient
        $query = $patientTable->prepare("UPDATE patients SET patientFirstName = :firstName, patientLastName = :lastName, patientBirthDate = :birthDate, patientMarried = :married WHERE id = :id");

        //binds :fieldName in line above to the variables passed into function
        $binds = array(
            ":id" => $id,
            ":firstName" => $firstName,
            ":lastName" => $lastName,
            ":birthDate" => $birthdate,
            ":married" => $married
        );
        
        //execute query using binds and check that it returned something
        $results = ($query->execute($binds) && $query->rowCount() > 0);
        
        return ($results);
    }

    //delete patient
    public function deletePatient($id){
        $results = false; //inititalze results to false
        $patientTable = $this->patientData; //set db PDO as patientTable

        //prepare sql statement to delete a specific user
        $query = $patientTable->prepare("DELETE FROM patients WHERE id = :id");

        //bind :id in line above with id passed into the function
        $query->bindValue(':id', $id);

        //execute sql statement and check that it returned something
        $results = ($query->execute() && $query->rowCount() > 0);

        return ($results);
    }

    //allows search class (Searcher.php) to create queries
    public function getDatabaseRef(){
        return $this->patientData;
    }

    //calculate the age
    function getAge($birthday){
        $now = date("Y-m-d"); //set current date as now
        // found this on stackoverflow https://stackoverflow.com/questions/3776682/php-calculate-age
        $age = date_diff(date_create($now), date_create($birthday))->y;

        return ($age);
    }
   
    //deconstruct the db PDO obj
    public function __deconstruct(){
        $this->patientData = null;
    }

}

?>