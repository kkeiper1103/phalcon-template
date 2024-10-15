<?php

namespace App\Controllers;

use App\Models\Post;
use Phalcon\Mvc\Controller;

class ContactController extends Controller
{
    public function indexAction() {
        $this->view->title = "Contact Us";

        $post = Post::findFirst();

        $this->view->post = $post;
    }

    public function postIndexAction() {
        var_dump($_POST);
    }
}