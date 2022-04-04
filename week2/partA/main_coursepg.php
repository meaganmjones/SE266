<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css"/>
    <title>PHP Course</title>
</head>
<body>
<ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="main_coursepg.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="https://github.com/meaganmjones/SE266">GitHub Repo</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="learnGit.php">Learn Git</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="hobbies.php">Meagan's Hobbies</a>
  </li>

</ul>
    
    <h1>Meagan Jones' PHP Course</h1>

    <h2>PHP Assignments</h2>
        <li>Week 1 - <a href="http://localhost/se266/se266-1/week1/partG/fizzbuzz.php">FizzBuzz</a></li>
        <li>Week 2 - <a href="http://localhost/se266/se266-1/week2/partB/dr_intake.php">Intake Form</a></li>
        <li>Week 3</li>
        <li>Week 4</li>
        <li>Week 5</li>
        <li>Week 6</li>
        <li>Week 7</li>
        <li>Week 8</li>
        <li>Week 9</li>
        <li>Week 10</li>

<footer class="modal-footer">

<?php       
        $file = basename($_SERVER['PHP_SELF']);
        $mod_date=date("F d Y h:i:s A", filemtime($file));
        echo "File last updated $mod_date ";
        //date.timezone = "Europe/Athens"
    ?>

</footer>
</body>
</html>