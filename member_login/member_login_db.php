<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員情報入力画面</title>
    <?php include '../include/bootstrap.html' ?>
</head>

<?php
session_start();
session_regenerate_id(true);
?>

<body>
    <!-- header -->
    <?php include '../common_view/header.php'; ?>

    新規会員登録画面<br><br>

    お名前<br>
    <form action="member_login_db_check.php" method="post">
        <input type="text" name="name">
        <br>
        email<br>
        <input type="text" name="email">
        <br>
        住所<br>
        <input type="text" name="address">
        <br>
        tel<br>
        <input type="text" name="tel">
        <br>
        パスワード<br>
        <input type="password" name="pass">
        <br>
        パスワード再入力<br>
        <input type="password" name="pass2">
        <br><br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        <br><br>

    </form>
    <br><br>

    <?php include '../include/script.html'; ?>
</body>

</html>