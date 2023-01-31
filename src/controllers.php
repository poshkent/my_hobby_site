<?php
require_once 'business.php';
require_once 'controller_utils.php';



function clear() {
    $db = get_db();
    $db->pictures->deleteMany([]);
    $db->users->deleteMany([]);
    header('Location: /');
}
function main(&$model)
{
    return 'main_view';
}

function log_in(&$model)
{
    $model['message'] = "";
    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        $password = $_POST['pass'];

        $user = get_user($login);
        if ($user !== null and password_verify($password, $user['password'])) {
            session_regenerate_id();
            $_SESSION['user_id'] = $user['_id'];
            $model['message'] = "Succes login";
        } elseif ($user == null) {
            $model['message'] = "Wrong username";
        } else {
            $model['message'] = "Wrong password";
        }
    }

    return 'log_in_view';
}

function register(&$model)
{
    $model['message'] = "";
    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $repeat_password = $_POST['repeat_pass'];

        $user = get_user($login);
        if ($user !== null) {
            $model['message'] = "Login zajęty";
        } elseif ($password != $repeat_password) {
            $model['message'] = "Passwords doesn' match";
        } else {
            add_user($login, $email, $password);
            $model['message'] = "Success";
        }
    }
    return 'register_view';
}

function hobbies(&$model)
{
    $page = $_GET['page'] ?? 1;
    $page_size = 7;
    $user_id = $_SESSION['user_id'] ?? 0;
    $pictures = get_pictures($page, $page_size, $user_id);
    $amound = $pictures[1];
    $pictures = $pictures[0];
    $saved_pictures = & get_saved_pictures();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST as $id) {
            $saved_pictures[$id] = $id;
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    foreach ($pictures as $picture) {
        $picture['status'] = '';
        $id = $picture['_id'];

        if (isset($saved_pictures["$id"]))
            $picture['status'] = 'checked';
    }

    $model['pictures'] = $pictures;
    $model['max_page'] = ceil($amound / $page_size);
    return 'hobbies_view';
}

function contact(&$model)
{
    return 'contact_view';
}

function log_out(&$model)
{
    session_destroy();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function edit(&$model)
{
    $model['login'] = '';
    $model['message'] = "";
    if (isset($_SESSION['user_id'])) {
        $user = get_user_by_id($_SESSION['user_id']);
        $model['login'] = $user['login'];
    }
    if (isset($_FILES['file'])) {
        $check = can_upload($_FILES['file']);
        if ($check === true) {
            $path = make_upload($_FILES['file'], $_POST['watermark']);
            $picture = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'path' => $path,
                'visibility' => $_POST['visibility'] ?? 'public',
                'author_id' => $_SESSION['user_id'] ?? '',
            ];

            save_picture($picture);
            $model['message'] = "File succesfully uploadet";
        } else {
            $model['message'] = "$check";
        }
    }

    return 'edit_view';
}

function search(&$model)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $model['pictures'] = find_pictures($_POST['title'], $_SESSION['user_id'] ?? 0);
        return is_ajax() ? 'partial/galery_view' : 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
    return 'search_view';
}

function pictures(&$model)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $pics = &get_saved_pictures();
        foreach ($_POST as $id) {
            unset($pics[$id]);
        }
    }
    $pics = get_saved_pictures();
    $pictures = [];
    foreach($pics as $pic){
        $pictures[] = get_picture($pic);
    }
    $model['pictures'] = $pictures;
    $model['ref'] = $_SERVER['HTTP_REFERER'] ?? '/';
    return 'pictures_view';
}

function error404(&$model)
{
    return 'error404_view';
}