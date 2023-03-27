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

    <div class="container mb-3">
        <div class="mb-5">
            <h3>
                アカウント情報の修正
            </h3>
        </div>

        <form action="member_edit_check.php" method="post" enctype="multipart/form-data">
            <?php require_once("../common./common.php"); ?>

            <div class="mb-3">
                <label class="form-label">お名前</label>
                <input type="text" class="form-control" name="name" value="<?php print $rec['name']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" value="<?php print $rec['email']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">住所</label>
                <input type="text" class="form-control" name="address" value="<?php print $rec['address']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">TEL</label>
                <input type="text" class="form-control" name="tel" value="<?php print $rec['tel']; ?>">
            </div>

            <input type="hidden" name="code" value="<?php print $rec['code']; ?>">
            <div class="mb-3">
                <button type="button" class="btn btn-outline-secondary" onclick="history.back()">戻る</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <!-- 
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK"> -->
        </form>
    </div>

    <?php include '../include/script.html'; ?>
</body>

</html>