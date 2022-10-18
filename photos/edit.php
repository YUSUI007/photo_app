<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <main class="main_content content_center wrapper">
        <form action="" method="post" class="upload_content_form" enctype="multipart/form-data">
            <label for="file_upload">
                <img src="https://picsum.photos/200/300">
            </label>
            <input class="input_file" type="file" id="file_upload" name="image">
            <textarea class="input_text" rows="5" name="description" placeholder="画像の詳細を入力してください">画像の説明文</textarea>
            <input type="submit" value="更 新" class="update_button">
        </form>
    </main>

    <?php include_once __DIR__ . '/../common/_footer.html' ?>
</body>

</html>
