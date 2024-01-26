<?php
$db = new mysqli("localhost", "root", "", "form");
function debug($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
function debug_var($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
function select($login, $email, $password){
    global $db;
    $select = "SELECT `id`, `login`, `email`, `password` FROM `users_data` WHERE `login` = '{$login}' AND `email` = '{$email}' AND `password` = '{$password}';";
    $result = $db -> query($select);
    return $result;
}
function insert($login, $email, $password){
    global $db;    
    $insert = "INSERT INTO `users_data`(`login`, `email`, `password`) VALUES ('{$login}', '{$email}', '{$password}')";
    $result = $db -> query($insert);
}
?>