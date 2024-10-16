<?php

namespace App\Controllers;

use App\Models\Post;
use Phalcon\Mvc\Controller;

class PostController extends Controller
{
    public function index() {
        $this->view->pick('posts/index');
        $this->view->title = "Hello Post Controller";
    }

    public function create() {
        $this->view->pick('posts/create');
        $this->view->title = "Create Post Controller";
    }

    public function store() {

    }

    public function show() {
        $id = $this->dispatcher->getParam('id');

        $post = Post::findFirstById($id);

        $this->view->pick('posts/show');
        $this->view->title = "Show Post Controller";
        $this->view->post = $post;
    }

    public function edit() {
        $id = $this->dispatcher->getParam('id');

        $post = Post::findFirstById($id);
        var_dump($post);

        $this->view->pick('posts/edit');
        $this->view->title = "Edit Post Controller";
        $this->view->post = $post;
    }

    public function update(string $id) {
        $post = Post::findFirstById($id);


    }

    public function destroy(string $id) {
        $post = Post::findFirstById($id);


    }
}