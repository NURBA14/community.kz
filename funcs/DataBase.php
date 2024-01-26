<?php
require_once("funcs.php");
$db = new mysqli("localhost", "root", "", 'form');
$db -> set_charset("utf8") or die("indefined charset");
if(isset($db->connect_error)){
    die($db->connect_error);
}
function clear(){
    global $db;
    foreach($_POST as $key => $value){
        $_POST[$key] = $db->real_escape_string($value);
    }
}
function insert_comment($user_id, $text){
    global $db;
    $insert = "INSERT INTO `user_comment` (`user_id`, `text`) VALUES ('{$user_id}', '{$text}')";
    $result = $db -> query($insert);
    return($result);
}
function select_my_comment($user_id){
    global $db;
    $select = "SELECT user_comment.id, user_id, text, date, users_data.login FROM 
    user_comment, users_data WHERE `user_id` = users_data.id AND `user_id` = {$user_id} ORDER BY `id` DESC;";
    $result = $db -> query($select);
    if(isset($result) and $result-> num_rows > 0){
        $data = [];
        while($row = $result->fetch_assoc()){
            $data[$row["id"]] = $row;
        }
    }
    if(isset($data)){
        return $data;
    }
}
function delete_comment($id){
    global $db;
    $delete_comm = "DELETE FROM `user_comment` WHERE `id` = {$id}";
    $result = $db -> query($delete_comm);
}
function delete_all_comments($user_id){
    global $db;
    $delete = "DELETE FROM `user_comment` WHERE `user_id` = {$user_id};";
    $result = $db -> query($delete);
}
function select_all_comments($sort = "DESC"){
    global $db;
    $select = "SELECT 
	user_comment.id, 
    user_comment.user_id, 
    user_comment.text, 
    user_comment.date, 
    users_data.login FROM user_comment, users_data WHERE user_comment.user_id = users_data.id ORDER BY `id` {$sort};";
    $result = $db -> query($select);
    if(($result-> num_rows) > 0){
        $data = [];
        while($row = $result->fetch_assoc()){
            $data[$row["id"]] = $row;
        }
    }
    if(isset($data)){
        return $data;
    }
}
?>