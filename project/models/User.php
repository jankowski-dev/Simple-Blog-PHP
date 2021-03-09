<?php

namespace Project\Models;

use \Core\Model;

class User extends Model
{

    /********************************
     * Метод получает все записи.
     * JOIN с таблицой категорий.
     ********************************/

    public function getUsers()
    {
        return $this->findMany("SELECT id, name, reg_date, post_num FROM user");
    }

    // public function getUsers()
    // {
    //     return $this->findMany("SELECT user.id, user.name, user.reg_date,
    //          COUNT(post.id) as posts FROM user JOIN post ON post.author_id = user.id
    //          GROUP BY user.id");
    // }


    /********************************
     * Метод количество постов пользователя.
     * ПРинимает аргументом id пользователя.
     ********************************/

    public function getCountUserPost($id)
    {
        return $this->findOne("SELECT COUNT(*) as count FROM post JOIN user ON user.id = post.author_id WHERE user.id = $id");
    }




    // Спорные методы, нужно их как-то объеденить


        /********************************
     * Метод получения данных пользователя.
     * Принимает аргументом id пользователя
     ********************************/

    public function getUserById($userID)
    {
        $sql = 'SELECT * FROM user WHERE id = :id';
        $rezult = self::$link->prepare($sql);
        $rezult->bindParam(':id', $userID, \PDO::PARAM_STR);
        $rezult->setFetchMode(\PDO::FETCH_ASSOC);
        $rezult->execute();
        return $rezult->fetch();
    }


}
