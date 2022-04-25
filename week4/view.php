<?php
    include __DIR__ . '/model/model_patient.php';
        

    //need this to delete stuff
    if (isset($_POST)) {
        //grab the id so it knows exactly which patient to get rid of
        $id = filter_input(INPUT_POST, 'patientId');
        deletePatient($id);
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
         <?php foreach ($patients as $row): //loop through the patients in the DB and display one by one?>
            <tr>
                <td>

                    <form action='view.php' method = 'post'>
                        <input type='hidden' name='patientId' value=<?php echo $row['id']; ?>>
                        <td><?php echo$row["id"]; ?>
                        <button type='submit'>delete</a></p>
                    </form>
                </td>
                <td><?php echo $row['patientFirstName']; ?></td>
                <td><?php echo $row['patientLastName']; ?></td>
                <td><?php echo $row['patientBirthDate']; ?></td>  
                <td><?php echo "get the age bro"; ?></td>          
                <td><?php echo $row['patientMarried']; ?></td>
                <td><p><a href="patient_add.php?action=update&patientId=<?php echo $row['id']; ?>">update</a></p></td>
            
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>