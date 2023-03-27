<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/bootstrap.html' ?>
    <title>アカウント情報修正登録</title>
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
        require_once("../common/common.php");

        $post = sanitize($_POST);
        $code = $post["code"];
        $name = $post["name"];
        $email = $post["email"];
        $address = $post["address"];
        $tel = $post["tel"];
        $pass = $post["pass"];

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

        $sql = "UPDATE member SET name=?, email=?, address=?, tel=?, password=? WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $name;
        $data[] = $email;
        $data[] = $address;
        $data[] = $tel;
        $data[] = $pass;
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        print $e->getMessage();
        print "<br>";
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff/staff_login.php'>ログイン画面へ</a>";
    }
    ?>

    修正完了しました。<br><br>
    <a href="../shop/shop_list.php">TOPへ</a>

    <?php include '../include/script.html'; ?>
</body>

</html>