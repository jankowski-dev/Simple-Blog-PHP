<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Hello;

class HelloController extends Controller
{
	public function index()
	{

	}

	public function test($arg)
	{
		$this->title = 'Проверка фруймворка';
		$hello = new Hello;
		$data = $hello->getById($arg['id']);
		return $this->render('hello/index', $data);
	}

	public function testAll()
	{
		$this->title = 'Фреймворк работает!';
		$hello = new Hello;
		$data = $hello->getAll();
		return $this->render('hello/index', $data);
	}
}
