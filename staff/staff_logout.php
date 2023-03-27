<?php

session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()]) === true) {
    setcookie(session_name(), "", time() - 42000, "/");
}
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>
    <?php include '../include/bootstrap.html' ?>
</head>

<body>

    ログアウトしました。<br><br>
    <a href="staff_login.php">ログイン画面へ</a>

</body>

</html>