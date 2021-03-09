<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\User;
use \Project\Models\Group;


class UserController extends Controller
{
    public $errors  = false;
    public $group;

    public function __construct()
    {
        $this->user = new User();
        $this->group = new Group();
    }

    /********************************
     * Метод авторизации на сайте.
     * Принимает данные из формы и
     * создают сессию для пользователя
     ********************************/

    public function index()
    {
        $this->title = 'cPanel: Пользователи';
        $errors = false;

        if ($this->group->admin()) {

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
        if ($this->group->admin()) {

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


}
