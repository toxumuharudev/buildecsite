<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン入力</title>
    <?php include '../include/bootstrap.html' ?>
</head>

<?php
session_start();
session_regenerate_id(true);
?>

<body>
    <!-- header -->
    <?php include '../common_view/header.php'; ?>

    <div class="container mb-3">
        <div class="mb-5">
            会員情報を入力してください。
        </div>

        <form action="member_login_check.php" method="post">
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label class="form-label">パスワード</label>
                <input type="password" class="form-control" name="pass">
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-outline-secondary" onclick="history.back()">戻る</button>
                <!-- <input class="btn btn-primary" type="button" value="Submit"> -->
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
            <div class="mb-3">
                会員情報が未登録の方はこちらから登録をお願いします。
                <a href="./member_login_db.php">会員登録画面へ</a>
            </div>
        </form>
    </div>

    <?php include '../include/script.html'; ?>
</body>

</html>