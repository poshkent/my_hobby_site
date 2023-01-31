<?php


use MongoDB\BSON\ObjectID;

function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]
    );

    $db = $mongo->wai;

    return $db;
}

function get_pictures($page = 1, $page_size = 5, $user = 0)
{
    $db = get_db();
    $opts = [
        'skip' => ($page - 1) * $page_size,
        'limit' => $page_size
    ];
    $query = ['visibility' => 'public'];
    if (isset($_SESSION['user_id'])) {
        $query = [
            '$or' => [
                ['visibility' => 'public'],
                ['author_id' => $_SESSION['user_id']]
            ]
        ];
    }

    return [$db->pictures->find($query, $opts)->toArray(), $db->pictures->count($query)];
}

function find_pictures($title, $user_id = 0)
{
    if ($title == '')
        return [];
    $db = get_db();
    $query = [
        '$or' => [
            ['visibility' => 'public'],
            ['author_id' => $user_id]
        ],
        'title' => ['$regex' => $title]
    ];
    return $db->pictures->find($query)->toArray();
}

function get_picture($id)
{
    $db = get_db();
    return $db->pictures->findOne(['_id' => new ObjectID($id)]);
}

function get_user($login)
{
    $db = get_db();
    return $db->users->findOne(['login' => $login]);
}

function add_user($login, $email, $password)
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $db = get_db();
    $db->users->insertOne([
        'login' => $login,
        'email' => $email,
        'password' => $hash
    ]);
    return $db->users->findOne(['login' => $login]);
}

function get_user_by_id($id)
{
    $db = get_db();
    return $db->users->findOne(['_id' => new ObjectID($id)]);
}

function can_upload($file)
{
    if ($file['name'] == '')
        return "You haven't chosen file";
    if ($file['size'] == 0 or $file['size'] > 1000000)
        return "File is too great";

    $getMime = explode('.', $file['name']);
    $mime = strtolower(end($getMime));
    $types = array('jpg', 'png', );

    if (!in_array($mime, $types))
        return 'Wrong type of file';

    return true;
}

function add_watermark($img, $text, $font, $r = 255, $g = 255, $b = 255, $alpha = 50)
{
    $width = imagesx($img);
    $height = imagesy($img);

    $angle = -rad2deg(atan2((-$height), ($width)));

    $text = " " . $text . " ";
    $c = imagecolorallocatealpha($img, $r, $g, $b, $alpha);
    $size = (($width + $height) / 2) * 2 / strlen($text);
    $box = imagettfbbox($size, $angle, $font, $text);
    $x = $width / 2 - abs($box[4] - $box[0]) / 2;
    $y = $height / 2 + abs($box[5] - $box[1]) / 2;

    imagettftext($img, $size, $angle, $x, $y, $c, $font, $text);
    return $img;
}

function make_upload($file, $watermark)
{
    $getMime = explode('.', $file['name']);
    $mime = strtolower(end($getMime));
    $id = mt_rand(0, 10000);
    $name = $id . '_' . $file['name'];
    copy($file['tmp_name'], 'images/' . $name);

    $getMime = explode('.', $file['name']);
    $mime = strtolower(end($getMime));
    if ($mime == 'jpg')
        $image = imagecreatefromjpeg('images/' . $name);
    else
        $image = imagecreatefrompng('images/' . $name);

    $image = add_watermark($image, $watermark, 'static/fonts/Gilroy-Bold.ttf');

    imagepng($image, "images/" . "watermark_" . $name);

    $k1 = 200 / imagesx($image);
    $k2 = 125 / imagesy($image);
    $k = $k1 > $k2 ? $k2 : $k1;

    $w = intval(imagesx($image) * $k);
    $h = intval(imagesy($image) * $k);

    $im1 = imagecreatetruecolor($w, $h);
    imagecopyresampled($im1, $image, 0, 0, 0, 0, $w, $h, imagesx($image), imagesy($image));

    imagejpeg($im1, "images/" . "minified_" . $name, 75);
    imagedestroy($image);
    imagedestroy($im1);
    return "images/" . "minified_" . $name;
}

function save_picture($picture)
{
    $db = get_db();
    $db->pictures->insertOne($picture);
    return true;
}
