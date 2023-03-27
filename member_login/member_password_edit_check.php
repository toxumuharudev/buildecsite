<?php
session_start();
session_regenerate_id(true);

$member_code = $_SESSION["member_code"];
$current_pass = $_POST["current_pass"];
$pass = $_POST["pass"];
$pass2 = $_POST["pass2"];

try {

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

    $sql = "SELECT password FROM member WHERE code=?";
    $stmt = $dbh->prepare($sql);
    $data[] = $member_code;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff/staff_login.php'>ログイン画面へ</a>";
}

if (md5($current_pass) != $rec["password"]) {
    $_SESSION["wrong_current_password"] = true;
    header("Location:member_password_edit.php");
    exit();
} else if ($pass != $pass2) {
    $_SESSION["different_new_password"] = true;
    header("Location:member_password_edit.php");
    exit();
} else {
    $_SESSION["pass"] = md5($pass);
    header("Location:member_password_edit_done.php");
    exit();
}
?>
<!--  -->