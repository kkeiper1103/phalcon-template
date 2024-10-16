<?php

namespace App\Controllers;

use App\Models\Post;
use Phalcon\Mvc\Controller;

class ContactController extends Controller
{
    public function create() {
        $this->view->title = "Contact Us";

        $post = Post::findFirst();

        $this->view->post = $post;
    }

    public function store() {
        var_dump($_POST);
    }
}