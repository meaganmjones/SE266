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
            'title' => 'Grocery Shop'
            'due' => 'Wednesday'
            'assignedTo' => 'Rebecca'
            'completed' => 'No'
        ];

    ?>

    <ul>
        <?php foreach ($tasks as $desc => $info) : ?>
            <li><strong><?= $desc ?></strong><?= $info; ?></li>
            <?php endforeach ?>
    </ul>

    
    </body>
</html>