<?php

namespace Project\Models;

use \Core\Model;

class File extends Model
{
    public static $fileName;
    public static $path = '/project/webroot/img/post_image/';


    public static function uploadFile()
    {
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . self::$path;
        $uploadFile = $uploadDirectory . basename($_FILES['picture']['name']);
        self::$fileName = basename($uploadFile);
        $transfer = move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);
        return $result = $transfer ? self::$fileName : false;
    }
}
