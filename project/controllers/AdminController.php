<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Group;
use \Project\Models\Category;

class AdminController extends Controller
{
    public $group;

    public function __construct()
    {
        $this->group = new Group();
    }

    /********************************
     * Индексный метод админпанели.
     * Проверяет права доступа и
     * реализует функционал
     ********************************/

    public function index()
    {
        $this->title = 'cPanel';
        $errors = false;

        // Если пользователь авторизован
        if ($this->group->admin()) {



            // Загружаем представление
            return $this->render('admin/index', []);
        }

        // В ином случаем перенаправляем его на форму
        header('Location: /');
        exit;
    }
}
