<?php

namespace App\Controllers;

use App\Models\Post;
use Phalcon\Db\Adapter\AdapterInterface;
use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;
use function App\redirect;

class PostController extends Controller
{
    public function index() {
        $this->view->pick('posts/index');
        $this->view->posts = Post::find();
        $this->view->title = "Hello Post Controller";
    }

    public function create() {
        $this->view->pick('posts/create');
        $this->view->title = "Create Post Controller";
    }

    public function store() {
        $post = new Post();

        $result = $post->fill($_POST)->save();

        if($result) $this->flashSession->success("Successfully Saved Post");
        else $this->flashSession->error("Unable to Save Post");

        return redirect("/posts/");
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

        $this->view->pick('posts/edit');
        $this->view->title = "Edit Post Controller";
        $this->view->post = $post;
    }

    public function update(string $id) {
        $post = Post::findFirstById($id);

        $result = $post->fill($_POST)->save();

        if($result) $this->flashSession->success("Successfully Saved Post");
        else $this->flashSession->error("Unable to Save Post");

        return redirect("/posts/");
    }

    public function destroy(string $id) {
        $post = Post::findFirstById($id);


    }
}