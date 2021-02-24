<?php

namespace Project\Models;

use \Core\Model;

class Post extends Model
{
    public function getAll()
	{
		return $this->findMany("SELECT * FROM post");
	}
}