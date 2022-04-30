<?php
  include __DIR__ . '/include/function.php';
  include __DIR__ . '/model/users.php';
        $configFile = __DIR__ . '/model/dbconfig.ini';
        try{
          $userDatabase = new Users($configFile);
        }catch(Exception $error){
          echo "<h2>" . $error->getMessage() . "</h2>";
        }

        $name = 'donald';
        $pw = 'duck';

        $donald = $userDatabase->addUser($name, $pw);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    
</body>
</html>