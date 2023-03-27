<header>
    <?php
    if (isset($_SESSION["member_login"]) === true) :
        $name = $_SESSION["member_name"];
    ?>
        <div class="d-flex p-2 mb-2 bg-primary text-white">
            <div class="flex-grow-1 align-self-center p-2">
                ようこそ
                <?php print $_SESSION["member_name"]; ?>
                様
            </div>

            <!-- ❗️ imprementing -->
            <div class="dropdown p-2">
                <button id="btnOpenMenu" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    会員メニュー
                </button>
                <div class="dropdown-menu" aria-labelledby="btnOpenMenu">
                    <a class="dropdown-item" type="button" href="../member_login/member_edit.php">アカウント情報修正</a>
                    <!-- <button class="dropdown-item" type="button">メニュー2</button>
                    <button class="dropdown-item" type="button">メニュー3</button> -->
                </div>
            </div>

            <!-- <div class="align-self-center p-2 text-white">
                <a href="../member_login/member_edit.php" class="link-light">アカウント情報修正</a>
            </div> -->

            <div class="align-self-center p-2">
                <a href="../member_login/member_logout.php" class="btn btn-light" role="button">ログアウト</a>
            </div>
        </div>

    <?php else : ?>
        <div class="d-flex p-2 mb-2 bg-secondary text-white">
            <div class="flex-grow-1 align-self-center p-2">
                EC サイトへようこそ！ログインしてご注文下さい。
            </div>

            <div class="align-self-center p-2">
                <a href="../member_login/member_login_db.php" class="link-light">新規会員登録</a>
            </div>

            <div class="align-self-center p-2">
                <a class="btn btn-light" href="../member_login/member_login.php" role="button">ログイン</a>
            </div>

        </div>
    <?php endif; ?>


    <?php
    // if (isset($_SESSION["member_login"]) === true) {
    //     print '<div class="d-flex p-2 mb-2 bg-primary text-white">';

    //     print '<div class="flex-grow-1 align-self-center p-2">';
    //     print "ようこそ ";
    //     print $_SESSION["member_name"];
    //     print " 様";
    //     print '</div>'; // print '<div flex-grow-1>';

    //     print '<div class="align-self-center p-2">';
    //     print '<a href="../member_login/member_edit.php" class="link-light">アカウント情報修正</a>';
    //     print '</div>';

    //     print '<div class="align-self-center p-2">';
    //     print '<a href="../member_login/member_logout.php" class="btn btn-light" role="button">ログアウト</a>';
    //     print '</div>'; // print '<div class="text-right">';

    //     print '</div>'; // '<div class="d-flex p-3 mb-2 bg-primary text-white">';
    // } else {
    //     print '<div class="d-flex p-2 mb-2 bg-secondary text-white">';

    //     print '<div class="flex-grow-1 align-self-center p-2">';
    //     print "EC サイトへようこそ！ログインしてご注文下さい。";
    //     print '</div>';

    //     print '<div class="align-self-center p-2">';
    //     print '<a href="../member_login/member_login_db.php" class="link-light">新規会員登録</a>';
    //     print '</div>';

    //     print '<div class="align-self-center p-2">';
    //     print '<a class="btn btn-light" href="../member_login/member_login.php" role="button">ログイン</a>';
    //     print '</div>';

    //     print '</div>';
    // }
    ?>
</header>