<?php

namespace Project\Models;

use \Core\Model;

class Comment extends Model
{

    public function getComments($id_post)
    {
        return $this->findMany("SELECT comment.text, comment.date, comment.id, comment.author_id, post.id as id_post FROM comment JOIN post ON $id_post = comment.post_id GROUP BY comment.id ORDER BY comment.date DESC");
    }

    public function create($data, $id_post)
    {

        $sql = "INSERT comment (text, author_id, post_id)
				VALUES (:text, :author_id, :post_id)";

        $result = self::$link->prepare($sql);
        $result->bindParam(':text', $data['текст'], \PDO::PARAM_STR);
        $result->bindParam(':author_id', $data['автор'], \PDO::PARAM_STR);
        $result->bindParam(':post_id', $id_post, \PDO::PARAM_STR);

        return $result->execute();
    }


    public function getData()
    {
        if (isset($_POST['submit'])) {

            $text         =  $_POST['comment'] ?? false;
            $post_id      =  $_POST['post'] ?? false;
            $author_id    =  $_SESSION['id'] ?? false;

            $data = [
                'текст'     => $text,
                'пост'      => $post_id,
                'автор'     => $author_id,
            ];

            return $data;
        }

        return false;
    }
}
