<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Harelik Pavel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="static/css/main.css">
    <link rel="stylesheet" type="text/css" href="static/css/forms.css">
    <script src="static/js/jquery-1.11.3.min.js"></script>
    <script src="static/js/main.js"></script>
</head>

<body>
    <?php include "includes/header.inc.php" ?>
    <div id='content'>
        <h2>Search</h2>
        <label>
            <span>Type here</span>
            <input type="search" name='title' id='search'>
        </label>

        <div id="galery"></div>
    </div>

    <script>
        $(function () {
            $('input[id=search]').on('keyup', function (e) {
                e.preventDefault();

                $('#galery').ajaxMask();

                $.post($(this).attr('action'), $(this).serialize(),
                    function (response) {
                        $('#galery').replaceWith(response);
                    });
            });
        });
    </script>

    <?php include "includes/footer.inc.php" ?>
</body>

</html>