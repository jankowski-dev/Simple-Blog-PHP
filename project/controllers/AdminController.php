<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Admin;
use \Project\Models\Post;

class AdminController extends Controller
{
    // Получение
    public function index()
    {
        $this->title = 'cPanel';
        // Если пользователь авторизован
        if ($_SESSION['id'] !== false) {
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

    public function editNewsItem($arg)
    {
        $this->title = 'Редактирование поста';

        if ($_SESSION['id'] !== false) {
            // А если авторизован, и он администратор
            if ($_SESSION['id'] == 1) {

                $post = new Post();
                $postID = $post->getPostById($arg['id']);
                cast_print($postID);

                return $this->render('admin/editNewsItem');
            }
        }



        return $this->render('admin/editNewsItem');
    }
}
