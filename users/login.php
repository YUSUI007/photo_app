<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/../common/functions.php';

// セッション開始
session_start();

$email = '';
$password = '';
$errors = [];

// ログイン判定
if (isset($_SESSION['current_user'])) {
    header('Location: ../photos/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    $errors = login_validate($email, $password);

    if (empty($errors)) {
        $user = find_user_by_email($email);
        if (!empty($user) && password_verify($password, $user['password'])) {
            user_login($user);
        } else {
            $errors[] = MSG_EMAIL_PASSWORD_NOT_MATCH;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <main class="content_center wrapper">
        <div class="login_content">
            <h2 class="login_title">ログイン</h2>

            <?php include_once __DIR__ . '/../common/_errors.php' ?>

            <form class="login_form" action="" method="post">
                <label class="email_label" for="email">メールアドレス</label>
                <input type="email" name="email" id="email" placeholder="Email" value="<?= h($email) ?>">
                <label class="password_label" for="password">パスワード</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <div class="button_area">
                    <input type="submit" value="ログイン" class="login_button">
                    <a href="signup.php" class="signup_page_button">新規ユーザー登録</a>
                </div>
            </form>
        </div>
    </main>

    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>

</html>
