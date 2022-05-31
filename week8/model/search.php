<?php

//this searches a ticket in db by ticket id
//##########################################################################################

include_once __DIR__ . '/ticket.php';

class Search extends Tickets{
    function searchTicket ($id) 
    {
        //initialize arrays and grab db info
        $results = [];                          
        $ticketTable = $this->getDatabaseRef(); 
        //set up select statement to get ticket 
        $query =  "SELECT * FROM  tickets  WHERE id LIKE :id ";
    
       
        // Create query object
        $stmt = $ticketTable->prepare($query);

        $stmt->bindValue(':id', $id);

        // Perform query
        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $results;
    } 
}
?>