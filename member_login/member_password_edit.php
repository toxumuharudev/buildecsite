<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/bootstrap.html' ?>
    <title>パスワード修正画面</title>

    <style>
        form i {
            margin-left: -30px;
            cursor: pointer;
        }
    </style>

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




        if (isset($_SESSION["different_new_password"])) {
            if (($_SESSION["different_new_password"]) == true) {
                $different_new_password = $_SESSION["different_new_password"];
            }
        } else {
            unset($_SESSION["different_new_password"]);
        }



        // print "member_code: $member_code";
        // print "wrong_current_password: $wrong_current_password";
        // print "different_new_password: $different_new_password";

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

    <div class="container">
        <div class="mb-5">
            <h3>
                パスワードの変更
            </h3>
        </div>

        <div class="mb-3">
            <form action="member_password_edit_check.php" method="post" enctype="multipart/form-data">
                <?php require_once("../common./common.php"); ?>

                <div class="mb-3">
                    <label class="form-label">現在のパスワード</label>
                    <input type="password" class="form-control" name="current_pass">
                    <?php
                    if (isset($_SESSION["wrong_current_password"])) {
                        if (($_SESSION["wrong_current_password"]) == true) {
                            print '<label class="text-danger">現在のパスワードが一致しません。</label>';
                        }
                        unset($_SESSION["wrong_current_password"]);
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">新しいパスワード</label>
                    <input type="password" class="form-control" name="pass">
                </div>
                <div class="mb-3">
                    <label class="form-label">新しいパスワード再入力</label>
                    <input type="password" class="form-control" name="pass2">
                    <?php
                    if (isset($_SESSION["different_new_password"])) {
                        if (($_SESSION["different_new_password"]) == true) {
                            print '<label class="text-danger">現在のパスワードが一致しません。</label>';
                        }
                        unset($_SESSION["different_new_password"]);
                    }
                    ?>
                </div>

                <div class="form-group">
                    <div class="invalid-feedback" style="width: 100%">
                        パスワードを正しいフォーム（数字、小か大文字を含む8文字以上）で入力してください
                    </div>
                </div>




                <!-- <div class="mb-3">
                    <label class="form-label">現在のパスワード</label>
                    <input type="password" class="form-control" id="password" name="current_pass">
                    <div class="ml-2">
                        <label for="password_check">
                            <input type="checkbox" id="password_check" />
                            パスワードを表示する</label>
                    </div>
                </div> -->

                <div class="mb-3">
                    <input type="hidden" name="code" value="<?php print $rec['code']; ?>">
                    <button type="button" class="btn btn-outline-secondary" onclick="history.back()">戻る</button>
                    <!-- <input type="submit" value="OK"> -->
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../include/script.html'; ?>
</body>

</html>