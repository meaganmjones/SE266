<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

    <?php 
        $tasks = [
            'title' => 'Grocery Shop',
            'due' => 'Wednesday',
            'assignedTo' => 'Rebecca',
            'completed' => false
        ];

    ?>

    <h1>To Dos</h1>

    <ul>
        
            <li><strong>Title: </strong>  <?= $tasks['title']; ?></li>

            <li><strong>Due Date: </strong>  <?= $tasks['due']; ?></li>

            <li><strong>Assigned To:</strong>  <?= $tasks['assignedTo']; ?></li>

            <li><strong>Done:</strong>
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