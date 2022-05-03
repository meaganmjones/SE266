<?php

//this file is for the Users class and contains the following functions:
    //getAllUsers - get all the users from the db
    //addUser - add a user to the db
    //deleteUser - delete a user from the db
    //getOneUser - gets a specific user from the db
    //getDatabaseRef - returns userData
    //validateCredentials - compares values passed in with values in the db

//######################################################################################
class Users{

    private $userData;

    const PASSWORD_SALT = 'school-salt';

    //create constructor using config file
    public function __construct($configFile){
        if($ini = parse_ini_file($configFile)){
            //create PDO obj 
            $userPDO = new PDO( "mysql:host=" . $ini['servername'] . 
            ";port=" . $ini['port'] . 
            ";dbname=" . $ini['dbname'], 
            $ini['username'], 
            $ini['password']);

            $userPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $userPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //set new PDO obj as userData
            $this->userData = $userPDO;
        }else{
            throw new Exception("<h2>Creation of database object failed : (</h2>", 0, null);
        }
    }//end construct

    //get all users
    public function getAllUsers(){
        $results = []; //array to hold users
        $userTable = $this->userData; //set db PDO obj as userTable

        return results; //return array
    }

    //add a user
    public function addUser($user, $password){
        $results = false; //initialize results to false
        $userTable = $this->userData; //set db PDO as userTable

        $salt = random_bytes(32); //set salt to be 32 random bytes

        //prepare insert statement for db
        $query = $userTable->prepare("INSERT INTO users SET userName = :user, userPassword = :pwd, userSalt = :salt");

        //bind :fieldName from line above with variables passed into the function
        $binds = array(':user' => $user,
        ':pwd' => sha1($salt . $password),
        ':salt' => $salt);

        //execute sql statement using the binds and check that it returned something
        $results = ($query->execute($binds) && $query->rowCount() > 0);

        return $results;
    }

    //delete a user
    public function deleteUser($id){
        $results = false; //initialze results to false
        $userTable = $this->userData;  //set db PDO as userTable

        return $results; //return results
    }

    //select a single user
    public function getOneUser($id){
        $results = []; //array to hold db info
        $userTable = $this->userData; //set db PDO as userTable

        return $results; //return results
    }

    public function getDatabaseRef(){
        return $this->userData;
    }

    //validate credentials
    public function validateCredentials($userName, $password){
        $isValidUser = false; //initialize isValidUser as false
        $userTable = $this->userData; //set db PDO as userTable

        //prepare select statement - select user password and salt from users table where column name userName = :whatever was passed in
        $query = $userTable->prepare("SELECT userPassword, userSalt FROM users WHERE userName = :userName");

        //bind :userName to variable passed into function
        $query->bindValue(':userName', $userName);

        //execute statement and check that it returned something
        $found = ($query->execute() && $query->rowCount()>0);

        //if something is returned
        if($found){
            $results = $query->fetch(PDO::FETCH_ASSOC); //fetch the info from db
            $hashedpw = sha1($results['userSalt'] . $password); //use what was handed to function in the 'password formula' and save as hashedpw
            $isValidUser = ($hashedpw == $results['userPassword']); //compare hashedpw to the db results
        }

        return $isValidUser;

    }
}//end class
?>