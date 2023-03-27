<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品購入チェック</title>
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

    try {

        $member_code = $_SESSION["member_code"];
        $cart = $_SESSION["cart"];
        $kazu = $_SESSION["kazu"];
        $max = count($kazu);

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

        $sql = "SELECT name, email, address, tel FROM member WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $member_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        print "下記内容でよろしいでしょうか？<br><br>";
        print "【宛先】<br>";
        print "お名前:" . $rec['name'] . "様<br>";
        print "mail:" . $rec['email'] . "<br>";
        print "ご住所:" . $rec['address'] . "<br>";
        print "ご連絡先:" . $rec['tel'] . "<br><br>";
        $name = $rec["name"];
        $email = $rec["email"];
        $address = $rec["address"];
        $tel = $rec["tel"];

        print "【ご注文内容】<br>";
        for ($i = 0; $i < $max; $i++) {
            $sql = "SELECT name, price, gazou FROM mst_product WHERE code=?";
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $cart[$i];
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($rec["gazou"]) === true) {
                $disp_gazou = "";
            } else {
                $disp_gazou = "<img src='../product/gazou/" . $rec['gazou'] . "'>";
            }
            print "<div class='box'>";
            print "<div class='list'>";
            print "<div class='img'>";
            print $disp_gazou;
            print "</div>";
            print "<div class='npe'>";
            print "商品名:" . $rec['name'] . "<br>";
            print "価格:" . $rec['price'] . "円　<br>";
            print "数量:" . $kazu[$i] . "<br>";
            print "合計価格:" . $rec['price'] * $kazu[$i] . "円<br><br>";
            $goukei[] = $rec['price'] * $kazu[$i];
            print "</div></div></div><br>";
        }
        $dbh = null;
        print "【ご請求金額】---" . array_sum($goukei) . "円<br><br>";
        print "<form action='shop_form_done.php' method='post'>";
        print "<input type='hidden' name='name' value='" . $name . "'>";
        print "<input type='hidden' name='email' value='" . $email . "'>";
        print "<input type='hidden' name='address' value='" . $address . "'>";
        print "<input type='hidden' name='tel' value='" . $tel . "'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'>";
        print "</form>";
    } catch (Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    }
    ?>

    <?php include '../include/script.html'; ?>
</body>

</html>