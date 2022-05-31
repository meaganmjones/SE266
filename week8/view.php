<?php


    include_once __DIR__ . '/include/function.php';
    include_once __DIR__ . '/model/search.php';

    if(!isUserLoggedIn()){
        header('Location: login.php');
    }

    include_once __DIR__ . '/model/ticket.php';

    $configFile = __DIR__ . '/model/dbconfig.ini';
    try{
        $ticketDatabase = new Search($configFile);
    }catch(Exception $error){
        echo '<h2>' . $error->getMessage() . '<h2>';
    }

    $tickets = [];
    if(isPostRequest()){
        if(isset($_POST['Search'])){
            $id = filter_input(INPUT_GET, 'id');

            $ticketDatabase->searchTicket($id);

            
        }
    }else{
        $id = filter_input(INPUT_POST, 'id');
        $ticketDatabase->deleteTicket($id);
        $tickets = $ticketDatabase->getTickets();
    }

    ?>

<html lang="en">
<head>
  <title>Tickets</title>
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

   <h1>Tickets</h1>
   <p><a href="edit.php?action=add">Add Tickets</a></p>

        <h2>Search</h2>
                <form action="view.php" method="post">
                    <input type="hidden" name="action" value="search" />
                    <label>Search by Case Number:</label>
       <input type="text" name="fieldValue" />
      <button type="submit" name="Search">Search</button>
      
      <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>End User</th>
                <th>Desc</th>
                <th>Assigned to</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
         <?php foreach ($tickets as $row): //loop through the tickets in the DB and display one by one?>
            <tr>
                <td>
  </form>      

                    <form action='view.php' method = 'post'>
                        <input type='hidden' name='id' value=<?php echo $row['id']; ?>>
                        <button type='submit'>delete</a></p>
                    </form>
                </td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['user']; ?></td>
                <td><?php echo $row['description']; ?></td>          
                <td><?php echo $row['owner']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><p><a href="edit.php?action=update&id=<?php echo $row['id']; ?>">update</a></p></td>
            
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>