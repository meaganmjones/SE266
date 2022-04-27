<?php
    include __DIR__ . '/model/model_patient.php';
    include __DIR__ . '/include/function.php';
    if(0 == 0){

    //need this to search/delete stuff
    $patients = [];
    if(isPostRequest()){
        if (isset($_POST['Search'])) {
            $firstName = '';
            $lastName = '';
            $married = '';
            $birthDate = '';
            if($_POST['fieldName'] == 'firstName'){
                // echo 'suck my balls';
                $firstName = $_POST['fieldValue'];
            }
            elseif($_POST['fieldName'] == 'lastName'){
                $lastName = $_POST['fieldValue'];
            }
            elseif($_POST['fieldName'] == 'status'){
                $married = $_POST['fieldValue'];
            }else{
                $birthDate = $_POST['fieldValue'];
            }
            
            $patients = searchPatients($firstName, $lastName, $married, $birthDate);

        }else{
            //grab the id so it knows exactly which patient to get rid of
            $id = filter_input(INPUT_POST, 'patientId');
            deletePatient($id);
            $patients = getPatients();
        }
    }else{
        $patients = getPatients();
    }
          
    

}

    //get the info from the DB
    $patients = getPatients();
?>
    
<html lang="en">
<head>
  <title>Patients</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
     <div class="col-sm-offset-2 col-sm-10">
     
   <h1>Patients</h1>
   <p><a href="patient_add.php?action=add">Add Patient</a></p>
   <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Age</th>
                <th>Married</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <h2>Search</h2>
                <form action="#" method="post">
                    <input type="hidden" name="action" value="search" />
                    <label>Search by Field:</label>
                <select name="fieldName">
                    <option value="">Select One</option>
                    <option value="firstName">First Name</option>
                    <option value="lastName">Last Name</option>
                    <option value="birthDate">BirthDate</option>
                    <option value="status">Marital Status</option>              
                </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>
      
      
         <?php foreach ($patients as $row): //loop through the patients in the DB and display one by one?>
            <tr>
                <td>
  </form>      

                    <form action='view.php' method = 'post'>
                        <input type='hidden' name='patientId' value=<?php echo $row['id']; ?>>
                        <button type='submit'>delete</a></p>
                    </form>
                </td>
                <td><?php echo $row['patientFirstName']; ?></td>
                <td><?php echo $row['patientLastName']; ?></td>
                <td><?php echo $row['patientBirthDate']; ?></td> 
                <?php 
                    //$bday = $row['patientBirthDate'];
                    $age = getAge($row['patientBirthDate']);
                ?> 
                <td><?php echo $age; ?></td>          
                <td><?php echo $row['patientMarried']; ?></td>
                <td><p><a href="patient_add.php?action=update&id=<?php echo $row['id']; ?>">update</a></p></td>
            
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>