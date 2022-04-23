 <?php
  
  // This code runs everything the page loads
  include __DIR__ . '/model/model_patient.php';
  //include __DIR__ . '/view.php'; 
  include __DIR__ . '/include/function.php';
  if (isPostRequest()) {
    $firstName = filter_input(INPUT_POST, 'first');
    $lastName = filter_input(INPUT_POST, 'last');
    $birthdate = filter_input(INPUT_POST, 'birth');
    $married = filter_input(INPUT_POST, 'married');
    $result = addPatient($firstName, $lastName, $birthdate, $married);
  }

  //Grab info from URL and decide if if action is is 'add' or 'update':
  if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action');
    $id = filter_input(INPUT_GET, 'patientId');
    //if action is 'update':
    if($action == 'update'){
        //run getPatients function using the ID and store it as $row
        $row = getPatients($id);
        //get the info from getPatients.... This isn't working correctly :(
            //gives error saying 'undefined array key'. Not sure why
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
  //grab action info from URL
  elseif(isset($_POST['action'])){
    //grab info from URL. I think...?
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'patientId');
      //grab info from the form
      $firstName = filter_input(INPUT_POST, 'firstName');
      $lastName = filter_input(INPUT_POST, 'lastName');
      $birthDate = filter_input(INPUT_POST, 'birthDate');
      $married = filter_input(INPUT_POST, 'married');
      //if action is add:
      if($action == 'add'){
        //run the addPatient function
        $result = addPatient($firstName, $lastName, $birthDate, $married);
      }
      //otherwise it's an update
      elseif($action == 'update'){
        //update the DB with info from the form
        $result = updatePatient($id, $firstName, $lastName, $birthDate, $married);
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

  <input type='hidden' id='patientId' name='id' value=<?php $row['id']; ?>><!--created as a spot to store the ID data (if there is any) -->

  <!--Section for the first name -->
  <form class="form-horizontal" action="patient_add.php" method="post">
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
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Patient</button>
        <?php
          //feedback
            if (isPostRequest()) {
                echo "Patient added";
            }
        ?>
      </div>
    </div>
  </form>
  
</div>

</body>
</html>