<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(-1);
require_once("funcs/funcs.php");
session_start();
if (isset($_COOKIE["login"]) and isset($_COOKIE["password"]) and isset($_COOKIE["email"])) {
    $result = select("{$_COOKIE["login"]}", "{$_COOKIE["email"]}", "{$_COOKIE["password"]}");
    if ($result->num_rows > 0) {
        $_SESSION["user_data"] = [
            "login" => "{$_COOKIE["login"]}",
            "email" => "{$_COOKIE["email"]}",
            "password" => "{$_COOKIE["password"]}",
            "id" => "{$_COOKIE["id"]}"
        ];
        header("Location: secret/main.php");
        die;
    }else{
        session_destroy();
        setcookie("login", "", time()-0, "/", "test.kz", false, true);
        setcookie("password", "", time()-0, "/", "test.kz", false, true);
        setcookie("email", "", time()-0, "/", "test.kz", false, true);
        setcookie("id", "", time()-0, "/", "test.kz", false, true);
        header("Location: index.php");
        die;
    }
}elseif(!empty($_POST["login"])) {
    $result = select("{$_POST["login"]}", "{$_POST["email"]}", "{$_POST["password"]}");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            setcookie("login", "{$row["login"]}", time() + 3600 * 24 * 7, "/", "test.kz", false, true);
            setcookie("password", "{$row["password"]}", time() + 3600 * 24 * 7, "/", "test.kz", false, true);
            setcookie("email", "{$row["email"]}", time() + 3600 * 24 * 7, "/", "test.kz", false, true);
            setcookie("id", "{$row["id"]}", time() + 3600 * 24 * 7, "/", "test.kz", false, true);
            $_SESSION["user_data"] = [
                "login" => "{$row["login"]}",
                "email" => "{$row["email"]}",
                "password" => "{$row["password"]}",
                "id" => "{$row["id"]}"
            ];
        }
        header("Location: secret/main.php");
        die;
    } else {
        $_SESSION["res"] = "Incorect login";
        header("Location: index.php");
        die;
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
    <title>login</title>
</head>

<body>
    <?php if (isset($_SESSION["res"])): ?>
        <h3 id="auto">
            <?php echo $_SESSION["res"];
            unset($_SESSION["res"]); ?>
        </h3>
    <?php endif; ?>
    <h1>login</h1>
    <div class="form-panel">
        <form action="" method="post">
            <input type="text" name="login" placeholder="login" required>
            <br><br>
            <input type="password" name="password" placeholder="password" required>
            <br><br>
            <input type="email" name="email" pattern=".+@gmail\.com" size="30" placeholder="email" required />
            <br><br>
            <button type="submit" name="send" value="true">
                <p>login</p>
            </button>
            <a href="index_2.php"><button class="btn-reg" type="button">Registraion</button></a>
        </form>
        <br><br>
    </div>
</body>

</html>