<?php

// 関数ファイルを読み込む
require_once __DIR__ . '/../common/functions.php';

// セッション開始
session_start();

$current_user = '';
$id = 0;

// パラメータが渡されていなけらば一覧画面に戻す
$id = filter_input(INPUT_GET, 'id');
if (empty($id)) {
    header('Location: index.php');
    exit;
}

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

// idを基にデータを取得
$photo = find_photo_by_id($id);
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <main class="main_content content_center wrapper">
        <div class="content">
            <img src="../images/<?= h($photo['image']); ?>">
            <p>
                <?= h($photo['description']); ?>
            </p>
            <?php if (!empty($current_user) && $current_user['id'] == $photo['user_id']) : ?>
                <div class="button">
                    <a href="edit.php" class="edit_button">編 集</a>
                    <button class="delete_button">削 除</button>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>

</html>
