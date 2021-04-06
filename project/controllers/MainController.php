<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Group;
use \Project\Models\Category;

class MainController extends Controller
{
    public $post;
    public $category;
    public $group;

    public $errors  = false;
    public $update  = false;
    public $create  = false;

    public function __construct()
    {
        $this->post     = new Post();
        $this->category = new Category();
        $this->group    = new Group();
    }


    public function index()
    {
        $this->title = 'Главная страница';

        $data = $this->post->getPosts();

        // Загружаем представление
        return $this->render('main/index', [
            'posts' => $data,
            'object' => $this->post
        ]);
    }

    /********************************
     * Метод просмотра поста.
     * Аргументом принимает id поста
     ********************************/

    public function viewPost($arg)
    {
        // Тайтл страницы
        $this->title = 'Пост';

        // Получаем пост по id
        $data = $this->post->getPostById($arg['id']);

        // Загружаем представление
        return $this->render('/main/post', [
            'object' => $this->post,
            'post' => $data
        ]);

        // В ином случаем перенаправляем
        header('Location: /');
        exit;
    }
}