<?php

use \Core\Route;

return [

	/******************************
	 * Роуты административной части
	 *****************************/

	// Индексная страница
	new Route('/cpanel/', 'admin', 'index'),

	/* Посты */
	// Список постов
	new Route('/cpanel/posts/', 'post', 'index'),
	// Тестовое добавление поста
	new Route('/cpanel/create-post-test/', 'test', 'createPostTest'),
	// Удаление поста
	new Route('/cpanel/delete-post/:id/', 'post', 'deletePost'),
	// Создание нового поста
	new Route('/cpanel/create-post/', 'post', 'createPost'),
	// Редактирование поста
	new Route('/cpanel/edit-post/:id/', 'post', 'editPost'),

	/* Категории */
	// Список категорий
	new Route('/cpanel/categories/', 'category', 'index'),
	// Создать категорию
	new Route('/cpanel/create-category/', 'category', 'createCategory'),
	// Удалить категорию
	new Route('/cpanel/delete-category/:id/', 'category', 'deleteCategory'),
	// Редктировать категорию
	new Route('/cpanel/edit-category/:id/', 'category', 'editCategory'),
	// Создать тестовую категорию
	new Route('/cpanel/create-category-test/', 'test', 'createCategoryTest'),

	/* Пользователи */
	// Список пользователей
	new Route('/cpanel/users/', 'user', 'index'),
	// Страница пользователя
	new Route('/cpanel/user/:id/', 'user', 'profile'),


	/******************************
	 * Роуты пользовательской части
	 ******************************/

	// Выход из аккаунта
	new Route('/logout/', 'auth', 'logout'),
	// Форма авторизации
	new Route('/auth/', 'auth', 'auth'),
	// Форма регистрации
	new Route('/register/', 'auth', 'register'),


	new Route('/', 'main', 'index'),

];
