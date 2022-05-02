<?php

include_once __DIR__ . '/model_patient.php';

class PatientSearcher extends Patients{
    function searchPatient ($first, $last, $married) 
    {
        $results = [];             
        $binds = [];               
        $patientTable = $this->getDatabaseRef();   


        $query =  "SELECT * FROM  patients   ";
$isFirstClause = true;
        
        if ($first != "") {
            if ($isFirstClause)
            {
                $query .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $query .= " AND ";
            }
            $query .= "  patientFirstName LIKE :firstName";
            $binds['firstName'] = '%'.$first.'%';
        }

        if ($last != "") {
            if ($isFirstClause)
            {
                $query .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $query .= " AND ";
            }
            $query .= "  patientLastName LIKE :lastName";
            $binds['lastName'] = '%'.$last.'%';
        }
    
       
        // Create query object
        $stmt = $patientTable->prepare($query);

        // Perform query
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $results;
    } 
}
?>