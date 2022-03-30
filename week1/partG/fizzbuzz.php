<h1>This page displays numbers 0 - 100</h1>
<h2>If the number is a multiple of 2 you'll see the word 'fizz'</h2>
<h2>If the number is a multiple of 3 you'll see the word 'buzz'</h2>
<h2>If the number is a multiple of 2 and 3 you'll see the word 'fizzbuzz'</h2>

<?php



//fizzbuzz function

function fizzBuzz($num){
    //prints 'fizz' if num is multiple of 2
    if($num%2 == false){
        echo 'fizz';
    }
    //prints 'buzz' if num is multiple of 3
    if($num%3 == false){
        echo 'buzz';
    }
    //prints 'fizzbuzz' if num is multiple of 2 AND 3
    //if ($num%2 == false and $num%3 == false){
      //  echo 'fizzbuzz';
    //}

}
?>

<?php
//for loop that will call fizzbuzz function
for ($random = 0; $random <= 100; $random++){
    echo '//'.$random.'//';
    fizzBuzz($random);
}
?>