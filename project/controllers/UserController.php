<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\User;


class UserController extends Controller
{

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
}
