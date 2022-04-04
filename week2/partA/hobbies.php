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

<h2>Meagan's Hobbies</h2>
        <li><a href="https://www.nxlpaintball.com/">Paintball</a></li>
        <li><a href="https://www.corsair.com/us/en/build-your-gaming-pc?gclid=CjwKCAjwrqqSBhBbEiwAlQeqGj-jhO1ZX_XxjpnVJOyq0l2j0qICpCfKDQs7yaSHnR2Fpvg4kH__hRoCs9IQAvD_BwE">PC Building</a></li>
        <li><a href="#">Nothing</a></li>


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