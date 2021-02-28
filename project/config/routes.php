<?php

use \Core\Route;

return [
	// Тестовое добавление поста
	new Route('/cpanel/create-post-test/', 'test', 'createPostTest'),
	// Удаление поста
	new Route('/cpanel/delete-post/:id/', 'admin', 'deletePost'),
	// Создание нового поста
	new Route('/cpanel/create-post/', 'admin', 'createPost'),
	// Редактирование поста
	new Route('/cpanel/edit-post/:id/', 'admin', 'editPost'),
	// Админпанель
	new Route('/cpanel/', 'admin', 'index'),
	// Выход из аккаунта
	new Route('/logout/', 'user', 'logout'),
	// Форма авторизации
	new Route('/auth/', 'user', 'auth'),
	// Форма регистрации
	new Route('/register/', 'user', 'register'),
];
