<?php

namespace Project\Models;

use \Core\Model;

class Comment extends Model
{

    public function getComments($id_post)
    {
        return $this->findMany("SELECT comment.text, comment.date, comment.id, comment.author_id FROM comment JOIN post ON $id_post = comment.post_id GROUP BY comment.id ORDER BY comment.date DESC");
    }

    public function create($data, $id_post)
    {

        $sql = "INSERT INTO comment (text, author_id, post_id) VALUES (:text, :author_id, :post_id)";

        $result = self::$link->prepare($sql);
        $result->bindParam(':text', $data['text'], \PDO::PARAM_STR);
        $result->bindParam(':author_id', $data['author'], \PDO::PARAM_INT);
        $result->bindParam(':post_id', $id_post, \PDO::PARAM_INT);

        return $result->execute();
    }


    public function getData()
    {
        if (isset($_POST['submit'])) {
            $text         =  $_POST['comment'] ?? false;
            $author_id    =  $_SESSION['id'] ?? false;
            $data = [
                'text'     => $text,
                'author'     => $author_id,
            ];
            return $data;
        }
        return false;
    }
}
