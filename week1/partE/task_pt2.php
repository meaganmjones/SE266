<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
<!--Task Array-->
    <?php 
        $tasks = [
            'title' => 'Grocery Shop',
            'due' => 'Wednesday',
            'assignedTo' => 'Rebecca',
            'completed' => false
        ];

    ?>

<!--start of HTML stuff-->
    <h1>To Dos</h1>

    <ul>
        <!--Each li tag individually prints the needed array value and prints a different string as the key-->
            <li><strong>Title: </strong>  <?= $tasks['title']; ?></li>

            <li><strong>Due Date: </strong>  <?= $tasks['due']; ?></li>

            <li><strong>Assigned To:</strong>  <?= $tasks['assignedTo']; ?></li>

            <li><strong>Done:</strong>
            <!--This is to read the boolean from the array and display results accordingly-->
              <?php
              if ($tasks['completed']) {
                  echo 'Yes';
              }else{
                  echo 'No';
              }
             ?>
        
    </ul>

    
    </body>
</html>