<?php

namespace Project\Models;

use \Core\Model;

class User extends Model
{

    /********************************
     * Метод добавления нового пользователя.
     * Принимает аргументом
     * регистрационные данные
     ********************************/

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


    /********************************
     * Метод поверки пользователя на
     * существование.
     * Принимает аргументом email
     ********************************/

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


    /********************************
     * Метод проверки на валидность
     * имени.
     * Принимает аргументом имя
     ********************************/

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


    /********************************
     * Метод проверки email на валидность.
     * Принимает аргументом email/
     ********************************/

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }


    /********************************
     * Метод проверки пароля на валидность.
     * Принимает аргументом пароль/
     ********************************/

    public function checkPass($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }


    /********************************
     * Метод поиска введенной пары логин-пароль
     * Принимает аргументом email и пароль
     ********************************/

    public function checkUser($email, $pass)
    {
        $sql = 'SELECT * FROM user WHERE email = :email and password = :pass';
        $rezult = self::$link->prepare($sql);
        $rezult->bindParam(':email', $email, \PDO::PARAM_STR);
        $rezult->bindParam(':pass', $pass, \PDO::PARAM_STR);
        $rezult->execute();

        $user = $rezult->fetch();

        if ($user) {
            return $user['user_id'];
        } else {
            return false;
        }
    }


    /********************************
     * Метод авторизации пользователя.
     * Принимает аргументом id пользователя
     ********************************/

    public function authUser($userID)
    {
        $userInfoArray = $this->getUserById($userID);

        $_SESSION['name']       = $userInfoArray['name'];
        $_SESSION['id']         = $userInfoArray['user_id'];
        $_SESSION['email']      = $userInfoArray['email'];
        $_SESSION['country']    = $userInfoArray['country'];
    }


    /********************************
     * Метод уничтожения сессии пользователя.
     * Не принимает аргументов
     ********************************/

    public function userLogout()
    {
        if (isset($_SESSION['id'])) {
            unset($_SESSION['id']);
        }
        return true;
    }


    /********************************
     * Метод получения данных пользователя.
     * Принимает аргументом id пользователя
     ********************************/

    public function getUserById($userID)
    {
        $sql = 'SELECT * FROM user WHERE user_id = :id';
        $rezult = self::$link->prepare($sql);
        $rezult->bindParam(':id', $userID, \PDO::PARAM_STR);
        $rezult->setFetchMode(\PDO::FETCH_ASSOC);
        $rezult->execute();
        return $rezult->fetch();
    }



    // Спорные методы, нужно их как-то объеденить


    /********************************
     * Метод проверки на существование сессии.
     * Не принимает аргументов
     ********************************/

    public function checkLogged()
    {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        }
        return false;
    }



    /********************************
     * Метод проверки статуса авторизации.
     * Не принимает аргументов.
     ********************************/

    public function isGuest()
    {
        if (isset($_SESSION['id'])) {
            return false;
        }
        return true;
    }
}