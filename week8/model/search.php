<?php

//this file is for the PatientSearcher class, an extension of the Patients class
//it includes the following functions:
    //searchPatient - grabs specific patient(s) from db
//##########################################################################################

include_once __DIR__ . '/model_patient.php';

class PatientSearcher extends Patients{
    function searchPatient ($first, $last, $married) 
    {
        //initialize arrays and grab db info
        $results = [];             
        $binds = [];               
        $patientTable = $this->getDatabaseRef(); 
        //set up select statement to get patient  
        $query =  "SELECT * FROM  patients   ";
$isFirstClause = true;
        
        //if choice was first name:
        if ($first != "") {

            //if isFirstClause is true:
            if ($isFirstClause)
            {
                //add the WHERE to sql statement 
                $query .=  " WHERE ";
                //set isFirstClause to false so it flows into the else statement
                $isFirstClause = false;
            }
            else //add the AND statement with string passed in
            {
                $query .= " AND ";
            }
            //append the sql statement with columnName LIKE htmlString
            $query .= "  patientFirstName LIKE :firstName";
            //binds array key with value passed in
            //will represent :firstName when executing the sql statements
            $binds['firstName'] = '%'.$first.'%';
            
        }

        //if choice was last name:
            if ($last != "") {
                //if isFirstClause is true:
                if ($isFirstClause)
                {
                    //add the WHERE to sql statement 
                    $query .=  " WHERE ";
                    //set isFirstClause to false so it flows into the else statement
                    //pls tell me theres a better way to do this
                    $isFirstClause = false;
                }
                else //add the AND statement with string passed in
                {
                    $query .= " AND ";
                }
                //append the sql statement with columnName LIKE htmlString
                $query .= "  patientlastName LIKE :lastName";
                //binds array key with value passed in
                //will represent :lastName when executing the sql statements
                $binds['lastName'] = '%'.$last.'$';
            }    

            //if choice was married:
            if ($married != "") {
                //if isFirstClause is true:
                if ($isFirstClause)
                {
                    //add the WHERE to sql statement 
                    $query .=  " WHERE ";
                    //set isFirstClause to false so it flows into the else statement
                    //pls tell me theres a better way to do this
                    $isFirstClause = false;
                }
                else //add the AND statement with string passed in
                {
                    $query .= " AND ";
                }
                //append the sql statement with columnName LIKE htmlString
                $query .= "  patientMarried LIKE :married";
                //binds array key with value passed in
                //will represent :married when executing the sql statements
                $binds['married'] = '%'.$married.'$';
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