<?php
    //this file is for the Tickets class and contains the following functions:
        //getTickets - gets all tickets from db
        //getOneTicket - gets one ticket from db
        //addTicket - adds a new ticket to the db
        //updateTicket - updates an existing ticket in the db
        //deleteTicket - deletes a ticket from the db
        //getDatabaseRef - returns ticketData variable
    //######################################################################################

    class Tickets{

        private $ticketData;

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
            //save the PDO obj as ticketData
            $this->ticketData = $pdo;
        }else{ //otherwise tell user the error message
            throw new Exception("<h2>Creation of database object failed : (</h2>", 0, null);
        }
    }//end construct


 // Grab all of the tickets and their info from the DB
    public function getTickets() {
        //global $db;
    
        $results = []; //store in this array
        $ticketTable = $this->ticketData;

        $query = $ticketTable->prepare("SELECT * FROM tickets ORDER BY id"); 
    
        //This runs the query and snatches our ticket info
        if ( $query->execute() && $query->rowCount() > 0 ) {
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
             
     }
     
     return ($results);
    }

    //get singular ticket
    public function getOneTicket($id){
        $results = [];  //hold db info here after we fetch it
        $ticketTable = $this->ticketData; //save the db PDO as ticketTable

        //prepare sql statement
        $query = $ticketTable->prepare("SELECT * FROM tickets WHERE id = :id"); //use id to select correct row
        $query->bindValue(':id', $id); //binds :id from line above to the int passed into function

            //if the sql statement gets executed and the returned amount of junk is more than 0:
            if($query->execute() && $query->rowCount() > 0){
                //fetch the first thing that gets returned
                $results = $query->fetch(PDO::FETCH_ASSOC);
            }
            
            return ($results); //return what gets returned after executing sql statement
       
    }

    //Add a ticket
    public function addTicket($title, $user, $desc, $owner, $status) {

        $results = false;  //initalize results as false
        $ticketTable = $this->ticketData; //set db PDO as ticketTable

        //prepare sql statement to insert what was passed in into the db
        $query = $ticketTable->prepare("INSERT INTO tickets SET title = :title, user = :user, description = :desc, owner = :owner, status = :status");

        //create array that binds :fieldName in line above to the variables passed into function
        $binds = array(
            ":title" => $title,
            ":user" => $user,
            ":desc" => $desc,
            ":owner" => $owner,
            ":status" => $status
        );
    
        //execute the query using the binds and make sure it returned something
        $results = ($query->execute($binds) && $query->rowCount() > 0);
    
        return ($results);
    }

    //Update a ticket
    public function updateTicket($id, $title, $user, $desc, $owner, $status) {
        $results = false; //initialze results to false
        $ticketTable = $this->ticketData; //set db PDO as ticketTable

        //prepare the sql statement to update a specific ticket
        $query = $ticketTable->prepare("UPDATE tickets SET title= :title, user = :user, description = :desc, owner = :owner, status = :status WHERE id = :id");

        //binds :fieldName in line above to the variables passed into function
        $binds = array(
            ":id" => $id,
            ":title" => $title,
            ":user" => $user,
            ":desc" => $desc,
            ":owner" => $owner,
            ":status" => $status
        );
        
        //execute query using binds and check that it returned something
        $results = ($query->execute($binds) && $query->rowCount() > 0);
        
        return ($results);
    }

    //delete ticket
    public function deleteTicket($id){
        $results = false; //inititalze results to false
        $ticketTable = $this->ticketData; //set db PDO as ticketTable

        //prepare sql statement to delete a specific user
        $query = $ticketTable->prepare("DELETE FROM tickets WHERE id = :id");

        //bind :id in line above with id passed into the function
        $query->bindValue(':id', $id);

        //execute sql statement and check that it returned something
        $results = ($query->execute() && $query->rowCount() > 0);

        return ($results);
    }

    //allows search class (Searcher.php) to create queries
    public function getDatabaseRef(){
        return $this->ticketData;
    }
   
    //deconstruct the db PDO obj
    public function __deconstruct(){
        $this->ticketData = null;
    }

}

?>