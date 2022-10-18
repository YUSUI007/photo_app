<?php
// 関数ファイルを読み込む
require_once __DIR__ . '/../common/functions.php';

// セッション開始
session_start();

$current_user = '';
$description = '';
$upload_file = '';
$upload_tmp_file = '';
$errors = [];
$image_name = '';

if (empty($_SESSION['current_user'])) {
    header('Location: ../users/login.php');
    exit;
}

$current_user = $_SESSION['current_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = filter_input(INPUT_POST, 'description');
    // アップロードした画像のファイル名
    $upload_file = $_FILES['image']['name'];
    // サーバー上で一時的に保存されるテンポラリファイル名
    $upload_tmp_file = $_FILES['image']['tmp_name'];

    $errors = insert_validate($description, $upload_file);

    if (empty($errors)) {
        $image_name = date('YmdHis') . '_' . $upload_file;
        $path = '../images/' . $image_name;

        if ((move_uploaded_file($upload_tmp_file, $path)) &&
            insert_photo($current_user['id'], $image_name, $description)
        ) {
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <main class="main_content content_center wrapper">
        <div class="form_flex">
            <?php include_once __DIR__ . '/../common/_errors.php' ?>

            <form action="" method="post" class="upload_content_form" enctype="multipart/form-data">
                <label id="preview" class="upload_content_label" for="file_upload">
                    <span id="plus_icon" class="plus_icon"><i class="fas fa-plus-circle"></i></span>
                    <span id="upload_text" class="upload_text">写真を追加</span>
                </label>
                <input class="input_file" type="file" id="file_upload" name="image"  onchange="imgPreView(event)">
                <textarea class="input_text" name="description" rows="5" placeholder="画像の詳細を入力してください"><?= h($description) ?></textarea>
                <input type="submit" value="追加" class="upload_submit">
            </form>
        </div>
    </main>

    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>
</html> 
