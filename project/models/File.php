<?php

namespace Project\Models;

use \Core\Model;

class File extends Model
{
    public $path = '/project/webroot/img/post_image/';
    public $fileName;

    public function uploadFile($id)
    {
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $this->path;
        $uploadFile = $uploadDirectory . $id . '_' . basename($_FILES['picture']['name']);
        $this->fileName = basename($uploadFile);
        $fileResult = move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile) ? true : false;
        if ($fileResult) {
            $sql = "UPDATE post SET image = :image WHERE id = :id";
            $result = self::$link->prepare($sql);
            $result->bindParam(':id', $id, \PDO::PARAM_STR);
            $result->bindParam(':image', $this->fileName, \PDO::PARAM_STR);
            return $result->execute();
        }
    }
}
