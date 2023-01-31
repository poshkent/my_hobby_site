<!doctype html>
<html>

<head>

	<meta charset="UTF-8">
	<title>Harelik Pavel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/forms.css">
</head>

<body>
	<?php include "includes/header.inc.php" ?>

	<div id="content">
		<h1>
			<?= $message ?>
		</h1>

		<form method="post" id="form">
			<h2>Want to ask a question?</h2>

			<label>Your login: </label>
			<input type="text" name="login" required />
			<br>

			<label>Your password </label>
			<input type="password" name="pass" required />
			<br>


			<input type="submit" class="button" value="Confirm" />
		</form>

	</div>

	<?php include "includes/footer.inc.php" ?>
</body>

</html>