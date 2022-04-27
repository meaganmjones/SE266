<?php 
  include __DIR__ . '/include/function.php';
  include __DIR__ . '/model/model_patient.php';
session_start();

if(isPostRequest()){
    $_SESSION['username'] = filter_input(INPUT_POST, 'username');
}elseif(!isset($_SESSION['username'])){
    $_SESSION['username'] = NULL;
}

echo sha1('suck my balls');
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
        <input type="text" class="form-control" id="password" placeholder="password" name="password">
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