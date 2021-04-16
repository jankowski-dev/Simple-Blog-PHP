<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Post;
use \Project\Models\Group;
use \Project\Models\Category;
use \Project\Models\File;
use \Project\Models\Comment;

class CommentController extends Controller
{
    public $comment;
    public $post;
    public $category;
    public $group;
    public $file;

    public $errors  = false;
    public $update  = false;
    public $create  = false;

    public function __construct()
    {
        $this->comment  = new Comment();
        $this->post     = new Post();
        $this->category = new Category();
        $this->group    = new Group();
        $this->file     = new File();
    }

    public function createComment() {

    }
}
