<?php

namespace Project\Models;

use \Core\Model;

class User extends Model
{

    // Метод добавления нового пользователя
    public function register($name, $email, $password, $country)
    {
        $sql = 'INSERT INTO user (name, email, password, country) VALUES (:name, :email, :password, :country)';

        $rezult = self::$link->prepare($sql);
        $rezult->bindParam(':name', $name, \PDO::PARAM_STR);
        $rezult->bindParam(':email', $email, \PDO::PARAM_STR);
        $rezult->bindParam(':password', $password, \PDO::PARAM_STR);
        $rezult->bindParam(':country', $country, \PDO::PARAM_STR);

        return $rezult->execute();
    }

    // Метод проверки на существование
    public function checkExist($email)
    {
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        $rezult = self::$link->prepare($sql);
        $rezult->bindParam(':email', $email, \PDO::PARAM_STR);
        $rezult->execute();
        if ($rezult->fetchColumn()) {
            return false;
        }
        return true;
    }

    // Метод проверки логина
    public function checkName($name)
    {
        $pattern = '/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/';

        if (isset($name) && strlen($name) > 6) {
            if (preg_match($pattern, $name)) {
                return true;
            }
        }
        return false;
    }

    // Метод проверки почты
    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    // Метод проверки пароля на валидность
    public static function checkPass($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

}
