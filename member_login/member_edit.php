<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/bootstrap.html' ?>
    <title>アカウント情報修正画面</title>
</head>

<?php
session_start();
session_regenerate_id(true);
?>

<body>
    <?php
    // header
    include '../common_view/header.php';

    try {
        $member_code = $_SESSION["member_code"];

        // azure database login
        $azure_mysql_connstr = $_SERVER["MYSQLCONNSTR_localdb"];
        $azure_mysql_connstr_match = preg_match(
            "/" .
                "Database=(?<database>.+);" .
                "Data Source=(?<datasource>.+);" .
                "User Id=(?<userid>.+);" .
                "Password=(?<password>.+)" .
                "/u",
            $azure_mysql_connstr,
            $_
        );

        $dsn = "mysql:host={$_["datasource"]};dbname=shop;charset=utf8";
        $user = $_["userid"];
        $password = $_["password"];

        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT code, name, email, address, tel FROM member WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $member_code;
        $stmt->execute($data);

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff/staff_login.php'>ログイン画面へ</a>";
    }
    ?>

    登録情報を修正します。
    <br><br>
    <form action="member_edit_check.php" method="post" enctype="multipart/form-data">
        <?php require_once("../common./common.php"); ?>
        お名前<br>
        <input type="text" name="name" value="<?php print $rec['name']; ?>">
        <br><br>
        email<br>
        <input type="text" name="email" value="<?php print $rec['email']; ?>">
        <br><br>
        住所<br>
        <input type="text" name="address" value="<?php print $rec['address']; ?>">
        <br><br>
        tel<br>
        <input type="text" name="tel" value="<?php print $rec['tel']; ?>">
        <br><br>
        パスワード<br>
        <input type="password" name="pass">
        <br><br>
        パスワード再入力<br>
        <input type="password" name="pass2">
        <br><br>
        <input type="hidden" name="code" value="<?php print $rec['code']; ?>">
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>

    <?php include '../include/script.html'; ?>
</body>

</html>