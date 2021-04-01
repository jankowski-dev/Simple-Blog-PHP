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
            'posts' => $data
        ]);
    }
}
