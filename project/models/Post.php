<?php

namespace Project\Models;

use \Core\Model;

class Post extends Model
{
    public function getPostAll()
	{
		return $this->findMany("SELECT * FROM post");
	}

	public function getPostById($id)
	{
		return $this->findOne("SELECT * FROM post WHERE id=$id");
	}
}