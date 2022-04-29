<?php
class Users{

    private $userData;

    const PASSWORD_SALT = 'school-salt';

    public function __construct($configFile){
        if($ini = parse_ini_file($configFile)){
            $userPDO = new PDO( "mysql:host=" . $ini['servername'] . 
            ";port=" . $ini['port'] . 
            ";dbname=" . $ini['dbname'], 
            $ini['username'], 
            $ini['password']);

            $userPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $userPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->userData = $userPDO;
        }else{
            throw new Exception("<h2>Creation of database object failed : (</h2>", 0, null);
        }
    }//end construct

    public function getAllUsers(){
        $results = [];
        $userTable = $this->userData;

        return results;
    }

    public function addUser($user, $password){
        $results = false;
        $userTable = $this->userData;

        $salt = random_bytes(32);

        $query = $userTable->prepare("INSERT INTO users SET userName = :user, userPassword = :pwd, userSalt = :salt");

        $binds = array(':user' => $user,
        ':password' => sha1($salt . $password),
        ':salt' => $salt);

        $results = ($query->execute($binds) && $query->rowCount() > 0);

        return $results;
    }
}
?>