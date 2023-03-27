<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../include/bootstrap.html' ?>
    <title>パスワード修正画面</title>
</head>

<body>
    <form id="signup">
        <p>
            <label for="name">ニックネーム</label>
            <input type="text" id="name">
        </p>
        <p>
            <label for="email">メールアドレス</label>
            <input type="email" id="email">
        </p>

        <p>
            <label for="password">パスワード</label>
            <input type="password" id="password">
        </p>

        <p>
            <label for="confirmPassword">パスワード確認</label>
            <input type="password" id="confirmPassword">
        </p>
        <p>
            <input type="submit" value="Signup">
        </p>
    </form>

</body>

</html>



<!-- <script>
        //定数formを定義
        const form = document.getElementById('signup');

        //関数宣言

        // 空チェック関数
        //  (...args) -> 可変長引数
        const isValidRequiredInput = (...args) => {
            let validator = true;
            for (let i = 0; i < args.length; i = (i + 1) | 0) {
                if (args[i] === "") {
                    validator = false;
                }
            }
            return validator
        };

        // ニックネームの文字数制限の関数
        const isValidName = (name) => {
            if (name.length < 4) {
                return false
            }
            return true
        }


        // メール形式チェックの関数
        const isValidEmailFormat = (email) => {
            const regex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
            return regex.test(email)
        }

        // パスワード一致チェック確認の関数
        const isValidPassword = (password, confirmPassword) => {
            if (password !== confirmPassword) {
                return false
            }
            return true
        }


        // フォームのSignupボタン押されたら実行
        form.addEventListener('submit', e => {
            e.preventDefault();

            // フォームの値取得
            const name = form.name.value;
            const email = form.email.value;
            const password = form.password.value;
            const confirmPassword = form.confirmPassword.value;

            // 空チェック
            if (!isValidRequiredInput(name, email, password, confirmPassword)) {
                // 値が空でないかチェック
                alert('必須項目が未入力です。');
                return false
            }

            // ニックネームの文字数制限
            if (!isValidName(name)) {
                alert('ニックネームは4文字以上で入力ください。')
                return false
            }

            // emailの形式チェック
            if (!isValidEmailFormat(email)) {
                alert('メールアドレスの形式が不正です。もう1度お試しください。')
                return false
            }

            // パスワード一致チェック    
            if (!isValidPassword(password, confirmPassword)) {
                alert('パスワードが一致しません。もう１度お試しください。')
                return false
            }
        });
    </script> -->