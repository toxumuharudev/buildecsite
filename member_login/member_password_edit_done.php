<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/bootstrap.html' ?>
    <title>パスワード変更完了</title>
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
        $pass = $_SESSION["pass"];
        $code = $_SESSION["member_code"];

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

        $sql = "UPDATE member SET password=? WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $pass;
        $data[] = $code;

        $stmt->execute($data);
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;
    } catch (Exception $e) {
        print $e->getMessage();
        print "<br>";
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff/staff_login.php'>ログイン画面へ</a>";
    }

    ?>

    <div class="container">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check text-success" viewBox="0 0 16 16">
                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
            </svg>
            修正完了しました。
        </div>
        <div class="align-self-center p-2">
            <a href="../shop/shop_list.php" class="btn btn-primary" role="button">TOPへ</a>
        </div>
    </div>

    <?php include '../include/script.html'; ?>
</body>

</html>