<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(-1);
require_once("../funcs/funcs.php");
require_once("../funcs/DataBase.php");
session_start();
if(isset($_GET["do"]) and $_GET["do"] == "exit"){
    session_destroy();
    setcookie("login", "", time()-0, "/", "test.kz", false, true);
    setcookie("password", "", time()-0, "/", "test.kz", false, true);
    setcookie("email", "", time()-0, "/", "test.kz", false, true);
    setcookie("id", "", time()-0, "/", "test.kz", false, true);
}
if(!isset($_SESSION["user_data"])){
    header("Refresh: 2; url=../index.php"); 
    die("<h1>You are not logged in</h1>
    <style>
        body{
            background-color: darkslategray;
            color: grey;
        }
    </style>
    ");
}
if(isset($_POST["send"])){
    if(!empty($_POST["text"])){
        clear();
        insert_comment($_SESSION["user_data"]["id"], $_POST["text"]);
    }
    header("Location: send_comm.php");
    die;
}
$comments = select_my_comment("{$_SESSION["user_data"]["id"]}");
if(isset($_GET["delete_comm"])){
    delete_comment("{$_GET["delete_comm"]}");
    header("Location: send_comm.php");
    die;
}
if(isset($_GET["delete_all_comm"])){
    delete_all_comments("{$_GET["delete_all_comm"]}");
    header("Location: send_comm.php");
    die;
}
if(isset($_GET["restart"])){
    header("Location: send_comm.php");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/send_comm.css">
    <title>Send comment</title>
</head>
<body>
    <nav>
        <a href="main.php">Main</a>
        <a href="send_comm.php?restart=true">Send Comment</a>
    </nav>
    <div class="main-win">
        <h1><?= "Send a comment " . "{$_SESSION["user_data"]["login"]}"?></h1>
        <a href="send_comm.php?do=exit">
            <button class="logout" type="button">logout</button>
            <?if(isset($_GET["do"]) and $_GET["do"] == "exit"):?>
                <?header("Location: send_comm.php?do=exit");?>
            <? endif; ?>
        </a>
        <br><br>
        <form action="" method="post">
            <textarea name="text" cols="30" rows="5"></textarea>
            <br>
            <button class="send-btn" type="submit" name="send" value="true"><p>SEND</p></button>
        </form>
        <br>
        <? echo "<a href='send_comm.php?delete_all_comm={$_SESSION["user_data"]["id"]}'>
            <button class='delete-all-comments' type='button'>Delete all comments</button>
        </a>"?>
        <br>
        <h2>Your comments:</h2>
        <? $i  = 1;?>
        <? if(isset($comments)): ?>
            <? foreach($comments as $comment): ?>
                <div class="massage">
                    <p><?="$i) {$comment["date"]}";?></p>
                    <p><?= nl2br(htmlspecialchars($comment["text"])); ?></p>
                    <? echo "<a href='send_comm.php?delete_comm={$comment["id"]}'>
                        <button class='comm-delete' type='button'>Delete comment</button>
                    </a>"?>
                    <? $i++;?>
                </div>
            <? endforeach; ?>
        <? endif; ?>
    </div>
</body>
</html>