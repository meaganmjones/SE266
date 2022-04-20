<?php

    include (__DIR__ . '/database.php');
    
    // Grab all of the patients and their info from the DB
    function getPatients() {
        global $db;
        
        $results = [];

        $query = $db->prepare("SELECT * FROM patients ORDER BY patientLastName"); 
        
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

            $query = $db->prepare("DELETE FROM patients WHERE patientID = :id");

            $query->bindValue(':id', $id);

            if($query->rowCount() > 0){
                $results = "Patient info deleted";
            }

            return ($results);
        }

   
    // Alternative style to add team records database.
    // function addTeam2 ($team, $division) {
    //     global $db;
    //     $results = "Not added";

    //     $stmt = $db->prepare("INSERT INTO teams SET teamName = :team, division = :division");
       
    //     $stmt->bindValue(':team', $team);
    //     $stmt->bindValue(':division', $division);
       
    //     if ($stmt->execute() && $stmt->rowCount() > 0) {
    //         $results = 'Data Added';
    //     }
       
    //     $stmt->closeCursor();
       
    //     return ($results);
    // }
   
    //   $result = addTeam2 ('Ajax', 'Eredivisie');
    //   echo $result;
    

?>