<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Group;
use \Project\Models\Category;
use \Project\Models\Comment;

class MainController extends Controller
{
    public $post;
    public $category;
    public $group;
    public $comment;

    public $errors  = false;
    public $update  = false;
    public $create  = false;

    public function __construct()
    {
        $this->post     = new Post();
        $this->category = new Category();
        $this->group    = new Group();
        $this->comment  = new Comment();
    }


    public function index()
    {
        $this->title = 'Главная страница';

        // Выборка всех постов
        $posts = $this->post->getPosts();

        // Обработка и сортировка постов
        $data = $this->post->handlerPost($posts);


        // Загружаем представление
        return $this->render('main/index', [
            'posts'         => $data['allPosts'],
            'mainPost'      => $data['mainPost'],
            'fixedPosts'    => $data['fixedPost'],
            'date'          => $this->post
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

        // Получаем пост
        $post = $this->post->getPostById($arg['id']);

        // Получаем список комментариев
        $comments = $this->comment->getComments($arg['id']);

        // Получаем данные из формы комментариев
        $commentData = $this->comment->getdata();

        // Добавление комментария
        if ($commentData) {
            $result = $this->comment->create($commentData, $arg['id']);
            header("Refresh:0");
        }

        // Загружаем представление
        return $this->render('/main/post', [
            'object' => $this->post,
            'post' => $post,
            'comments' => $comments,
        ]);

        // В ином случаем перенаправляем
        header('Location: /');
        exit;
    }
}
