<?php


    include_once __DIR__ . '/include/function.php';

    if(!isUserLoggedIn()){
        header('Location: login.php');
    }

    include_once __DIR__ . 'model/ticket.php';

    $configFile = __DIR__ . 'model/dbconfig.ini';
    try{
        $ticketDatabase = new TicketSearch($configFile);
    }catch(Exception $error){
        echo '<h2>' . $error->getMessage() . '<h2>';
    }

    $tickets = [];
    if(isPostRequest()){
        if(isset($_POST['Search'])){
            $clientName = '';
            $techName = '';
            $desc = '';
            $status = '';

            
        }
    }else{
        $id = filter_input(INPUT_POST, 'ticketID');
        $ticketDatabase->deleteTicket($id);
        $tickets = $ticketDatabase->getTickets();
    }

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

     <a href="logoff.php">Logoff</a> <!--logoff button-->

   <h1>Patients</h1>
   <p><a href="edit.php?action=add">Add Patient</a></p>

        <h2>Search</h2>
                <form action="#" method="post">
                    <input type="hidden" name="action" value="search" />
                    <label>Search by Field:</label>
                <select name="fieldName">
                    <option value="">Select One</option>
                    <option value="firstName">First Name</option>
                    <option value="lastName">Last Name</option>
                    <option value="status">Marital Status</option>
                </select>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>
      
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
         <?php foreach ($ticketsts as $row): //loop through the patients in the DB and display one by one?>
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
                    $age = $patientDatabase->getAge($row['patientBirthDate']);
                ?> 
                <td><?php echo $age; ?></td>          
                <td><?php echo $row['patientMarried']; ?></td>
                <td><p><a href="edit.php?action=update&id=<?php echo $row['id']; ?>">update</a></p></td>
            
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>