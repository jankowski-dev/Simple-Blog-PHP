<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Hello;

class HelloController extends Controller
{
	public function index()
	{
		// $this->title = 'Фреймворк работает!';
		// $hello = new Hello; // тестовая модель для проверки базы
		// return $this->render('hello/index');
	}

	public function test($arg)
	{
		$this->title = 'Фреймворк работает!';
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
