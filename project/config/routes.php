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
	new Route('/cpanel/posts/', 'admin', 'index'),
	// Тестовое добавление поста
	new Route('/cpanel/create-post-test/', 'test', 'createPostTest'),
	// Удаление поста
	new Route('/cpanel/delete-post/:id/', 'admin', 'deletePost'),
	// Создание нового поста
	new Route('/cpanel/create-post/', 'admin', 'createPost'),
	// Редактирование поста
	new Route('/cpanel/edit-post/:id/', 'admin', 'editPost'),

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


	/******************************
	 * Роуты пользовательской части
	 ******************************/

	// Выход из аккаунта
	new Route('/logout/', 'user', 'logout'),
	// Форма авторизации
	new Route('/auth/', 'user', 'auth'),
	// Форма регистрации
	new Route('/register/', 'user', 'register'),

];
