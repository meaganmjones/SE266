<?php

//this file:
  //requires user login
  //is a form to fill out to add/update a ticket
  //determines action from URL
  //will display empty boxes when adding and show ticket info when updating
//####################################################################################


     // Load helper functions (which also starts the session) then check if user is logged in
     include_once __DIR__ . '/include/function.php';
     if (!isUserLoggedIn())
     {
         header ('Location: login.php');
     }
  
  // This code runs everytime the page loads
  include __DIR__ . '/model/search.php';

  //set up config file and create db
  $configFile = __DIR__ . '/model/dbconfig.ini';
  try 
  {
    //use config file to create a new instance of the tickets class
    //store as variable ticketDatabase
      $ticketDatabase = new Tickets($configFile);
  } 
  catch ( Exception $error ) 
  {
      echo "<h2>" . $error->getMessage() . "</h2>";
  }  

  //find out if action sent from view.php was add/update
  if(isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action'); //get action from URL
    $id = filter_input(INPUT_GET, 'id'); //get id from URL
    //if action is update:
    if($action == "update"){
      //call on getOneTicket using id passed in
      $row = $ticketDatabase->getOneTicket($id);
      $title = $row['title'];
      $user = $row['user'];
      $desc = $row['description'];
      $owner = $row['owner'];
      $status = $row['status'];
    }else{ //otherwise set variables in HTML to nothing
        
      $title = '';
      $user = '';
      $desc = '';
      $owner = '';
      $status = '';
    }   
  } //end if GET
  
  //if its post :
  elseif(isset($_POST['action'])){ 
    // grab info from HTML
    echo 'got herrreee';
    $action = filter_input(INPUT_POST, 'action');
    $id = filter_input(INPUT_POST, 'id');
    $title = filter_input(INPUT_POST, 'title');
    $user = filter_input(INPUT_POST, 'user');
    $desc = filter_input(INPUT_POST, 'description');
    $owner = filter_input(INPUT_POST, 'owner');
    $status = filter_input(INPUT_POST, 'status');

    //if action is add:
    if($action == 'add'){
      //run addTicket from Tickets class
      $result = $ticketDatabase->addTicket($title, $user, $description, $owner, $status);
    }elseif($action == 'update'){ //if action is update
      //run updateTickets from Tickets class
      $result = $ticketDatabase->updateTicket($id, $title, $user, $description, $owner, $status);
    }
    header('Location: view.php'); //brings user back to view.php
  }
  else{
    header('Location: view.php');
  }

?>
    
<!-- I stole the following lines from the example gitHub and adjusted as needed -->
<html lang="en">
<head>
  <title>Add Ticket</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
<div class="col-sm-offset-2 col-sm-10"><h3><a href="./view.php">View Ticket</a></h3></div>

  <h1>Add Ticket</h1>


  <!--Section for the first name -->
  <form class="form-horizontal" action="edit.php" method="post">
  <input type='text' id='action' name='action' value=<?php echo $action; ?>><!--created as a spot to store the action data (if there is any) -->
  <input type='text' id='id' name='id' value=<?php echo $id; ?>><!--created as a spot to store the ID data (if there is any) -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="title">Title: </label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="title" placeholder="title" name="title" value=<?php echo $title; ?>>
      </div>
    </div>

    <!--Section for user -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="user">User: </label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="user" placeholder="User" name="user" value=<?php echo $user; ?>>
      </div>
    </div>

    <!--Section for desc -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="desc">Description: </label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="desc" placeholder="description" name="desc" value=<?php echo $desc; ?>>
      </div>
    </div>
<!--Section for owner-->
    <div class="form-group">
      <label class="control-label col-sm-2" for="owner">Assigned to: </label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="owner" placeholder="assigned to" name="desc" value=<?php echo $owner; ?>>
      </div>
    </div>

    <!--Section for married data -->
    <!--How do I fill in the radio buttons using the $married variable? The associated values are what gets imported into the DB, so I don't want to change them -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="status">Status: </label>
      <div class="col-sm-10">  
        <input type="radio" id="html" name="" value=0>
        <label for="html">Active</label><br>
        <input type="radio" id="css" name="married" value=1>
        <label for="css">Closed</label><br>
      </div>
    </div>
    

    <!--Section for add/update button -->
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Ticket</button>
      </div>
    </div>
  </form>
  
</div>

</body>
</html>