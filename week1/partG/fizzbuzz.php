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


//for loop that will call fizzbuzz function
for ($random = 0; $random <= 100; $random++){
    $numbers = ['number' => random];
    echo $numbers;
    fizzBuzz($random);

}
