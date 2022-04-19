<?php
        include __DIR__ . '/model/model_teams.php';
        
        $teams = getTeams();
?>
    
<html lang="en">
<head>
  <title>View NFL Team</title>
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
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Age</th>
                <th>Married</th>
            </tr>
        </thead>
        <tbody>
         <?php foreach ($patients as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['patientFirstName']; ?></td>
                <td><?php echo $row['patientLastName']; ?></td>
                <td><?php echo $row['patientMarried']; ?></td>            
                <td><?php echo $row['patientBirthDate']; ?></td>         
            
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>