<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Category;

class TestController extends Controller
{
    // Тестовое создание постов
    public function createPostTest()
    {
        $this->title = 'Тестовое создание поста';
        $errors = false;
        $create = false;

        if (isset($_SESSION['id']) && $_SESSION['id'] !== false) {
            // А если авторизован, и он администратор
            if ($_SESSION['id'] == 1) {

                $post = new Post();
                $category = new Category();
                $categories = $category->getCategoryAll();

                // Сохранение поста
                $title          =  'Тестовый заголовок';
                $description    =  'Тестовое описание';
                $keyword        =  'Тестовые, ключевые, слова';
                $category_id    =  mt_rand(1, 2);
                $story          =  'Тестовый текст на странице';

                $parameters = [
                    'заголовок'         => $title,
                    'описание'          => $description,
                    'ключевые слова'    => $keyword,
                    'категория'         => $category_id,
                    'текст поста'       => $story
                ];

                // Отправка данных и создание нового поста
                for ($i = 1; $i <= 3; $i++) {
                    $create = $post->create($title, $category_id, $description, $keyword, $story);
                }
                header('Location: /cpanel/');
            }
        }

        header('Location: /auth/');
    }
}
