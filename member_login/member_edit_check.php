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

    ?>
    <div class="container">
        <div class="mb-3">
            <?php print $name; ?> さんの情報を修正します。
        </div>

        <div class="bg-light p-3 mb-3">
            <?php if (empty($name) === true) : ?>
                <div class="text-danger mb-3">
                    名前が入力されていません。
                </div>
            <?php else : ?>
                <div class="mb-3">
                    登録名: <?php print $name; ?>
                </div>
            <?php endif; ?>

            <?php if (empty($email) === true) : ?>
                <div class="text-danger mb-3">
                    メールアドレスが入力されていません。
                </div>
            <?php else : ?>
                <div class="mb-3">
                    メールアドレス: <?php print $email; ?>
                </div>
            <?php endif; ?>

            <?php if (empty($address) === true) : ?>
                <div class="text-danger mb-3">
                    住所が入力されていません。
                </div>
            <?php else : ?>
                <div class="mb-3">
                    住所: <?php print $address; ?>
                </div>
            <?php endif; ?>

            <?php if (empty($tel) === true) : ?>
                <div class="text-danger">
                    電話番号が入力されていません。 </div>
            <?php else : ?>
                <div>
                    電話番号: <?php print $tel; ?>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <?php if (empty($name)) : ?>
                <form>
                    <button type="button" class="btn btn-outline-secondary" onclick="history.back()">戻る</button>
                </form>
            <?php else : ?>
                <div class="mb-3">
                    上記の通り修正しますか？
                </div>
                <form action='member_edit_done.php' method='post'>
                    <input type='hidden' name='name' value='<?php print $name; ?>'>
                    <input type='hidden' name='email' value='<?php print $email; ?>'>
                    <input type='hidden' name='address' value='<?php print $address; ?>'>
                    <input type='hidden' name='tel' value='<?php print $tel; ?>'>
                    <input type='hidden' name='code' value='<?php print $code; ?>'>
                    <button type="button" class="btn btn-outline-secondary" onclick="history.back()">戻る</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    <?php endif; ?>
    </div>

    <?php include '../include/script.html'; ?>
</body>

</html>