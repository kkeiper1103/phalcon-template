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

    }

    public function store() {

    }

    public function show(string $slug) {
        $post = Post::findFirstBySlug($slug);

        var_dump($post);
    }

    public function edit(string $slug) {

    }

    public function update(string $slug) {

    }

    public function destroy(string $slug) {

    }
}