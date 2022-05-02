<?php

//this file:
  //requires user login
  //is a form to fill out to add/update a patient
  //determines action from URL
  //will display empty boxes when adding and show patient info when updating
//####################################################################################


     // Load helper functions (which also starts the session) then check if user is logged in
     include_once __DIR__ . '/include/function.php';
     if (!isUserLoggedIn())
     {
         header ('Location: login.php');
     }
  
  // This code runs everytime the page loads
  include __DIR__ . '/model/searcher.php';

  //set up config file and create db
  $configFile = __DIR__ . '/model/dbconfig.ini';
  try 
  {
    //use config file to create a new instance of the Patients class
    //store as variable patientDatabase
      $patientDatabase = new Patients($configFile);
  } 
  catch ( Exception $error ) 
  {
      echo "<h2>" . $error->getMessage() . "</h2>";
  }  

  //find out if action sent from view.php was add/update
  if(isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action'); //get action from URL
    $id = filter_input(INPUT_GET, 'id'); //get id from URL
    //if action is update:
    if($action == "update"){
      //call on getOnePatient using id passed in
      $row = $patientDatabase->getOnePatient($id);
      $firstName = $row['patientFirstName'];
      $lastName = $row['patientLastName'];
      $birthDate = $row['patientBirthDate'];
      $married = $row['patientMarried'];
    }else{ //otherwise set variables in HTML to nothing
        
      $firstName = '';
      $lastName = '';
      $birthDate = '';
      $married = '';
    }   
  } //end if GET
  
  //if its post :
  elseif(isset($_POST['action'])){ 
    // grab info from HTML
    $action = filter_input(INPUT_POST, 'action');
    $id = filter_input(INPUT_POST, 'id');
    $firstName = filter_input(INPUT_POST, 'first');
    $lastName = filter_input(INPUT_POST, 'last');
    $birthDate = filter_input(INPUT_POST, 'birth');
    $married = filter_input(INPUT_POST, 'married');

    //if action is add:
    if($action == 'add'){
      //run addPatient from Patient class
      $result = $patientDatabase->addPatient($firstName, $lastName, $birthDate, $married);
    }elseif($action == 'update'){ //if action is update
      //run updatePatient from Patient class
      $result = $patientDatabase->updatePatient($id, $firstName, $lastName, $birthDate, $married);
    }
    header('Location: view.php'); //brings user back to view.php
  }
  else{
    header('Location: view.php');
  }

?>
    
<!-- I stole the following lines from the example gitHub and adjusted as needed -->
<html lang="en">
<head>
  <title>Add Patient</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
<div class="col-sm-offset-2 col-sm-10"><h3><a href="./view.php">View Patients</a></h3></div>

  <h1>Add Patient</h1>


  <!--Section for the first name -->
  <form class="form-horizontal" action="" method="get">
  <input type='text' id='action' name='action' value=<?php echo $action; ?>><!--created as a spot to store the action data (if there is any) -->
  <input type='text' id='id' name='id' value=<?php echo $id; ?>><!--created as a spot to store the ID data (if there is any) -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="first name">First Name: </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="first" placeholder="First Name" name="first" value=<?php echo $firstName; ?>>
      </div>
    </div>

    <!--Section for last name -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Last Name: </label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="last" placeholder="Last Name" name="last" value=<?php echo $lastName; ?>>
      </div>
    </div>

    <!--Section for birthday -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Birth Date: </label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="birth" placeholder="birth date" name="birth" value=<?php echo $birthDate; ?>>
      </div>
    </div>

    <!--Section for married data -->
    <!--How do I fill in the radio buttons using the $married variable? The associated values are what gets imported into the DB, so I don't want to change them -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Marriage Status: </label>
      <div class="col-sm-10">  
        <input type="radio" id="html" name="married" value=0>
        <label for="html">No</label><br>
        <input type="radio" id="css" name="married" value=1>
        <label for="css">Yes</label><br>
      </div>
    </div>
    

    <!--Section for add/update button -->
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" value="add"><?php echo $action; ?> Patient</button>
        <?php
          //feedback
        ?>
      </div>
    </div>
  </form>
  
</div>

</body>
</html>