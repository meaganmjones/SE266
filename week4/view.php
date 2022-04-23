<?php
        include __DIR__ . '/model/model_patient.php';
        

   if (isset($_POST)) {
    $id = filter_input(INPUT_POST, 'patientId');
    deletePatient($id);
   }
    $patients = getPatients();
?>
    
<html lang="en">
<head>
  <title>Update Patient</title>
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
   <p><a href="patient_add.php">Add Patient</a></p>
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
         <?php foreach ($patients as $row): ?>
            <tr>
                <td>

                    <form action='view.php' method = 'post'>
                        <input type='hidden' name='patientId' value=<?php echo $row['id']; ?>>
                        <button type='submite'>delete</a></p>
                    </form>
                </td>
                <td><?php echo $row['patientFirstName']; ?></td>
                <td><?php echo $row['patientLastName']; ?></td>
                <td><?php echo $row['patientBirthDate']; ?></td>  
                <td><?php echo "get the age bro"; ?></td>          
                <td><?php echo $row['patientMarried']; ?></td>
                <td><p><a href="update.php?action=update&patientId=<?php echo $row['id']; ?>">update</a></p></td>
            
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>