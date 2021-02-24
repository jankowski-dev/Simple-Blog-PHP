<?php

use \Core\Route;

return [
	new Route('/cpanel/edit-post/:id/', 'admin', 'editPost'),
	new Route('/cpanel/', 'admin', 'index'),
	new Route('/logout/', 'user', 'logout'),
	new Route('/auth/', 'user', 'auth'),
	new Route('/register/', 'user', 'register'),
];