<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン入力</title>
    <?php include '../include/bootstrap.html' ?>
</head>

<body>

    スタッフログイン<br><br>
    <form action="staff_login_check.php" method="post">

        テスト用スタッフコード: 13<br>
        テスト用パスワード: a<br><br>

        スタッフコード<br>
        <input type="text" name="code" value="13">
        <br><br>
        パスワード<br>
        <input type="password" name="pass" value="a">
        <br><br>
        <input type="submit" value="OK">

    </form>


</body>

</html>