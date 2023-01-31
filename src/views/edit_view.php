<!DOCTYPE html>
<html>

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
        <?php if ($message): ?>
            <h1>
                <?= $message ?>
            </h1>
        <?php endif ?>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <br>
            <label>
                <span>Watermark:</span>
                <input type="text" name="watermark" required />
            </label>
            <br>
            <label>
                <span>Title:</span>
                <input type="text" name="title" required />
            </label>
            <br>
            <label>
                <span>Author:</span>
                <input type="text" name="author" value="<?= $login ?>" required />
            </label>
            <?php if ($login): ?>
                <div>
                    <label>Visibility: <br /></label>
                    <input id="public" type="radio" name="visibility" value="public" checked />
                    <label for="public">Public</label>
                    <input id="private" type="radio" name="visibility" value="private" />
                    <label for="private">Private</label>
                </div>
            <?php endif ?>
            <br>
            <input type="submit" class="button" value="Upload file">
        </form>
    </div>
    <?php include "includes/footer.inc.php" ?>
</body>

</html>