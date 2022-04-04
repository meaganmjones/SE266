<?php

//here's the list we will dump
$games = ['Minecraft', 'Tetris', 'Pokemon'];

//die and dump function
//dumps string info out and dies
function dd($temp){
    echo '<pre>';
    die(var_dump($temp));
    echo '</pre>';
}


//call dd function for games array
dd($games);

