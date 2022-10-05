<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/../common/_head.html' ?>

<body>
    <?php include_once __DIR__ . '/../common/_header.php' ?>

    <main class="article wrapper">
        <div class="grid" data-masonry='{"columnWidth": 270, "itemSelector": ".grid_item", "isFitWidth": true}'>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="200"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="300"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="250"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="300"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="250"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="200"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="250"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="300"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="350"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="300"></a>
            </div>
            <div class="grid_item">
                <a href="show.php"><img src="https://picsum.photos/200/300" height="200"></a>
            </div>
        </div>
        <a href="upload.php" class="add_button">
            <i class="fa-solid fa-plus"></i>
        </a>
    </main>

    <?php include_once __DIR__ . '/../common/_footer.html' ?>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
</body>

</html>
