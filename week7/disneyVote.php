<?php

include_once(__DIR__.'\model\model_disney.php');

//if content type set + get rid of extra spaces
$content = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

//if its JSON:
if($content === 'application/json'){
    $content = trim(file_get_contents('php://input'));

    $decode = json_decode($content, true);

    $configFile = __DIR__.'\model\dbconfig.ini';

    $table = new Votes($configFile);

    $votesReturn = $table->insertVote($decode['disneycharID']);

    echo json_encode($votesReturn);
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='vote.css' />
</head>
<body>
        <div class='main'>
            <div class='char'>
                <h3>Cinderella</h3>
                <img class='img' src=#>
                <button id='cinderella' type='submit'>Vote for Cinderella</button>
                <div>
                    <h4 id='cinderella-votes'><?php echo $votes['cinderella'] ?></h4>
                </div>
            </div>
            <div class='char'>
                <h3>Mulan</h3>
                <img class='img' src=#>
                <button name='mulan' type='submit'>Vote for Mulan</button>
            </div>
            <div class='char'>
                <h3>Snow White</h3>
                <img class='img' src=#>
                <button name='snow' type='submit'>Vote for Snow White</button>
            </div>
        </div>
    </form>
    
</body>

<script>
    var cinderella = getElementById('cinderella');

</script>
</html>