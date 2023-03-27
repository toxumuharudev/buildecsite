<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カートに追加</title>
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

    $code = $_GET["code"];

    if (isset($_SESSION["cart"]) === true) {
        $cart = $_SESSION["cart"];
        $kazu = $_SESSION["kazu"];
        if (in_array($code, $cart) === true) {
            print "すでにカートにあります。<br><br>";
            print "<a href='shop_list.php'>商品一覧へ戻る</a>";
        }
    }
    if (empty($_SESSION["cart"]) === true or in_array($code, $cart) === false) {
        $cart[] = $code;
        $kazu[] = 1;
        $_SESSION["cart"] = $cart;
        $_SESSION["kazu"] = $kazu;

        print "カートに追加しました。<br><br>";
        print "<a href='shop_list.php'>商品一覧へ戻る</a>";
    }

    ?>
    <br><br>

    <?php include '../include/script.html'; ?>
</body>

</html>