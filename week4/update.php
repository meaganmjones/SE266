<?php
  
  // This code runs everything the page loads
  include __DIR__ . '/model/model_patient.php';
  include __DIR__ . '/include/function.php';
//   if (isPostRequest()) {
//     $firstName = filter_input(INPUT_POST, 'first');
//     $lastName = filter_input(INPUT_POST, 'last');
//     $birthdate = filter_input(INPUT_POST, 'birth');
//     $result = addPatient($firstName, $lastName, $birthdate, $married);
//   }

  if (isset($GET['action'])){
      $action = filter_input(INPUT_GET, 'action');
      $id = filter_input(INPUT_GET, 'patientID');
      if($action == 'update'){
          $row = getPatients($id);
          $firstName = $row['patientFirstName'];
          $lastName = $row['patientLastName'];
          $birthDate = $row['birthDate'];
          $married = $row['married'];
        }else{
            $firstName = 'not';
            $lastName = 'working';
            $birthDate = 'god knows';
            $married = 0;
        }   
    }

    elseif(isset($_POST['action'])){
        $action = filter_input(INPUT_POST, 'action');
        $id = filter_input(INPUT_POST, 'patientId');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $birthDate = filter_input(INPUT_POST, 'birthDate');
        $married = filter_input(INPUT_POST, 'married');
        if($action == "Add"){

        }
    }
?>
    

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

  <h1>Update Patient</h1>

  <form class="form-horizontal" action="update.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="first name">First Name: </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="first" placeholder="First Name" name="first" value=<?php echo $firstName ?>>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Last Name: </label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="last" placeholder="Last Name" name="last" value=<?php echo $lastName ?>>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Birth Date: </label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="birth" placeholder="birth date" name="birth" value=<?php echo $birthDate ?>>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Marriage Status: </label>
      <div class="col-sm-10">  
        <input type="radio" id="html" name="married" value=<?php echo $married ?>>
        <label for="html">No</label><br>
        <input type="radio" id="css" name="married" value=<?php echo $married ?>>
        <label for="css">Yes</label><br>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Update</button>
        <?php
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