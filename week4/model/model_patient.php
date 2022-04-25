<?php

    include (__DIR__ . '/database.php');
    
    // Grab all of the patients and their info from the DB
    function getPatients() {
        global $db;
        
        $results = []; //store in this array

        $query = $db->prepare("SELECT * FROM patients ORDER BY patientLastName"); 
        
        //This runs the query and snatches our patient info
        if ( $query->execute() && $query->rowCount() > 0 ) {
             $results = $query->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
    }

    //get singular patient
    function getOnePatient($id){
        global $db;

        $results = [];

        $query = $db->prepare("SELECT * FROM patients WHERE id = :id");
        $query->bindValue(':id', $id);

                //This runs the query and snatches our patient info
                if ($query->execute() && $query->rowCount() > 0) {
                    $results = $query->fetch(PDO::FETCH_ASSOC);
                        
                }
                else{
                    return(":(");
                }
                
                return ($results);
           
    }
    // $getOne = getOnePatient(28);
    // var_dump($getOne);

    //Add a patient
    function addPatient($firstName, $lastName, $birthdate, $married) {
        global $db;
        $results = "Not added";

        $query = $db->prepare("INSERT INTO patients SET patientFirstName = :firstName, patientLastName = :lastName, patientBirthDate = :birthDate, patientMarried = :married");

        $binds = array(
            ":firstName" => $firstName,
            ":lastName" => $lastName,
            ":birthDate" => $birthdate,
            ":married" => $married
        );
        
        
        if ($query->execute($binds) && $query->rowCount() > 0) {
            $results = 'Data Added';
        }
        
        return ($results);
    }

        //Update a patient
        function updatePatient($id, $firstName, $lastName, $birthdate, $married) {
            global $db;
            $results = "Not updated";
    
            $query = $db->prepare("UPDATE patients SET patientFirstName = :firstName, patientLastName = :lastName, patientBirthDate = :birthDate, patientMarried = :married WHERE id = :id");
    
            $binds = array(
                ":id" => $id,
                ":firstName" => $firstName,
                ":lastName" => $lastName,
                ":birthDate" => $birthdate,
                ":married" => $married
            );
            
            
            if ($query->execute($binds) && $query->rowCount() > 0) {
                $results = 'Data Added';
            }
            
            return ($results);
        }

        //delete patient
        function deletePatient($id){
            global $db;
            $results = "not deleted";

            $query = $db->prepare("DELETE FROM patients WHERE id = :id");

            $query->bindValue(':id', $id);

            if($query->execute() && $query->rowCount() > 0){
                $results = $query->fetch(PDO::FETCH_ASSOC);
            }

            return ($results);
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

?>