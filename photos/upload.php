<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>
    <main class="upload_content content_center wrapper">
        <form action="" method="post" class="upload_content_form" enctype="multipart/form-data">
            <label class="upload_content_label" for="file_upload">
                <span class="plus_icon"><i class="fas fa-plus-circle"></i></span>
                <span class="upload_text">写真を追加</span>
            </label>
            <input class="input_file" type="file" id="file_upload" name="image">
            <textarea class="input_text" name="description" rows="5" placeholder="画像の詳細を入力してください"></textarea>
            <input class="upload_submit" type="submit" value="追加">
        </form>
    </main>
    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>

</html>
