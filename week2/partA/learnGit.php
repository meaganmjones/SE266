<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css"/>
    <title>Learn Git</title>
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
    <a class="nav-link" href="#">Meagan's Hobbies</a>
  </li>

</ul>
<h2>Learn GitHub: </h2>
        <li><a href="https://lab.github.com/githubtraining/introduction-to-github">Github Training</a></li>
        <li><a href="https://www.youtube.com/watch?v=nhNq2kIvi9s">YouTube Tutorial</a></li>
        <li><a href="https://www.codecademy.com/learn/learn-git">Code Acedemy</a></li>


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