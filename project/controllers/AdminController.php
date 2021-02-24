<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Admin;
use \Project\Models\Post;

class AdminController extends Controller
{
    // Индексная страница
    public function index()
    {
        $this->title = 'cPanel';
        // Если пользователь авторизован
        if (isset($_SESSION['id']) && $_SESSION['id'] !== false) {
            // А если авторизован, и он администратор
            if ($_SESSION['id'] == 1) {

                // Получаем список всех постов
                $post = new Post();
                $allPosts = $post->getPostAll();

                // Загружаем представление
                return $this->render('admin/index', ['posts' => $allPosts]);
                // Если же пользователь не администратор
            } else {
                header('Location: /panel/');
            }
        }
        // В ином случаем перенаправляем его на форму
        header('Location: /auth/');
    }



    // Редактирование поста
    public function editPost($arg)
    {
        $this->title = 'Редактирование поста';
        $errors = [];
        $update = false;

        if (isset($_SESSION['id']) && $_SESSION['id'] !== false) {
            // А если авторизован, и он администратор
            if ($_SESSION['id'] == 1) {

                // Вытаскиваем данные
                $post = new Post();
                $postItem = $post->getPostById($arg['id']);

                // Сохранение поста
                if (isset($_POST['submit'])) {

                    $title =        $_POST['title'];
                    $description =  $_POST['description'];
                    $keyword =      $_POST['keyword'];
                    $story =        $_POST['story'];

                    // Реализовать данный метод в модели!!!!!!!!!!!!!!!!!!!
                    $update = $post->updatePost($arg['id'], $title, $description, $keyword, $story);
                }

                return $this->render('admin/editPost', [
                    'post'      => $postItem,
                    'errors'    => $errors,
                    'update'    => $update
                ]);
            }
        }

        header('Location: /auth/');
    }
}
