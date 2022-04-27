<?php
  
  // This code runs everytime the page loads
  include __DIR__ . '/model/model_patient.php';
  include __DIR__ . '/include/function.php';

  $id = filter_input(INPUT_POST, 'id');
  $action = filter_input(INPUT_POST, 'action');
  $firstName = "";
  $lastName = "";
  $birthDate = "";
  $married = "";
  $row = "";
  

  if (isPostRequest($_POST, ['submit'])) {
    $id = filter_input(INPUT_POST, 'id');
    $action = filter_input(INPUT_POST, 'action');
    $firstName = filter_input(INPUT_POST, 'first');
    $lastName = filter_input(INPUT_POST, 'last');
    $birthdate = filter_input(INPUT_POST, 'birth');
    $married = filter_input(INPUT_POST, 'married');
    $result = addPatient($firstName, $lastName, $birthdate, $married);
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
  <input type='text' id='action' name='action' value=<?php echo $action; ?>><!--created as a spot to store the ID data (if there is any) -->
  <input type='text' id='patientId' name='id' value=<?php echo $id; ?>><!--created as a spot to store the ID data (if there is any) -->
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