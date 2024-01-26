<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(-1);
require_once("funcs/funcs.php");
session_start();
if(isset($_POST["send"])){
    $result = select("{$_POST["login"]}", "{$_POST["email"]}", "{$_POST["password"]}");
    if($result -> num_rows == 0){
        insert($_POST["login"], $_POST["email"], $_POST["password"]);
        $_SESSION["res"] = "Вы зарегестрировались";
        header("Location: index_2.php");
        die;
    }else{
        $_SESSION["res"] = "Такой пользователь уже зарегестрирован";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <title>Registraion</title>
</head>
<body>
    <?php if(isset($_SESSION["res"])): ?>
        <h3 id="reg"><?php echo $_SESSION["res"]; unset($_SESSION["res"]);?></h3>
    <?php endif; ?>
    <h1>Registraion</h1>
    <form action="" method="post">
        <input type="text" name="login" placeholder="login" required>
        <br><br>
        <input type="password" name="password" placeholder="password" required>
        <br><br>
        <input type="email" name="email" pattern=".+@gmail\.com" size="30" placeholder="email" required />
        <br><br>
        <button type="submit" name="send" value="true"><p>Registraion</p></button>
        <a href="index.php"><button class="btn-reg" type="button">login</button></a>
    </form>
    <br><br>
</body>
</html>