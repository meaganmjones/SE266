<?php 
//this file allows the user to login
//will redirect to view.php if login successful
//#######################################################
  include __DIR__ . '/include/function.php';
  include __DIR__ . '/model/users.php';

  session_start(); //it doesn't work without this
  //currently user not logged in
  $_SESSION['isLoggedIn'] = false;

  $message = "";
//if its a post request:
if(isPostRequest()){
  //grab what user typed
    $userName = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    //set up config file
    $configFile = __DIR__ . '/model/dbconfig.ini';
    try{
      $userDatabase = new Users($configFile);
    }catch(Exception $error){
      echo "<h2>" . $error->getMessage() . "</h2>";
    }
    
   //check for valid creds
    if($userDatabase->validateCredentials($userName, $password)){
      $_SESSION['isLoggedIn'] = true;

      header('Location: view.php');
    }else{
      $message = "Incorrect login credentials";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form method="post" action="login.php">
    <div class="form-group">
      <label class="control-label col-sm-2" for="username">Username: </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="username" placeholder="Username" name="username">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="password">Password: </label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="password" placeholder="password" name="password">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name='submit'>Login</button>
      </div>
    </div>
    </form>

</body>
</html>