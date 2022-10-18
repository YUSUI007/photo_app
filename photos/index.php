<?php

require_once __DIR__ . '/../common/functions.php';

// セッション開始
session_start();

$current_user = '';

if (isset($_SESSION['current_user'])) {
    $current_user = $_SESSION['current_user'];
}

$photos = find_photos_all()
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <main class="article wrapper">
        <div class="grid" data-masonry='{"columnWidth": 270, "itemSelector": ".grid_item", "isFitWidth": true}'>
            <?php foreach ($photos as $photo) : ?>
                <div class="grid_item">
                    <a href="show.php?id=<?= h($photo['id']) ?>">
                        <img src="../images/<?= h($photo['image']) ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="upload.php" class="add_button">
            <i class="fa-solid fa-plus"></i>
        </a>
    </main>

    <?php include_once __DIR__ . '/../common/_footer.html' ?>

    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
</body>

</html>
