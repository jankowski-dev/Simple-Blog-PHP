<?php

namespace Project\Models;

use \Core\Model;

class Auth extends Model
{

    /********************************
     * Метод добавления нового пользователя.
     * Принимает аргументом массив данных
     ********************************/

    public function register($data)
    {
        $sql = 'INSERT INTO user (name, email, password, country, group_id) VALUES (:name, :email, :password, :country, :group)';

        $groupDefault = 3;

        $rezult = self::$link->prepare($sql);
        $rezult->bindParam(':name', $data['имя'], \PDO::PARAM_STR);
        $rezult->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $rezult->bindParam(':password', $data['пароль'], \PDO::PARAM_STR);
        $rezult->bindParam(':country', $data['страна'], \PDO::PARAM_STR);
        $rezult->bindParam(':group', $groupDefault, \PDO::PARAM_STR);

        return $rezult->execute();
    }


    /********************************
     * Метод получения данных о пользователе.
     * Принимает аргументом ID пользователя
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


    /********************************
     * Метод проверки на существование.
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
     * Метод валидации имени.
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
     * Метод валидации email.
     * Принимает аргументом email
     ********************************/

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }


    /********************************
     * Метод валидации пароля.
     * Принимает аргументом пароль
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
     * Принимает аргументом массив данных
     ********************************/

    public function checkUser($data)
    {
        $sql = 'SELECT * FROM user WHERE email = :email and password = :pass';
        $rezult = self::$link->prepare($sql);
        $rezult->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $rezult->bindParam(':pass', $data['пароль'], \PDO::PARAM_STR);
        $rezult->execute();
        $user = $rezult->fetch();

        $result = ($user) ? $user['id'] : false;
        return $result;
    }


    /********************************
     * Метод авторизации пользователя.
     * Принимает аргументом id пользователя
     ********************************/

    public function authUser($userID)
    {
        $userInfoArray = $this->getUserById($userID);

        $_SESSION['name']       = $userInfoArray['name'];
        $_SESSION['id']         = $userInfoArray['id'];
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
            session_destroy();
        }
        return true;
    }


    /********************************
     * Метод валидации данных при регистрации.
     * Принимает аргументом массив данных
     ********************************/

    public function valRegister($data)
    {
        $errors = false;

        if (!$this->checkName($data['имя'])) {
            $errors[] = 'Имя должно содержать только латинские буквы, тире или цифры';
        }

        if (!$this->checkEmail($data['email'])) {
            $errors[] = 'Неверно указанный email адрес';
        }

        if (!$this->checkPass($data['пароль'])) {
            $errors[] = 'Пароль должен содержать не менее 6 символов';
        }

        if (!$this->checkExist($data['email'])) {
            $errors[] = 'Такой пользователь уже существует!';
        }

        return $errors;
    }


    /********************************
     * Метод получения данных из массива $_POST.
     * Не принимает аргументов
     ********************************/

    public function getData()
    {
        if (isset($_POST['submit'])) {

            $name = $_POST['name'] ?? false;
            $email = $_POST['email'] ?? false;
            $password = $_POST['password'] ?? false;
            $country = $_POST['country'] ?? false;

            $data = [
                'имя' => $name,
                'email' => $email,
                'пароль' => $password,
                'страна' => $country
            ];

            return $data;
        }

        return false;
    }
}
