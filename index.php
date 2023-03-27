<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include './include/bootstrap.html'
    ?>

    <title>EC サイト index</title>
    <?php include '../include/bootstrap.html' ?>
</head>

<body>
    <!-- <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown button
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div> -->
    <?php
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

    $link = mysqli_connect($_["datasource"], $_["userid"], $_["password"], $_["database"]);

    echo nl2br("リンク集\n");
    echo nl2br("<a href='./staff/staff_login.php'>- 管理者サインイン画面</a>\n");
    echo nl2br("<a href='./shop/shop_list.php'>- ECサイトTOP</a>\n");
    echo nl2br("<a href='./member_login/member_login_db.php'>- 新規ユーザー登録</a>\n");
    echo nl2br("<a href='./member_login/member_login.php'>- ユーザーサインイン画面</a>\n");

    if ($link) {
        $db_selected = mysqli_select_db($link, $_["database"]);

        $sql = "INSERT INTO access (AccessTime) VALUES ('2018-04-17 11:59')";
        $result_flag = mysqli_query($link, $sql);

        if ($result_flag) {
            // echo nl2br("成功しました\n");

            $result = mysqli_query($link, 'SELECT count(*) as count from Access');
            $row = mysqli_fetch_assoc($result);
            // print("アクセス数: ". $row["count"]); 
            // echo nl2br("\n");
        } else {
            die('INSERTクエリーが失敗しました。' . mysqli_error($link));
        }
        // // add test
        // $sql = "SELECT * FROM access";
        // $result = mysqli_query($link, $sql);
        // // 結果を出力
        // $count = 1;
        // while( $row_data = mysqli_fetch_array( $result) ) {
        //     echo nl2br("in while $count: ");
        //     var_dump($row_data);
        //     echo nl2br("\n");
        //     $count ++;
        // }
        mysqli_close($link);
    } else {
        $link = mysqli_connect($_["datasource"], $_["userid"], $_["password"], $_["database"]);
        print(mysqli_error($link));
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>