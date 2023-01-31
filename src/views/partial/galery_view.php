<div id="galery">
    <?php if ($pictures): ?>
    <?php foreach ($pictures as $picture): ?>
    <div id="user_img">
        <h5>
            Title:<?= $picture['title'] ?>
        </h5>
        <a href="<?= str_replace("minified", "watermark", $picture['path']) ?>"><img src="<?= $picture['path'] ?>"
                alt="usr_img" /></a>
        <h5>Author: <?= $picture['author'] ?>
        </h5>
        </h5>
    </div>
    <?php endforeach ?>
    <?php else: ?>
    <h1>There isn't any pictures with this title</h1>
    <?php endif ?>
</div>