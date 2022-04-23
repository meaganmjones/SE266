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
    
            $query = $db->prepare("UPDATE patients SET patientFirstName = :firstName, patientLastName = :lastName, patientBirthDate = :birthDate, patientMarried = :married WHERE patientID = :patientID");
    
            $binds = array(
                ":patientID" => $id,
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
    

?>