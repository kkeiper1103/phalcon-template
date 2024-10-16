<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class IndexController extends Controller
{
    public function index()
    {
        $this->view->pick('index/index');
        $this->view->title = "Hello Index Controller";
    }
}