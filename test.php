<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include './include/bootstrap.html';
    ?>

    <title>EC サイト test</title>
</head>

<body>
    <div class="dropdown">
        <button id="btnOpenMenu" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            メニューを開く
        </button>
        <div class="dropdown-menu" aria-labelledby="btnOpenMenu">
            <button class="dropdown-item" type="button">メニュー1</a>
                <button class="dropdown-item" type="button">メニュー2</a>
                    <button class="dropdown-item" type="button">メニュー3</a>
        </div>
    </div>

    <?php
    include './include/script.html';
    ?>
</body>