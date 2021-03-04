<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\User;
use \Project\Models\Group;
use \Project\Models\Post;


class UserController extends Controller
{

    /********************************
     * Метод авторизации на сайте.
     * Принимает данные из формы и
     * создают сессию для пользователя
     ********************************/

    public function index()
    {
        $this->title = 'cPanel: Пользователи';
        $errors = false;

        if (Group::is_role(1)) {

            $user = new User();
            $getUsers = $user->getUsers();

            // Загружаем представление
            return $this->render('admin/user/index', [
                'users'         => $getUsers
            ]);
        }

        // В ином случаем перенаправляем его на форму
        header('Location: /');
        exit;
    }


    /********************************
     * Метод авторизации на сайте.
     * Принимает данные из формы и
     * создают сессию для пользователя
     ********************************/

    public function profile($arg)
    {
        $this->title = 'cPanel: Профиль пользователя';
        $errors = false;

        // Если пользователь авторизован
        if (Group::is_role(1)) {

            $user = new User();
            $getUser = $user->getUserById($arg['id']);

            // Загружаем представление
            return $this->render('admin/user/profile', [
                'user'   => $getUser
            ]);
        }

        // В ином случаем перенаправляем его на форму
        header('Location: /');
        exit;
    }

    /********************************
     * Метод авторизации на сайте.
     * Принимает данные из формы и
     * создают сессию для пользователя
     ********************************/

    public function auth()
    {
        $this->title = 'Форма авторизации';
        $errors = false;
        $user = new User;

        if ($user->isGuest()) {

            if (!empty($_POST['userEmail']) && !empty($_POST['userPassword'])) {

                $email = $_POST['userEmail'];
                $password = $_POST['userPassword'];

                $userID = $user->checkUser($email, $password);

                if ($userID !== false) {

                    $user->authUser($userID);

                    header('Location: /');
                    exit;
                }

                $errors[] = 'Неверные данные для входа';
            }
        } else {

            header('Location: /');
            exit;
        }

        return $this->render('user/auth', [
            'errors'    => $errors
        ]);
    }


    /********************************
     * Метод регистрации на сайте.
     * Принимает данные из формы и
     * добавляет нового пользователя
     ********************************/

    public function register()
    {
        $this->title = 'Форма регистрации';
        $errors = false;

        if (isset($_POST['submit'])) {

            $name     = $_POST['userName'];
            $email    = $_POST['userEmail'];
            $password = $_POST['userPassword'];
            $country  = $_POST['userCountry'];

            $user = new User;

            if (!$user->checkName($name)) {
                $errors[] = 'Имя должно содержать только латинские буквы, тире или цифры';
            }

            if (!$user->checkEmail($email)) {
                $errors[] = 'Неверно указанный email адрес';
            }

            if (!$user->checkPass($password)) {
                $errors[] = 'Пароль должен содержать не менее 6 символов';
            }

            if (!$user->checkExist($email)) {
                $errors[] = 'Такой пользователь уже существует!';
            }

            if (!$errors) {

                $user->register($name, $email, $password, $country);

                return $this->render('user/register', [
                    'userName'  => $name,
                    'userEmail' => $email,
                    'errors'    => $errors
                ]);
            }
        }

        return $this->render('user/register', [
            'errors'    => $errors
        ]);
    }


    /********************************
     * Метод разавторизации на сайте.
     * Удаляет данные о пользователе
     * их сессии.
     ********************************/

    public function logout()
    {
        $user = new User();
        $result = $user->userLogout();
        if ($result) {
            header('Location: /auth/');
        }
    }
}
