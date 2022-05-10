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
        <li>Week 1 - <a href="https://jonesse-266.herokuapp.com/week1/partG/fizzbuzz.php">FizzBuzz</a></li>
        <li>Week 2 - <a href="https://jonesse-266.herokuapp.com/week2/partB/intake_form.php">Intake Form</a></li>
        <li>Week 3 - <a href="https://jonesse-266.herokuapp.com/week3/atm_starter.php">ATM</a></li>
        <li>Week 4 - <a href="https://jonesse-266.herokuapp.com/week4/view.php">Patients part 1</a></li>
        <li>Week 5 - <a href="https://jonesse-266.herokuapp.com/week5/login.php">Patients part 2</a></li>
        <li>Week 6 - <a href="https://jonesse-266.herokuapp.com/week6/schools/login.php">Patients part 2</a></li>
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