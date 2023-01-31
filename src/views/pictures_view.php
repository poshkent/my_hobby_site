<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Harelik Pavel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="static/css/main.css">
    <link rel="stylesheet" type="text/css" href="static/css/forms.css">
</head>

<body>
    <?php include "includes/header.inc.php" ?>
    <div id="content">
        <form method="post">
            <div id="galery">
                <?php if ($pictures): ?>
                    <?php foreach ($pictures as $picture): ?>
                        <div id="user_img">
                            <h5>
                                Title:<?= $picture['title'] ?>
                            </h5>
                            <a href="<?= str_replace("minified", "watermark", $picture['path']) ?>"><img
                                    src="<?= $picture['path'] ?>" alt="usr_img" /></a>
                            <h5>Author: <?= $picture['author'] ?>
                            </h5>
                            <input type="checkbox" name="<?= $picture['_id'] ?>" value="<?= $picture['_id'] ?>" />
                            </h5>
                        </div>

                    <?php endforeach ?>
                <?php else: ?>
                    <h1>There isn't any saved pictures</h1>
                <?php endif ?>
            </div>
            <?php if ($pictures): ?>
                <input type="submit" class="button" value="Delete chosen" />
            <?php endif ?>
            <input type='button' class='button' value='Go back' onClick="document.location = '/hobbies'" />
        </form>
    </div>
    <?php include "includes/footer.inc.php" ?>
</body>

</html>