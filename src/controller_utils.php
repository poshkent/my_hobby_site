<?php

function &get_saved_pictures()
{
    if (!isset($_SESSION['pictures'])) {
        $_SESSION['pictures'] = []; //pusty koszyk
    }

    return $_SESSION['pictures'];
}

function get_user_id() {
    if(isset($_SESSION['user_id'])){
        return $_SESSION['user_id'];
    }
    else {
        return 0;
    }
}
