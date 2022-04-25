 <?php
  
  // This code runs everything the page loads
  include __DIR__ . '/model/model_patient.php';
  include __DIR__ . '/include/function.php';

  //Grab info from URL and decide if if action is is 'add' or 'update':
  var_dump($_GET);
  // var_dump($_POST);
  if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action');
    //var_dump($action);
    $id = filter_input(INPUT_GET, 'id');
    var_dump($id);
    //if action is 'update':
    if($action == 'update'){
        //run getOnePatient function using the ID and store it as $row
        $row = getOnePatient($id);
        //var_dump($row);
        //get the info from getOnePatient
        $id = $row['id'];
        $firstName = $row['patientFirstName'];
        $lastName = $row['patientLastName'];
        $birthDate = $row['patientBirthDate'];
        $married = $row['patientMarried'];

      //otherwise set the fields to blank to prepare to add a patient
      }else{
        
          $firstName = '';
          $lastName = '';
          $birthDate = '';
          $married = '';
      }   

  }
    elseif(isPostRequest($_POST['action'])){
      echo 'GOT HERE 1st';
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'id');
      $firstName = filter_input(INPUT_POST, 'first');
      $lastName = filter_input(INPUT_POST, 'last');
      $birthDate = filter_input(INPUT_POST, 'birth');
      $married = filter_input(INPUT_POST, 'married');
      //if action is add:
      if(isPostRequest() && $action == 'add'){
        //run the addPatient function
        echo 'GOT HERE';
        $result = addPatient($firstName, $lastName, $birthDate, $married);
        header('Location: view.php');
      }
      //otherwise it's an update
      elseif(isPostRequest() && $action == 'update'){
        //update the DB with info from the form
        $result = updatePatient($id, $firstName, $lastName, $birthDate, $married);
        header('Location: view.php');
      }
      else{
        header('Location: view.php');
      }
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
  <form class="form-horizontal" action="patient_add.php" method="post">
  <input type='text' id='action' name='action' value=<?php echo $action; ?>><!--created as a spot to store the ID data (if there is any) -->
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
      <label class="control-label col-sm-2" for="pwd">Marital Status: </label>
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
        <button type="submit" class="btn btn-default" name='submit'><?php echo $action; ?> Patient</button>
        <?php
          // if(isset($_POST['submit'])){
          //   echo "successful";
          //}
        ?>
      </div>
    </div>
  </form>
  
</div>

</body>
</html>