<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Harelik Pavel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/hobbies.css">
	<link rel="stylesheet" type="text/css" href="static/css/forms.css">
</head>

<body>
	<?php include "includes/header.inc.php" ?>

	<div id="content">
		<menu>
			<li>
				<a href="#crafting">Crafting out of wood</a>
			</li>
			<li>
				<a href="#coding">Coding</a>
			</li>
			<li>
				<a href="#sport">Playing sports</a>
				<menu>
			<li><a href="#running">Running</a></li>
			<li><a href="#voleyball">Playing voleyball</a></li>
			<li><a href="#bike">Riding a bike</a></li>
		</menu>
		</li>
		</menu>
		<div id="crafting">
			<h2>Crafting out of wood</h2>

			<div class="hovergallery">
				<img src="static/img/1.jpg" alt="New year tree" />
				<img src="static/img/2.jpg" alt="New year tree" />
				<img src="static/img/3.jpg" alt="Lamp" />
				<img src="static/img/4.jpg" alt="Wolf" />
				<img src="static/img/5.jpg" alt="Wolf" />
			</div>
		</div>

		<div id="coding">
			<h2>Coding</h2>

			<table>
				<tr>
					<th><b>Language</b></th>
					<th><b>Experience</b></th>
				</tr>
				<tr>
					<td>Python</td>
					<td>2 years</td>
				</tr>
				<tr>
					<td>C++</td>
					<td>2.5 years</td>
				</tr>
				<tr>
					<td>HTML, CSS</td>
					<td>2 month</td>
				</tr>
			</table>
		</div>

		<div id="sport">
			<h2>Playing sports</h2>
			<div id="running">
				<h2>Running</h2>
				<img src="static/img/running.jpg" alt="">
			</div>

			<div id="voleyball">
				<h2>Playing voleyball</h2>
				<img src="static/img/voleyball.jpg" alt="">
			</div>

			<div id="bike">
				<h2>Riding bike</h2>
				<img src="static/img/bike.jpg" alt="">
			</div>
		</div>
	</div>

	<div id="content">
		<h2>Pictures about hobbies, uploaded by users</h2>

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
							<?php if ($picture['visibility'] == 'private'): ?>
								<h5>visibility: private
								</h5>
							<?php endif ?>
							<input <?= $picture['status'] ?> type="checkbox" name="<?= $picture['_id'] ?>"
								value="<?= $picture['_id'] ?>" />

						</div>
					<?php endforeach ?>
				<?php else: ?>
					<h1>There is no pictures on this page</h1>
				<?php endif ?>
			</div>
			<div>
				<input type="submit" class="button" value="Save chosen" />
				<input type='button' class='button' value='Wiew chosen' onClick="document.location = '/pictures'" />
			</div>
		</form>
		<br>
		<?php
		for ($i = 1; $i <= $max_page; $i++) {
			$comm = 'document.location = "?page=' . $i . '"';
			echo "<input type='button' class='button' value='page $i' onClick='$comm'/>";
		}
		?>

		<div id="galery">
			<input type="button" class="button" value="Add picture" onclick="location.href='edit'" />
			<input type="button" class="button" value="Find picture" onclick="location.href='search'" />
		</div>

	</div>

	<?php include "includes/footer.inc.php" ?>
</body>

</html>