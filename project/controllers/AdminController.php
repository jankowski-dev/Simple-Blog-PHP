<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Admin;
use \Project\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $this->title = 'cPanel';
        $user = new User();

        // Если пользователь не авторизован
        if ($user->checkLogged() !== false) {
            // А если авторизован, и он администратор
            if ($user->checkLogged() == 1) {
                // Что-то делаем
                // ...
                // Загружаем представление
                return $this->render('admin/index');
                // Если пользователь не администратор
            } else {
                header('Location: /panel/');
            }
        }
        // Если пользователь не авторизован
        header('Location: /auth/');
    }
}
