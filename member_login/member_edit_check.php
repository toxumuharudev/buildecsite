<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/bootstrap.html' ?>
    <title>アカウント情報修正チェック</title>
    <?php include '../include/bootstrap.html' ?>
</head>

<?php
session_start();
session_regenerate_id(true);
?>



<body>
    <?php
    // header
    include '../common_view/header.php';

    require_once("../common/common.php");

    $post = sanitize($_POST);
    $code = $post["code"];
    $name = $post["name"];
    $email = $post["email"];
    $address = $post["address"];
    $tel = $post["tel"];
    $pass = $post["pass"];
    $pass2 = $post["pass2"];

    print $name;
    print " さんの情報を修正します。";
    print "<br><br>";

    if (empty($name) === true) {
        print "名前が入力されていません。<br><br>";
    } else {
        print "登録名:";
        print $name;
        print "<br><br>";
    }

    if (empty($email) === true) {
        print "メールアドレスが入力されていません。<br><br>";
    } else {
        print "メールアドレス:";
        print $email;
        print "<br><br>";
    }

    if (empty($address) === true) {
        print "住所が入力されていません。<br><br>";
    } else {
        print "住所:";
        print $address;
        print "<br><br>";
    }

    if (empty($tel) === true) {
        print "電話番号が入力されていません。<br><br>";
    } else {
        print "電話番号:";
        print $tel;
        print "<br><br>";
    }

    if (empty($pass) === true) {
        print "パスワードが入力されていません。<br><br>";
    }

    if ($pass != $pass2) {
        print "パスワードが異なります。<br><br>";
    }

    if (empty($name) or empty($pass) or $pass != $pass2) {
        print "<form>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "</form>";
    } else {
        $pass = md5($pass);
        print "上記の通り修正しますか？<br><br>";
        print "<form action='member_edit_done.php' method='post'>";
        print "<input type='hidden' name='name' value='" . $name . "'>";
        print "<input type='hidden' name='email' value='" . $email . "'>";
        print "<input type='hidden' name='address' value='" . $address . "'>";
        print "<input type='hidden' name='tel' value='" . $tel . "'>";
        print "<input type='hidden' name='pass' value='" . $pass . "'>";
        print "<input type='hidden' name='code' value='" . $code . "'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'>";
        print "</form>";
    }
    ?>

    <?php include '../include/script.html'; ?>
</body>

</html>