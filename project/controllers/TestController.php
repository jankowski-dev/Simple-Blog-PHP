<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Category;

class TestController extends Controller
{

    /********************************
     * Метод массового создания постов.
     * Принимает статические данные и циклом
     * добавлет новые посты в базу
     ********************************/

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
                $category_id    =  rand(1, 3);
                $story          =  'Тестовый текст на странице';
                $author_id      =  $_SESSION['id']; // костыльное решение, нужна доработка

                $parameters = [
                    'заголовок'         => $title,
                    'описание'          => $description,
                    'ключевые слова'    => $keyword,
                    'категория'         => $category_id,
                    'текст поста'       => $story
                ];

                // Отправка данных и создание нового поста
                for ($i = 1; $i <= 1; $i++) {
                    $create = $post->create($title, $category_id, $description, $keyword, $story, $author_id);
                }
                header('Location: /cpanel/');
                exit;
            }
        }

        header('Location: /auth/');
        exit;
    }


    /********************************
     * Метод массового создания постов.
     * Принимает статические данные и циклом
     * добавлет новые посты в базу
     ********************************/

    public function createCategoryTest()
    {
        $this->title = 'Тестовое создание поста';
        $errors = false;
        $create = false;

        if (isset($_SESSION['id']) && $_SESSION['id'] !== false) {
            // А если авторизован, и он администратор
            if ($_SESSION['id'] == 1) {

                $category = new Category();

                // Сохранение поста
                $title          =  'Тестовый заголовок';
                $description    =  'Тестовое описание';

                $parameters = [
                    'заголовок'         => $title,
                    'описание'          => $description
                ];

                // Отправка данных и создание нового поста
                for ($i = 1; $i <= 1; $i++) {
                    $create = $category->create($title, $description);
                }

                header('Location: /cpanel/categories/');
                exit;
            }
        }

        header('Location: /auth/');
        exit;
    }
}
