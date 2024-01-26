<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(-1);
session_start();
require_once("../funcs/funcs.php");
require_once("../funcs/DataBase.php");
if(!isset($_SESSION["user_data"])){
    header("Refresh: 2; url=../index.php"); 
    die("<h1 class='d-auto'>You are not logged in</h1>");
}
if(isset($_GET["restart"])){
    header("Location: main.php");
    die;
}
$sort = null;
if(isset($_GET["sort"]) and $_GET["sort"] == "ASC"){
    $sort = $_GET["sort"];
}else{
    $sort = "DESC";
}
$sort_html = null;
if(isset($_GET["sort"]) and $_GET["sort"] == "ASC"){
    $sort_html = "selected";
}
$comments = select_all_comments($sort);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/main.css">
    <title>All Comments</title>
</head>
<body>
<nav>
    <a href="main.php?restart=true">Main</a>
    <a href="send_comm.php">Send comment</a>
</nav>
<div class="main-win">
    <h1>All Comments:</h1>
    <form action="" method="get">
        <select class="sort-select" name="sort">
            <option value="DESC">NEW</option>
            <option value="ASC" <?= $sort_html?> >Old</option>
        </select>
        <button class="sub-btn" type="submit">Check</button>
    </form>
    <div class="comments">
        <? $i=1;?>
        <? if(isset($comments)): ?>
            <? foreach($comments as $comment): ?>
                <div class="comment">
                    <p class="login"><b><i>----<?="{$comment["login"]}";?></i></b></p>
                    <p><?= nl2br(htmlspecialchars($comment["text"])); ?></p>
                    <? $i++;?>
                </div>
            <? endforeach; ?>
        <? endif; ?>        
    </div>
</div>
</body>
</html>