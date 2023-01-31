<?php
$options = [
    '/' => '',
    '/hobbies' => '',
    '/contact' => '',
    '/log_out' => '',
    '/log_in' => '',
    '/register' => '',
];
$options[$_GET['action']] = 'class="active"'
?>
<header>
    <a href="./" <?=$options['/']?>>Home</a>
    <a href="./hobbies" <?=$options['/hobbies']?> > All hobbies</a>
    <a href="./contact" <?=$options['/contact']?>>Contact</a>
    <?php if (get_user_id()): ?>
    <a href='./log_out'>Log out</a>
    <?php else: ?>
    <a href='./log_in' <?=$options['/log_in']?>>Log in</a>
    <a href='./register' <?=$options['/register']?>>Register</a>
    <?php endif ?>
</header>
<hr>