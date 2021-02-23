<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\User;


class UserController extends Controller
{

    public function auth()
    {
        $this->title = 'Форма авторизации';
        $errors = [];
        $user = new User;

        if ($user->isGuest()) {

            if ((isset($_POST['userEmail']) && !empty($_POST['userEmail']))
                && (isset($_POST['userPassword']) && !empty($_POST['userPassword']))
            ) {
                $email = $_POST['userEmail'];
                $password = $_POST['userPassword'];

                $userID = $user->checkUser($email, $password);

                if ($userID !== false) {
                    $user->authUser($userID);
                    header('Location: /cpanel/');
                } else {
                    $errors[] = 'Неверные данные для входа';
                }
            }
        } else {

            header('Location: /cpanel/');
        }

        return $this->render('user/auth', [
            'errors'    => $errors
        ]);
    }

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

    public function logout()
    {
        $user = new User();
        $result = $user->userLogout();
        if ($result) {
            header('Location: /auth/');
        }
    }
}
