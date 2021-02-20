<?php

use \Core\Route;

return [
	new Route('/hello/all/', 'hello', 'testAll'),
	new Route('/hello/:id/', 'hello', 'test'),
	new Route('/hello/', 'hello', 'index'),
];
