<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Harelik Pavel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="static/css/main.css">
	<link rel="stylesheet" type="text/css" href="static/css/contact.css">
	<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/smoothness/jquery-ui.css">
</head>

<body>
	<?php include "includes/header.inc.php" ?>
	<div id="content">
		<form method="post" id="form" action="some.php">
			<h2>Want to ask a question?</h2>

			<label>Your question: <br /></label>
			<textarea name="question" id="question" rows="3"></textarea>

			<div>
				<label for="language">Choose your programming language</label>
				<select name="user_programming_language" id="language">
					<optgroup label="Desktop">
						<option value="c++">C++</option>
						<option value="python">Python</option>
					</optgroup>
					<optgroup label="Web dev">
						<option value="html,css">HTML, CSS</option>
					</optgroup>
				</select>
			</div>

			<div>
				<label>Contact way: <br /></label>
				<input id="tg" type="radio" name="contact" value="telegram" />
				<label for="tg">Telegram</label>
				<input id="ins" type="radio" name="contact" value="instagram" />
				<label for="ins">Instagram</label>
				<input id="mess" type="radio" name="contact" value="messanger" />
				<label for="mess">Messsanger</label>
				<input id="email" type="radio" name="contact" value="email" />
				<label for="email">Email</label>
			</div>

			<div>
				<label for="username">Please input your username or email adress:
				</label>
				<input type="text" id="username" name="username" /> <br />
			</div>

			<div>
				<label>Please input your name and surname: <br /></label>
				<label for="name">Name</label>
				<input type="text" id="name" name="name" /> <br />
				<label for="surname">Surname</label>
				<input type="text" id="surname" name="surname" />
			</div>

			<div><label>Please rate my site</label></div>

			<div id="slider">
				<div id="custom-handle" class="ui-slider-handle"></div>
			</div>

			<div id="buttons">
				<input type="submit" class="button" value="Confirm" />
				<input type="reset" class="button" value="Clear" onclick="sessionStorage.setItem('question', '')" />
			</div>
		</form>

		<div id="time">
			<input type="button" value="Show time" id="add_time" />
			<input type="button" value="Update time" id="update_time" />
		</div>


		<div id="hint">
			<div id="dialog" title="Form hint">
				Using this, form you can get help or some info from me
			</div>
			<button id="hint_btn">Show hint</button>
		</div>
	</div>
	<hr>
	<?php include "includes/footer.inc.php" ?>

	<script src="./js/main.js"></script>
	<script src="./js/jquery.js"></script>
</body>

</html>